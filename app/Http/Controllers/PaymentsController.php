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
    public function index(Request $request)
    {
        // $this->check($request);
        // $paid = session('paid');
        // $expiration = session('expiration');
        // $time = time();

        // if ($paid) {
        //     return $this->status();
        // } else {
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

        $test = session('paymentVA');
        dd($test);
    }

    public function status()
    {
        $xenditController = new XenditController();
        $status = session('status');
        $paid = session('paid');
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

    public function check(Request $request)
    {
        $data = $request->all();
        Xendit::setApiKey('xnd_production_ERRXoEh6KiQLisCaNSrFHTy6kvf0l2Olra3JfXqnvKa8wXWeZXrYXqxUP195w5');
        $id = $data['id'];

        $getFVAPayment = \Xendit\VirtualAccounts::getFVAPayment($id);

        return $getFVAPayment;

        // // session()->put('paid', $paid);

        // return response()->json($data);
    
    }

    public function home(Request $request)
    {
        return $this->check($request);
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
