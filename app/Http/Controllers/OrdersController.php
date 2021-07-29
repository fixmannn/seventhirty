<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\OrderDetail;
use App\Models\Product;
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
        
        $orderdetails = new OrderDetailsController;

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

            $orderdetails->create();
        
        } else {
            $updateOrder = Order::where('order_number', $order_number)
                ->update([
                    'amount' => $amount
                ]);

            $orderdetails->update();
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
    public function show(Order $order, $order_number)
    {
        $order = Order::where('order_number', $order_number)->first();
        $detail = OrderDetail::where('order_number', $order_number)->get();
        $user = User::where('id', session('LoggedUser'))->first();
        foreach($detail as $id => $x) {
            $product_id[] = $x['product_id'];
        } 

        $product = Product::whereIn('id', $product_id)->get();
        
        dump($product);

        // dump($product);


        // return view('account.order', compact('order', 'detail', 'user', 'product'));
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
