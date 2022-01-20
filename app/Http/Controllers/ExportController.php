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
                        ->get();

                        // dd($transactions);


        $pdf = PDF::loadview('pages.dashboard.penjualan.cetak',['transactions' => $transactions]);
     
        return $pdf->stream('Laporan_Penjualan.pdf');
    }
}
