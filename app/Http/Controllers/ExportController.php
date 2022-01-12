<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function index(){
        
        $transactions = Transaction::where('status', 'SUCCESS')->get();

        // dd($transactions);

        $pdf = PDF::loadView('pages.dashboard.penjualan.cetak',['transactions' => $transactions]);
     
        return $pdf->stream('Laporan_Penjualan.pdf');
    }
}
