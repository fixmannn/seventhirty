<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        if (session()->has('payment')) {
            return redirect('payment');
        } else {
            $users = User::all();
            $products = Product::all();
            return view('pages.cart', [
                'users' => $users,
                'product' => $product
            ]);
        }
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $users = User::all();
        $products = Product::all();
        return view('pages.cart', [
            'users' => $users,
            'products' => $products
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }

    public function addToCart(Request $request, Product $id)
    {
        $product = Product::find($id);

        $id = $id->id;
        $orderid = $id . $request->input('size');

        $product = $product[0];

        $cart = session()->get('cart');

        // if cart is empty add first product to a cart
        if (!$cart) {
            $cart = [
                $orderid =>
                [
                    "id" => $id,
                    "name" => $product->name,
                    "category" => $product->category,
                    "size" => $request->input('size'),
                    "price" => $product->price,
                    "discount_amount" => $product->discount_amount,
                    "image" => $product->image,
                    "quantity" => 1
                ]
            ];

            if ($request->input('size') == null) {
                return redirect()->back()->with('failed', 'Pilih size terlebih dahulu');
            } else {
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
            }
        }

        // if cart is not empty then check if this product exist then increment quantity
        if (isset($cart[$orderid]['size'])) {
            $cart[$orderid]['quantity']++;

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$orderid] = [
            "id" => $id,
            "name" => $product->name,
            "category" => $product->category,
            "size" => $request->input('size'),
            "price" => $product->price,
            "discount_amount" => $product->discount_amount,
            "image" => $product->image,
            "quantity" => 1
        ];

        if ($request->input('size') == null) {
            return redirect()->back()->with('failed', 'Pilih size terlebih dahulu');
        } else {
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
        }
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return redirect()->back();
        }
    }
}
