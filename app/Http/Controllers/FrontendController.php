<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Cart;
use App\Models\City;
use App\Models\Courier;
use App\Models\Product;
use App\Models\Province;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Midtrans\Config;
use Midtrans\Snap;

class FrontendController extends Controller
{
    public function index(Request $request){
        $products = Product::with(['galleries'])->latest()->limit(10)->get();

        return view('pages.frontend.index', compact('products'));
    }

    public function details(Request $request,$slug){
        $product = Product::with(['galleries'])->where('slug',$slug)->firstOrFail();
        $recomendations = Product::with(['galleries'])->inRandomOrder()->limit(4)->get();
        return view('pages.frontend.details', compact('product','recomendations'));
    }
    public function cartAdd(Request $request, $id){
        

        $cart = Cart::where('products_id',$id)->where('users_id',Auth::user()->id);

        if($cart->count()){
           $cart->increment('quantity');
           $cart = $cart->first();
        }else{
        $data = [
                    'products_id' => $id,
                    'users_id' => Auth::user()->id,
                    'quantity' => 1,
                ];
            Cart::create($data);
        }
        return redirect('cart');
    }
    public function cartDelete(Request $request, $id){
        $item = Cart::findOrFail($id);

        $item->delete();

        return redirect('cart');
    }
    public function cart(Request $request){

       
        // $city = City::pluck('city_id','title');
        // $carts = Cart::with(['product'])->where('users_id', Auth::user()->id)->get();
        
        // $totalberat = $carts->sum('product.weight');

        $carts = Cart::with(['product.galleries'])->where('users_id', Auth::user()->id)->get();
        // dd($carts);
        return view('pages.frontend.cart', compact(['carts']));
    }

    public function getCities($id)
    {
        $city = City::where('province_id',$id)->pluck('title','city_id');
        return response()->json($city);
    }
    public function ongkir(Request $request)
    {
        $cost = RajaOngkir::ongkosKirim([
            'origin'        => $request->city_origin, // ID kota/kabupaten asal
            'destination'   => $request->city_destination, // ID kota/kabupaten tujuan
            'weight'        => $request->weight, // berat barang dalam gram
            'courier'       => $request->courier // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();


        return response()->json($cost);
    }

    public function checkout(CheckoutRequest $request){
        $data = $request->all();

        // get carts data
            $carts = Cart::with(['product'])->where('users_id', Auth::user()->id)->get();
        //add to transaction data
            $data['users_id'] = Auth::user()->id;
            $data['total_price'] = $carts->sum('product.price');
            
        //create transaction
            $transaction = Transaction::create($data);  

        //create transaction item
            foreach($carts as $cart){
                $items[]= TransactionItem::create([
                    'transactions_id'    => $transaction->id,
                    'users_id'          => $cart->users_id,
                    'products_id'       => $cart->products_id 
                ]);
                $product = Product::findOrFail($cart->product->id);
                $product->decrement('stocks', $cart->quantity);
            }
        //delete cart after transaction
            Cart::where('users_id',Auth::user()->id)->delete();
            


        //konfigurasi midtrans
            Config::$serverKey      = config('services.midtrans.serverKey');
            Config::$isProduction   = config('services.midtrans.isProduction');
            Config::$isSanitized    = config('services.midtrans.isSanitized');
            Config::$is3ds          = config('services.midtrans.is3ds');
        
        //setup variable midtrans
            $midtrans = [
                'transaction_details' =>[
                    'order_id'          => 'BM-' . $transaction->id . rand(1,99999).'-'.$transaction->ongkir,
                    'gross_amount'      => (int) $transaction->total_price+ $transaction->ongkir, 
                ],
                'customer_details' =>[
                    'first_name'    => $transaction->name,
                    'email'         => $transaction->email,
                ],
                'enabled_payments' =>[
                    'gopay',
                    'bank_transfer',
                    'alfamart',
                    'indomaret',
                    'shopeepay'
                ],
                'vtweb' =>[]
            ];
        //payment process
        try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;
            
            $transaction->payment_url = $paymentUrl;
            $transaction->save();
            // Redirect to Snap Payment Page
            return redirect($paymentUrl);
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }

    }
    public function success(Request $request){
        return view('pages.frontend.success');
    }
}
