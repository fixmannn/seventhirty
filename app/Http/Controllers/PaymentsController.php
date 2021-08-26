<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Http\Controllers\Api\Payment\XenditController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Xendit\Xendit;

class PaymentsController extends Controller
{
    public function index()
    {
        $check = Order::where('order_number', session('order_number'))->first();
        $expiration = session('expiration');
        $time = time();

        if ($check['order_status'] == 1) {
            $this->status();
        } elseif ($check['order_status'] == 0) {
            if(session('payment')) {
                if ($expiration['timestamp'] > $time) {
                    return view('checkout.payment');
                } else {
                    $status = Order::where('order_number', session('order_number'))
                                ->update(['order_status' => 3]);
                                
                    session()->pull('order_number');
                    session()->pull('payment');
                    session()->pull('expiration');
                    session()->pull('shipping');
                    session()->pull('cart');
    
                    return redirect('checkout');
                }
            } else {
                return redirect('cart');
            } 
        }
    }

    public function status()
    {
        $check = Order::where('order_number', session('order_number'))->first();

        if($check['order_status'] == 1) {
            session()->pull('order_number');
            session()->pull('payment');
            session()->pull('expiration');
            session()->pull('cart');
            session()->pull('shipping');

            return view('checkout.payment-success');
        } else {
            return redirect('payment');
        }
    }

    public function checkFVA(Request $request)
    {
        $callback = $request->all();

        $update = Order::where('order_number', $callback['external_id'])
                    ->update(['order_status' => 1]);

        session()->put('order_number', $callback['external_id']);
        session()->put('payment_method', $callback['bank_code']);

        // // testing
        // session()->put('order_number', '20210728BD2E');
        // session()->put('payment_method', 'MANDIRI');

        $mail = new MailController();
        $mail->orderMail();
        $mail->paymentpaidMail();

        return response('ok', 200);
        
    }

    public function checkOVO(Request $request)
    {
        $callback = $request->all();

        if($callback['status'] == 'COMPLETED') {
            $update = Order::where('order_number', $callback['external_id'])
                            ->update(['order_status' => 1]);
            
            session()->put('order_number', $callback['external_id']);
            session()->put('payment_method', $callback['ewallet_type']);

            $mail = new MailController();
            $mail->orderMail();
            $mail->paymentpaidMail();

            return response('ok', 200);
        } else {
            return response('payment failed', 404);
        }

    }

    public function checkeWallets(Request $request)
    {
        $callback = $request->all();

        if($callback['data']['status'] == 'SUCCEEDED') {
            $update = Order::where('order_number', $callback['data']['reference_id'])
                            ->update(['order_status' => 1]);

            session()->put('order_number', $callback['data']['external_id']);
            session()->put('payment_method', $callback['data']['channel_code']);

            $mail = new MailController();
            $mail->orderMail();
            $mail->paymentpaidMail();
            
            return response('ok', 200);
        } else {
            return response('payment failed', 404);
        }
    }

    public function checkQR(Request $request)
    {
        $callback = $request->all();

        if($callback['status'] == 'COMPLETED') {
            $update = Order::where('order_number', $callback['qr_code']['external_id'])
                            ->update(['order_status' => 1]);

            session()->put('order_number', $callback['qr_code']['external_id']);
            session()->put('payment_method', 'Scan QR BCA');

            $mail = new MailController();
            $mail->orderMail();
            $mail->paymentpaidMail();

            return response('ok', 200);
        } else {
            return response('payment failed', 404);
        }
    }

    public function success() 
    {
        return view('checkout.payment-success');
    }
}
