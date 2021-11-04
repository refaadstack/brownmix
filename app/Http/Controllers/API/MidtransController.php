<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransController extends Controller
{
    public function callback(){
        //set configurasi midtrans
        Config::$serverKey      = config('services.midtrans.serverKey');
        Config::$isProduction   = config('services.midtrans.isProduction');
        Config::$isSanitized    = config('services.midtrans.isSanitized');
        Config::$is3ds          = config('services.midtrans.is3ds');
        //buat instance midtrans notifications
        $notification = new Notification();

        //assign ke variable untuk memudahkan coding
        $status = $notification->transactions_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;

        // get transaction id 
        $order = explode('-', $order_id);
        
        //cari transaction berdasarkan ID
        $transaction = Transaction::findOrFail($order[1]);
        
        //handle notification status midtrans
        if($status == 'capture'){
            if($type == 'credit_card'){
                if($fraud == 'challenge'){
                    $transaction->status = 'PENDING';
                }
                else{
                    $transaction->status = 'SUCCESS';
                }
            }
        }
        else if($status == 'settlement'){
            $transaction->status = 'SUCCESS';
        }
        else if($status == 'pending'){
            $transaction->status = 'PENDING';
        }
        else if($status =='deny'){
            $transaction->status = 'PENDING';
        }
        else if($status =='expired'){
            $transaction->status = 'CANCELLED';
        }
        else if($status =='cancel'){
            $transaction->status = 'CANCELLED';
        }
        //simpan transaction
        $transaction->save();

        //return response untuk midtrans
        return response()->json([
            'meta' => [
                'code' => 200,
                'message' => 'Midtrans Notofication Success'
            ] 
            ]);

    }
}
