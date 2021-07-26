@extends('layouts/pages')

@section('title', 'Seven Thirty - My Order')

@section('orders')
<link rel="stylesheet" href="{{asset('css/orders.css')}}">
@endsection

@include('layouts/nav')

{{-- Order Details --}}
<div class="container">
    <div class="row">
        <div class="col-xl-6">
            <h1 class="font-weight-bold">Details of order</h1>
        </div>
        <div class="col-xl-6">
          <p>Order Number: </p>
        </div>
    </div>
</div>

@include('layouts/footer')