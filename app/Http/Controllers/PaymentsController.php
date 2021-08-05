<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Http\Controllers\Api\Payment\XenditController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Xendit\Xendit;

class PaymentsController extends Controller
{
    public function index()
    {
        return view('checkout.payment');

        // $success = json_decode($this->webhookCall, true)['payload'];
        // $expiration = session('expiration');
        // $time = time();

        // if (isset($success)) {
        //     $status = Order::where('order_number', $success['external_id'])
        //                 ->update(['order_status' => 1]);
        //     session()->pull('payment');
        // }


        // if ($expiration['timestamp'] > $time) {
        //     return view('checkout.payment');
        // } else {
        //     $status = Order::where('order_number', session('order_number'))
        //                 ->update(['order_status' => 3]);
                        
        //     session()->pull('order_number');
        //     session()->pull('payment');
        //     session()->pull('expiration');
        //     session()->pull('shipping');
        //     return redirect('checkout');
        // }
    }

    public function status()
    {
        $xenditController = new XenditController();
        // Sending Email
        $mail = new MailController();
        $expiration = session('expiration');

        if ($expiration['type'] == 'va') {
            // Get Xendit Payment Callback
            $success = json_decode(file_get_contents('php://input'), true);

            session()->put('payment_success', $success);

            if (isset($success)) {
                // Send order Mail to Customer and us
                $mail->orderMail();
                $mail->paymentpaidMail();

                $status = Order::where('order_number', session('order_number'))
                        ->update(['order_status' => 1]);

                session()->pull('payment');
                session()->pull('expiration');
                session()->pull('cart');
                session()->pull('shipping');
                session()->pull('success');

                return redirect('payment-success');
            } else {
                return redirect('payment');
            }
        } elseif ($expiration['type'] == 'qris') {
            $QRstatus = $xenditController->getQR();

            if (is_array($QRstatus)) {
                // Send order Mail to Customer and us
                $mail->orderMail();
                $mail->paymentpaidMail();

                $status = Order::where('order_number', session('order_number'))
                        ->update(['order_status' => 1]);

                session()->pull('payment');
                session()->pull('expiration');
                session()->pull('shipping');

                return redirect('payment-success');
            } else {
                return redirect('payment');
            }
        } else {
            $eWalletStatus = $xenditController->geteWallets();
            // dd($eWalletStatus['status']);

            if ($eWalletStatus['status'] == 'FAILED') {
                session()->pull('payment');
                session()->pull('expiration');
                session()->pull('shipping');

                return redirect('payment');
            } elseif ($eWalletStatus['status'] == 'SUCCEEDED' || $eWalletStatus['status'] == 'COMPLETED') {
                // Get Xendit Payment Callback
                json_decode(file_get_contents('php://input'), true);

                // Send order Mail to Customer and us
                $mail->orderMail();
                $mail->paymentpaidMail();

                $status = Order::where('order_number', session('order_number'))
                        ->update(['order_status' => 1]);

                session()->pull('payment');
                session()->pull('expiration');
                session()->pull('cart');
                session()->pull('shipping');


                return redirect('payment-success');
            } else {
                return redirect('payment');
            }
        }




        // return view('checkout.payment-success', compact('details', 'order'));

        // $details = User::where('id', session('LoggedUser'))->get();
        // $order = Order::where('order_number', session('order_number'))->get();


    }
}
