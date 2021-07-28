@extends('layouts/pages')

@section('title', 'Seven Thirty - Account Details')

@section('orders')
<link rel="stylesheet" href="{{asset('css/orders.css')}}">
@endsection

@include('layouts/nav')

{{-- Order Details --}}
<div class="details">
    <div class="row">
        <div class="col-xl-3 side-bar">
            <h5 class="font-weight-bold title">Account Details</h5>
            <a href="{{ url('/account-details') }}"><div class="d-flex justify-content-between btn mt-3">
                <p class="text-muted font-weight-bold active">Edit Profile</p>
                <span class="iconify text-muted active" data-icon="ic:baseline-navigate-next" data-inline="false"></span>
            </div></a>
            <a href="{{ url('/change-password') }}"><div class="d-flex justify-content-between btn mt-1 list-menu">
                <p class="text-list font-weight-bold">Change Password</p>
                <span class="iconify text-list" data-icon="ic:baseline-navigate-next" data-inline="false"></span>
            </div></a>
            <a href="{{ url('/orders') }}"><div class="d-flex justify-content-between btn mt-1 list-menu">
                <p class="text-list font-weight-bold">Orders</p>
                <span class="iconify text-list" data-icon="ic:baseline-navigate-next" data-inline="false"></span>
            </div></a>
        </div>
        <div class="col-xl-9">
        <div class="heading d-flex justify-content-between">
          <h5 class="font-weight-bold title">Change Password</h5>
        </div>
        @if(Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
        @endif
        @if(Session::get('fail'))
        <div class="alert alert-danger" role="alert">
          {{ Session::get('fail') }}
        </div>
        @endif
          <form action="/change-password" method="post">
            @csrf
            <div class="form-row mt-3">
              <div class="form-group col-md-5">
                <label for="old_password">Current Password</label>
                <input type="password" class="form-control" id="old_password" name="old_password">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-5">
                <label for="password">New Password</label>
                <input type="password" class="form-control" id="password" name="password">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-5">
                <label for="password_confirmation">Confirm New Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
              </div>
            </div>
            <div class="d-flex justify-content-start">
              <button class="btn btn-save text-white" type="submit">Change Password</button>
            </div>
          </form>
        </div>
    </div>
</div>

<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
<script src="{{asset('assets/jquery/jquery-3.6.0.min.js')}}"></script>


@include('layouts/footer')
