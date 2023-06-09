<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        // Configure Midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isDSanitized');
        Config::$is3ds = config('services.midtrans,is3ds');

        // Create Instance Midtrans Notification
        $notification = new Notification();

        // Assign variable to code funny
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;

        // Search Transaction from ID
        $transaction = Orders::findOrFail($order_id);

        // Notification Handle Midtrans Status
        if ($status == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $transaction->payment_status = 'PENDING';
                } else {
                    $transaction->payment_status = 'SUCCESS';
                }
            }
        } else if ($status == 'settlement') {
            $transaction->payment_status = 'SUCCESS';
        } else if ($status == 'pending') {
            $transaction->payment_status = 'PENDING';
        } else if ($status == 'deny') {
            $transaction->payment_status = 'CANCELLED';
        } else if ($status == 'expire') {
            $transaction->payment_status = 'CANCELLED';
        } else if ($status == 'cancel') {
            $transaction->payment_status = 'CANCELLED';
        }

        // Save Transaction
        $transaction->save();
    }
}
