<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\User;
use App\Models\Province;
use App\Models\Courier;
use App\Models\City;
use App\Models\Order;
use Illuminate\Http\Request;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class CheckoutController extends Controller
{

    public function shipping($id)
    {
        $quantity = 0;
        foreach (session('cart') as $detail => $details) {
            $quantity = $quantity +  ($details['quantity']);
        }

        $cost = RajaOngkir::ongkosKirim([
            'origin' => 457,
            'destination' => $id,
            'weight' => 250 * $quantity,
            'courier' => 'jne'
        ])->get();


        if ($id !== '457' && $id !== '456' && $id !== '455') {
            $shipping = $cost[0]['costs'][1]['cost'][0]['value'];
            session()->put('shipping', $shipping);
            return $shipping;
        } else {
            $shipping = $cost[0]['costs'][0]['cost'][0]['value'];
            session()->put('shipping', $shipping);
            return $shipping;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session()->has('payment')) {
            return redirect('payment');
        } else {
            if (session('cart')) {
                $user = User::where('id', session('LoggedUser'))->first();
                $couriers = Courier::pluck('title', 'code');
                $provinces = Province::pluck('title', 'province_id');

                $id = session('LoggedUser');

                $today = date("Ymd");
                $rand = strtoupper(substr(uniqid(sha1(time())), 0, 4));
                $unique = $today . $rand;

                $order_number = session()->get('order_number');

                if (!$order_number) {
                    $order_number = $unique;
                }

                session()->put('order_number', $order_number);

                return view('checkout.index', compact('user', 'couriers', 'provinces', 'order_number'));
            } else {
                return redirect('cart');
            }
        }
    }

    public function getCities($id)
    {
        $city = City::where('province_id', $id)->pluck('title', 'city_id');
        return json_encode($city);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function show(Checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function edit(Checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checkout $checkout)
    {
        //
    }
}
