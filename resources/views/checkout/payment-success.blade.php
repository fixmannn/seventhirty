@extends('layouts/pages')

@section('title', "Seven Thirty - Completed Payment")

@include('layouts/nav')

@section('paymentcss')
<link rel="stylesheet" href="{{asset('css/payment.css')}}">
@endsection

<div class="container text-center payment-success">
  <img src="{{ asset('/img/payment/success.svg') }}" alt="" class="img-fluid paymentimg" width="50%">
  <h4 class="mt-5 font-weight-bold">Your payment is successful!</h4>
  <p>Thank you for your payment, an automated payment receipt will be sent to your registered email.</p>
</div>



@include('layouts/footer')