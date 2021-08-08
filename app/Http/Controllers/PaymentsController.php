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
        $status = session('status');
        $expiration = session('expiration');
        $time = time();

        if (isset($status)) {
            return $this->status();
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
        $status = session('status');
        // Sending Email
        $mail = new MailController();
        $expiration = session('expiration');

        if($status) {
            if (in_array('BNI' || 'MANDIRI' || 'BRI' || 'PERMATA', $status)) {
                // Get Xendit Payment Callback
    
                // Send order Mail to Customer and us
                $mail->orderMail();
                $mail->paymentpaidMail();
    
                $status = Order::where('order_number', $status['external_id'])
                        ->update(['order_status' => 1]);
    
                session()->pull('payment');
                session()->pull('expiration');
                session()->pull('cart');
                session()->pull('shipping');
                session()->pull('status');
    
                return view('checkout.payment-success');
    
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
    
                    $status = Order::where('order_number', $status['data']['reference_id'])
                            ->update(['order_status' => 1]);
    
                    session()->pull('payment');
                    session()->pull('expiration');
                    session()->pull('cart');
                    session()->pull('shipping');
    
                    return view('checkout.payment-success');
                } 
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

                return view('checkout.payment-success');
            } 
        } else {
            return redirect('payment');
        }
    }

    public function check()
    {
        $status = json_decode(file_get_contents('php://input'), true);

        session()->put('status', $status);

        return response('ok', 200);
    }

    public function home()
    {
        return redirect()->route('payment-check', [PaymentsController::class, 'check']);
    }

    public function success() 
    {
        $this->status();
    }
}
