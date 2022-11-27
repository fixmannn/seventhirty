@extends('layouts/pages')

@section('title', 'Seven Thirty - Gallery')

@section('orders')
<link rel="stylesheet" href="{{asset('css/orders.css')}}">
@endsection

@include('layouts/nav')

<!-- Our Gallery -->
<div class="container details">
  <div class="row">
    <div class="col-6">
      <h3 class="font-weight-bold">Account Details</h3>
      
    </div>
    <div class="col-6">
      <h3 class="font-weight-bold">Edit Profile</h3>
    </div>
  </div>
</div>

@include('layouts/footer')