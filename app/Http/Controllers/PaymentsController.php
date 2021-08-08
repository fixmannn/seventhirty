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
        $success = session('success');
        $expiration = session('expiration');
        $time = time();

        if (isset($success)) {
            return redirect('payment-success');
        } else {
            if ($expiration['timestamp'] > $time) {
                return view('checkout.payment');
            } else {
                $status = Order::where('order_number', session('order_number'))
                            ->update(['order_status' => 3]);
                            
                session()->pull('order_number');
                session()->pull('payment');
                session()->pull('expiration');
                session()->pull('shipping');
                return redirect('checkout');
            }
        }

    }

    public function status()
    {
        $xenditController = new XenditController();
        $success = session('success');
        // Sending Email
        $mail = new MailController();
        $expiration = session('expiration');

        if($success) {
            if (in_array('BNI' || 'MANDIRI' || 'BRI' || 'PERMATA', $success)) {
                // Get Xendit Payment Callback
    
                // Send order Mail to Customer and us
                $mail->orderMail();
                $mail->paymentpaidMail();
    
                $status = Order::where('order_number', $success['external_id'])
                        ->update(['order_status' => 1]);
    
                session()->pull('payment');
                session()->pull('expiration');
                session()->pull('cart');
                session()->pull('shipping');
                session()->pull('success');
    
                return redirect('payment-success');
    
            } else {
                $eWalletStatus = $xenditController->geteWallets();
                // dd($eWalletStatus['status']);
    
                if ($eWalletStatus['status'] == 'FAILED') {
                    session()->pull('payment');
                    session()->pull('expiration');
                    session()->pull('shipping');
    
                    return redirect('payment');
                } elseif ($eWalletStatus['status'] == 'SUCCEEDED' || $eWalletStatus['status'] == 'COMPLETED') {
    
                    // Send order Mail to Customer and us
                    $mail->orderMail();
                    $mail->paymentpaidMail();
    
                    $status = Order::where('order_number', $success['data']['reference_id'])
                            ->update(['order_status' => 1]);
    
                    session()->pull('payment');
                    session()->pull('expiration');
                    session()->pull('cart');
                    session()->pull('shipping');
    
                    return redirect('payment-success');
                } 
            }
        } elseif ($expiration['type'] == 'qris') {
            $QRstatus = $xenditController->getPayment();
    
            if (is_array($QRstatus)) {
                // Send order Mail to Customer and us
                $mail->orderMail();
                $mail->paymentpaidMail();

                $status = Order::where('order_number', $success['qr_code']['external_id'])
                        ->update(['order_status' => 1]);

                session()->pull('payment');
                session()->pull('expiration');
                session()->pull('shipping');

                return redirect('payment-success');
            } 
        } else {
            return redirect('payment');
        }
    }

    public function check()
    {
        $success = json_decode(file_get_contents('php://input'), true);

        session()->put('success', $success);

        return response('ok', 200);
    }

    public function home()
    {
        return redirect()->route('payment-check', [PaymentsController::class, 'check']);
    }

    public function success()
    {
        // return view('checkout.payment-success');
        $success = session('success');
        $array = explode(',', $success);

        foreach($array as $val) {
            $tmp = explode(':', $val);
            $status[$tmp[0]] = $tmp[1];
        }
        $status = str_replace(array('[', '{', '"', '}', ']'), '', $status);
        dd($status);
        // gettype($success);
    }
}
