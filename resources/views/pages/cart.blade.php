<?php
session_start();

?>

@extends('layouts/pages')

@section('title', 'Seven Thirty - Cart')

@section('cartcss')
<link rel="stylesheet" href="{{asset('css/cart.css')}}">
@endsection

@include('layouts/nav')

<!-- Cart -->
<div class="cart">
  <div class="row">
    <div class="col">
      <h2>Your Shopping Cart</h2>
    </div>
  </div>

  <!-- If cart is not empty -->
  @if(session('cart'))
  <div class="row">
    <div class="col-xl-7">
      <div class="cart-table">

        <table>
          <tr>
            <th>Product</th>
            <th class="pc-only text-center">Price</th>
            <th class="text-center">Quantity</th>
            <th class="pc-only text-center">Total</th>
            <th></th>
          </tr>
          <?php $total = 0 ?>
          <?php $subtotal = 0 ?>
          <?php $discount = 0 ?>
          <tr>
            @foreach(session('cart') as $id => $details)
            <?php $total += $details['price'] * $details['quantity']  ?>
            <?php $discount += $details['quantity'] * $details['discount_amount'] ?>
            <td><img src="{{asset('img/'.$details['image'])}}"> <span class="ml-2">{{$details['name']}} - {{$details['category']}} - {{$details['size']}}</span></td>
            <td class="pc-only">Rp. <span class="currency number">{{$details['price']}}</span>,-</td>
            <td class="text-center">{{$details['quantity']}}</td>
            <td class="pc-only text-center">Rp. <span class="currency number">{{$details['price']*$details['quantity']}}</span>,-</td>
            <form action="{{url('cart')}}" method="post">
              @method('delete')
              @csrf
              <td>
                <button class="close remove-from-cart" aria-label="Close" value="{{$details['id'] . $details['size']}}" name="id" onsubmit="return confirm('Hapus item ini?')">
                  <span aria-hidden="true"><i class="bi bi-trash"></i></span>
                </button>
              </td>
            </form>
          </tr>
          @endforeach
        </table>
      </div>
    </div>
    <div class="col-xl-5 mb-4">
      <div class="order-summary">
        <table>
          <tr class="summary">
            <th>Order Summary</th>
            <td></td>
          </tr>
          <tr>
            <th>Subtotal</th>
            <td>Rp. <span class="currency number">{{$subtotal += $subtotal + $total}}</span>,-</td>
          </tr>
          <tr>
            <th>Discount</th>
            <td>Rp. <span class="currency number">{{$discount}}</span>,-</td>
          </tr>
          <tr class="summary">
            <th>Total</th>
            <td>Rp. <span class="currency number">{{$subtotal - $discount}}</span>,-</td>
          </tr>
        </table>
        <button type="button" class="btn btn-success" onclick="location.href = '/checkout';">CHECKOUT</button>
      </div>
    </div>
  </div>
  @endif

  <!-- If cart's empty -->
  @if(!session('cart'))
  <div class="row mt-4 mb-5">
    <div class="col">
      <div class="container">
        <img class="img-fluid" src="{{asset('img/oops-404.png')}}" alt="">
        <h2>Your cart is empty, shop now!</h2>
      </div>
    </div>
    @endif
  </div>

  <!-- End of Cart -->

  @include('layouts/footer')

  <script src="{{url('js/cart.js')}}"></script>