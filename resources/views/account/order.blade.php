@extends('layouts/pages')

@section('title', 'Seven Thirty - My Order')

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
                <p class="text-list font-weight-bold active">Edit Profile</p>
                <span class="iconify text-list active" data-icon="ic:baseline-navigate-next" data-inline="false"></span>
            </div></a>
            <a href="{{ url('/change-password') }}"><div class="d-flex justify-content-between btn mt-1 list-menu">
                <p class="text-list font-weight-bold">Change Password</p>
                <span class="iconify text-list" data-icon="ic:baseline-navigate-next" data-inline="false"></span>
            </div></a>
            <a href="{{ url('/orders') }}"><div class="d-flex justify-content-between btn mt-1 list-menu">
                <p class="text-muted font-weight-bold">Orders</p>
                <span class="iconify text-muted" data-icon="ic:baseline-navigate-next" data-inline="false"></span>
            </div></a>
        </div>
        <div class="col-xl-9">
          <div class="heading d-flex justify-content-between">
            <h5 class="font-weight-bold title">Order Detail</h5>
            <p class="text-muted font-weight-bold mb-0">Order Number : 2021928904F</p>
          </div>
            <p class="text-muted d-flex justify-content-end font-weight-bold mt-0 mb-0">Tracking Number : 920581085102</p>
            <a href="https://cekresi.com/" class="text-primary d-flex justify-content-end font-weight-bold mt-0 mb-0">Track your package</a>

          <h5 class="font-weight-bold title">Order Status</h5>
          <div class="progress mt-3" style="height: 10px;"> 
          <div class="progress-bar bg-success" role="progressbar" style="width: 54%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div class="progress-text d-flex justify-content-between mt-3">
            <p class="text-muted font-weight-bold">Order Placed</p>
            <p class="text-muted font-weight-bold">Waiting for Payment</p>
            <p class="text-muted font-weight-bold">Preparing to Ship</p>
            <p class="text-muted font-weight-bold">Package Sent</p>
            <p class="text-muted font-weight-bold">Delivered</p>
          </div>

          <h5 class="font-weight-bold title mt-4">Detail Products</h5>
          <table class="mt-3 table product-table">
            <tr>
              <td width="5%" style="padding-left: 0;"><img src="{{ asset('/img/anxiety.jpg') }}" alt="" width="70px" class="product-img">
              </td>
              <td style="vertical-align: middle; padding-left: 0;" class="ml-1" width="65%"><span class="font-weight-bold">Anxiety Disorder</span><br>
              <span class="text-muted">XL - 1 pcs</span></td>
              <td style="vertical-align: middle; padding-right: 0;" width="30%" class="font-weight-bold"><span>Rp. 180.000,-</span></td>
            </tr>
          </table>
          <div class="row">
            <div class="col-md-6">
              <h5 class="font-weight-bold title">Payment Details</h5>
              <table width="100%" class="table table-borderless">
                <tr>
                  <td>Payment Method</td>
                  <td>Mandiri Virtual Account</td>
                </tr>
                <tr>
                  <td>Product/s</td>
                  <td>Rp. 171.000,-</td>
                </tr>
                <tr>
                  <td>Shipping Fee</td>
                  <td>Rp. 9.000,-</td>
                </tr>
                <tr>
                  <th class="font-weight-bold">Total Payment</th>
                  <td class="font-weight-bold">Rp. 180.000,-</td>
                </tr>
              </table>
            </div>
            <div class="col-md-6">
              <h5 class="font-weight-bold title shipping">Shipping Address</h5>
              <p class="mt-3">Haliza Nuradila</p>
              <p>Jalan Haji Nur Lela ya nona No. 28, Kec. Cirendeu
                Ciputat Timur, Tangerang Selatan
                150912</p>
            </div>
          </div>
        </div>
    </div>
</div>

@include('layouts/footer')

<script src="{{asset('assets/jquery/jquery-3.6.0.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $('.order-r ow').click(function() {
            window.location = $(this).data('href');
        });
    });
</script>

<script>
    const price = document.querySelectorAll('.number');

    window.addEventListener('load', function() {
        price.forEach((val, index) => {
            valInner = val.innerHTML;
            val.innerHTML = parseFloat(valInner).toLocaleString('id');
        });
    });
</script>