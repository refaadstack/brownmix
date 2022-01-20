<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExportController extends Controller
{
    public function index(){
        
        // $transactions= Transaction::with('transactionItem.product')->where('status','SUCCESS')->get();

        $cat = 'Ready Stock';
        $transactions = DB::table('transactions as t')
                        ->join('transaction_items as ti','t.id','ti.transactions_id')
                        ->join('products as p','p.id','ti.products_id')
                        ->join('categories as c','c.id','p.category_id')
                        ->select(
                                 't.id',
                                 't.name as namapenerima',
                                 't.address',
                                 't.email',
                                 't.ongkir',
                                 'p.name as namaproduk',
                                 'p.price',
                                 'c.name as catName')
                        ->where('t.status','=','SUCCESS')
                        ->where('c.id','=','1')
                        ->get();

                        // dd($transactions);


        $pdf = PDF::loadView('pages.dashboard.penjualan.cetak',['transactions' => $transactions,'cat'=>$cat]);
     
        return $pdf->stream('Laporan_Penjualan.pdf');
    }
    public function handmade(){

        $cat = 'Hand made';
        $transactions = DB::table('transactions as t')
                        ->join('transaction_items as ti','t.id','ti.transactions_id')
                        ->join('products as p','p.id','ti.products_id')
                        ->join('categories as c','c.id','p.category_id')
                        ->select(
                                 't.id',
                                 't.name as namapenerima',
                                 't.address',
                                 't.email',
                                 't.ongkir',
                                 'p.name as namaproduk',
                                 'p.price',
                                 'c.name as catName')
                        ->where('t.status','=','SUCCESS')
                        ->where('c.id','=','2')
                        ->get();

                        // dd($transactions);


        $pdf = PDF::loadView('pages.dashboard.penjualan.cetak',['transactions' => $transactions,'cat'=>$cat]);
     
        return $pdf->stream('Laporan_Penjualan.pdf');
    }
}
