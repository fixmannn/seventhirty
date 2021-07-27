@extends('layouts/pages')

@section('title', 'Seven Thirty - Account Details')

@section('orders')
<link rel="stylesheet" href="{{asset('css/orders.css')}}">
@endsection

@include('layouts/nav')

{{-- Order Details --}}
<div class="container details">
    <div class="row">
        <div class="col-xl-3">
            <h3 class="font-weight-bold">Account Details</h3>
            <div>
                <p class="text-muted font-weight-bold">Edit Profile</p>
                <span class="iconify text-muted" data-icon="ic:baseline-navigate-next" data-inline="false"></span>
            </div>
        </div>
        <div class="col-xl-9">
          <h3 class="font-weight-bold">Edit Profile</h3>
        </div>
    </div>
</div>

<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>

@include('layouts/footer')