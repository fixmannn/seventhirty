<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentMail extends Mailable
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
        $details = User::where('id', session('LoggedUser'))->get();
        $order = Order::where('order_number', session('order_number'))->get();
        $order_number = session('order_number');

        return $this->subject('Menunggu Pembayaran Order #' . $order_number)->view('mail.paymentmail', compact('details', 'order'));
    }
}
