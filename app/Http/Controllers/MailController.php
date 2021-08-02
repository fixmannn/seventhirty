<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;
use App\Mail\PaymentMail;
use App\Mail\PaymentPaidMail;
use App\Mail\DeliveryMail;

class MailController extends Controller
{
    public function orderMail()
    {
        $email_details = [
            'nama' => "New Order",
            'body' => "Ada orderan baru masuk nih!!"
        ];

        Mail::to('sevthirty730@gmail.com')->send(new OrderMail($email_details));
    }

    public function paymentMail()
    {
        $details = User::where('id', session('LoggedUser'))->get();
        $guest = session('guest');

        $email_details = [
            'nama' => "New Order",
            'body' => "Ada orderan baru masuk nih!!"
        ];


        if (isset($guest)) {
            Mail::to($guest['email'])->send(new PaymentMail($email_details));
        } else {
            Mail::to($details[0]['email'])->send(new PaymentMail($email_details));
        }
    }
    public function paymentpaidMail()
    {
        $details = User::where('id', session('LoggedUser'))->get();
        $guest = session('guest');

        $email_details = [
            'nama' => "123",
            'body' => "123"
        ];

        if (isset($guest)) {
            Mail::to($guest['email'])->send(new PaymentPaidMail($email_details));
        } else {
            Mail::to($details[0]['email'])->send(new PaymentPaidMail($email_details));
        }
    }

    public function deliveryMail($order_number)
    {
        $order = Order::where('order_number', $order_number)->first();
        $details = User::where('id', $order['user_id'])->first();
        $guest = session('guest');

        $email_details = [
            'nama' => 123,
            'body' => 123
        ];

        dd($details);

        // if(isset($guest)) {
        //     Mail::to($guest['email'])->send(new DeliveryMail($email_details));
        // } else {
        //     Mail::to($details[0]['email'])->send(new DeliveryMail($email_details));
        // }
    }
}
