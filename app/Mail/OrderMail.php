<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
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
        $details = OrderDetail::where('order_number', $order_number)->get();

        foreach($details as $products) {
            $product = Product::where('id', $products['product_id'])->get();
            $names[] = $product['name'];
        }

        return $this->subject('New Order #' . $order_number)->view('mail.ordermail', compact('order', 'details', 'names'));
    }
}
