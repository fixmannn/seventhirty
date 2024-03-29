<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentPaidMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email_details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email_details)
    {
        $this->email_details = $email_details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order = Order::where('order_number', session('order_number'))->first();
        $order_number = session('order_number');

        return $this->subject('Order #' . $order_number . ' berhasil dibayar')->view('mail.paymentpaidmail', compact('order'));
    }
}
