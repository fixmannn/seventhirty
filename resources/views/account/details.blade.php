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
            <h5 class="font-weight-bold title">Account Details</h5>
            <div class="d-flex justify-content-between btn mt-3">
                <p class="text-muted font-weight-bold active">Edit Profile</p>
                <span class="iconify text-muted active" data-icon="ic:baseline-navigate-next" data-inline="false"></span>
            </div>
            <div class="d-flex justify-content-between btn mt-1">
                <p class="text-black-50 font-weight-bold">Change Password</p>
                <span class="iconify text-black-50" data-icon="ic:baseline-navigate-next" data-inline="false"></span>
            </div>
            <div class="d-flex justify-content-between btn mt-1">
                <p class="text-black-50 font-weight-bold">Orders</p>
                <span class="iconify text-black-50" data-icon="ic:baseline-navigate-next" data-inline="false"></span>
            </div>
        </div>
        <div class="col-xl-9">
          <h5 class="font-weight-bold title">Edit Profile</h5>
          <form>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="first-name">Nama Depan</label>
                <input type="text" class="form-control" id="first-name" name="first_name">
              </div>
              <div class="form-group col-md-6">
                <label for="last-name">Nama Belakang</label>
                <input type="text" class="form-control" id="last-name" name="last_name">
              </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md">
                    <label for="address">Alamat</label>
                    <input type="text" class="form-control" id="address" name="address">
                </div>
            </div>
          </form>
        </div>
    </div>
</div>

<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>

@include('layouts/footer')