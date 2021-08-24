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
    public function index(Request $request)
    {
        // $check = Order::where('order_number', session('order_number'))->first();
        // $expiration = session('expiration');
        // $time = time();

        // if ($check['order_status'] == 1) {
        //     $this->status();
        // } elseif ($check['order_status'] == 0) {
        //     if(session('payment')) {
        //         if ($expiration['timestamp'] > $time) {
        //             return view('checkout.payment');
        //         } else {
        //             $status = Order::where('order_number', session('order_number'))
        //                         ->update(['order_status' => 3]);
                                
        //             session()->pull('order_number');
        //             session()->pull('payment');
        //             session()->pull('expiration');
        //             session()->pull('shipping');
        //             session()->pull('cart');
    
        //             return redirect('checkout');
        //         }
        //     } else {
        //         return redirect('cart');
        //     } 
        // }


        // testing
        session()->put('order_number', '20210728BD2E');
        $order_number = session('order_number');
        $order = Order::where('order_number', $order_number)->first();
        $details = OrderDetail::where('order_number', $order_number)->get();

        foreach($details as $products) {
            $product = Product::where('id', $products['product_id'])->first();
            $names = [];
            $names = $product['name'];
        }
        
        dump($names);    
    }

    public function status()
    {
        $xenditController = new XenditController();

        // Sending Email
        $mail = new MailController();
        $expiration = session('expiration');

        if($expiration['type'] == 'va') {
            $xenditController->checkVA();
            $paid = $xenditController->getFVAPayment();
    
            // Send order Mail to Customer and us
            $mail->orderMail(); 
            $mail->paymentpaidMail();

            $status = Order::where('order_number', $paid['external_id'])
                    ->update(['order_status' => 1]);

            session()->pull('payment');
            session()->pull('expiration');
            session()->pull('cart');
            session()->pull('shipping');
            session()->pull('status');
            session()->pull('paid');

            session()->put('succeed', 'Pembayaran Berhasil');
    
        } elseif($expiration['type'] == 'ewallets') {
            $eWalletStatus = $xenditController->geteWallets();
                // dd($eWalletStatus['status']);
    
                if ($eWalletStatus['status'] == 'FAILED') {
                    session()->pull('payment');
                    session()->pull('expiration');
                    session()->pull('shipping');
                    session()->pull('order_number');
                    session()->pull('cart');
    
                    return redirect('cart');

                } elseif ($eWalletStatus['status'] == 'SUCCEEDED' || $eWalletStatus['status'] == 'COMPLETED') {
    
                    // Send order Mail to Customer and us
                    $mail->orderMail();
                    $mail->paymentpaidMail();
    
                    $status = Order::where('order_number', $eWalletStatus['reference_id'])
                            ->update(['order_status' => 1]);
    
                    session()->pull('payment');
                    session()->pull('expiration');
                    session()->pull('cart');
                    session()->pull('shipping');
                    session()->pull('paid');
    
                    session()->put('succeed', 'Pembayaran Berhasil');
                } elseif ($eWalletStatus['status'] == 'PENDING') {
                    return redirect('payment');
                }
        
        } elseif ($expiration['type'] == 'qris') {
            $QRstatus = $xenditController->getPayment();
    
            if ($status['"status"'] == 'COMPLETED') {
                // Send order Mail to Customer and us
                $mail->orderMail();
                $mail->paymentpaidMail();

                $status = Order::where('order_number', $status['"external_id"'])
                        ->update(['order_status' => 1]);

                session()->pull('payment');
                session()->pull('expiration');
                session()->pull('shipping');
                session()->pull('cart');
                session()->pull('status');

                session()->put('succeed', 'Pembayaran Berhasil');
            } 
        } else {
            return redirect('payment');
        }
    }

    public function checkFVA(Request $request)
    {
        // $callback = $request->all();

        // $update = Order::where('order_number', $callback['external_id'])
        //             ->update(['order_status' => 1]);

        // session()->put('order_number', $callback['external_id']);

        session()->put('order_number', '20210728BD2E');

        // $mail = new MailController();
        // $mail->orderMail();

        // return response('ok', 200);

        $order_number = session('order_number');
        $order = Order::where('order_number', $order_number)->first();
        $details = OrderDetail::where('order_number', $order_number)->get();

        foreach($details as $products) {
            $product = Product::where('id', $products['product_id'])->get();
            dump();    
        }
        
    }

    public function checkOVO(Request $request)
    {
        $callback = $request->all();

        if($callback['status'] == 'COMPLETED') {
            $update = Order::where('order_number', $callback['external_id'])
                            ->update(['order_status' => 1]);
            
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

            return response('ok', 200);
        } else {
            return response('payment failed', 404);
        }
    }

    public function success(Request $request) 
    {
        $succeed = session('succeed');

        if(isset($succeed)) {
            session()->pull('succeed');
            return view('checkout.payment-success');
        } else {
            $this->check($request);
            $this->status();
        }
    }
}
