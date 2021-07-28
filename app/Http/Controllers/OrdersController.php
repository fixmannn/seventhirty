<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrdersDetails;
use App\Http\Controllers\CheckoutController;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!session('LoggedUser')) {
            $orderid = 0;
        } else {
            $orderid = session('LoggedUser');
        }

        $order_number = session('order_number');
        $found = Order::where('order_number', $order_number)->get('order_number');
        $shipping = session('shipping');

        $amount = 0;
        foreach (session('cart') as $detail => $details) {
            $amount = $amount +  ($details['quantity'] * ($details['price'] - $details['discount_amount']));
        }

        $amount = $amount + $shipping;

        if ($found == "[]") {
            $makeOrder = Order::create([
                'order_number' => $order_number,
                'user_id' => $orderid,
                'amount' => $amount,
                'shipping_fee' => $shipping
            ]);

            foreach(session('cart') as $detail => $details) {
                $makeOrderDetails = OrderDetails::create([
                    'order_number' = $order_number,
                    'product_id' = $details['id'],
                    'quantity' = $details['quantity'],
                    'size' = $details['size'],
                    'price' = $details['price']
                ]);
            }
        } else {
            $updateOrder = Order::where('order_number', $order_number)
                ->update([
                    'amount' => $amount
                ]);

            foreach(session('cart') as $detail => $details) {
                $updateOrder = OrderDetails::where('order_number', $order_number)
                                ->where('product_id', $details['product_id'])
                                ->update([
                                    'quantity' => $details['quantity'],
                                    'size' => $details['size'],
                                    'price' => $details['price']
                                ]);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Store order details when payment paid

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
