<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DeliveryMail extends Mailable
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
        $order_number = session('order_number');
        $order = Order::where('order_number', $order_number)->first();

        return $this->subject('Pesanan #' . $order_number . ' Dalam Perjalanan')->view('mail.deliverymail', compact('order'));
    }
}
