@extends('layouts/pages')

@section('title', 'Seven Thirty - Account Details')

@section('orders')
<link rel="stylesheet" href="{{asset('css/orders.css')}}">
@endsection

@include('layouts/nav')

{{-- Order Details --}}
<div class="details">
    <div class="row">
        <div class="col-xl-3">
            <h3 class="font-weight-bold shadow">Account Details</h3>
            <div class="d-flex justify-content-between btn mt-3">
                <p class="text-muted font-weight-bold active">Edit Profile</p>
                <span class="iconify text-muted active" data-icon="ic:baseline-navigate-next" data-inline="false"></span>
            </div>
            <div class="d-flex justify-content-between btn mt-3">
                <p class="text-muted font-weight-bold">Change Password</p>
                <span class="iconify text-muted" data-icon="ic:baseline-navigate-next" data-inline="false"></span>
            </div>
            <div class="d-flex justify-content-between btn mt-3">
                <p class="text-muted font-weight-bold">Orders</p>
                <span class="iconify text-muted" data-icon="ic:baseline-navigate-next" data-inline="false"></span>
            </div>
        </div>
        <div class="col-xl-9">
          <h3 class="font-weight-bold shadow">Edit Profile</h3>
          
        </div>
    </div>
</div>

<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>

@include('layouts/footer')