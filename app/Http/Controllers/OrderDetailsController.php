<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Http\Controllers\CheckoutController;
use Illuminate\Http\Request;

class OrderDetailsController extends Controller
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
      $order_number = session('order_number');

      foreach(session('cart') as $detail => $details) {
          $makeOrderDetails = OrderDetail::create([
              'order_number' => $order_number,
              'product_id' => $details['id'],
              'quantity' => $details['quantity'],
              'size' => $details['size'],
              'price' => $details['price']
          ]);
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
    public function update()
    {
      $order_number = session('order_number');
      foreach(session('cart') as $detail => $details) {
        $updateOrder = OrderDetail::where('order_number', $order_number)
                        ->where('product_id', $details['product_id'])
                        ->update([
                            'quantity' => $details['quantity'],
                            'size' => $details['size'],
                            'price' => $details['price']
        ]);
      }
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
