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
            <p class="text-muted font-weight-bold mb-0">Order Number : {{ $order['order_number'] }}</p>
          </div>
          @if($order['shipping_number'] == 0)
          <form action="/order-status" method="POST">
            <div class="ship d-flex justify-content-end">
              <label for="shipping_number">Input Tracking Number</label>
              <input type="text" id="shipping_number" name="shipping_number">
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
          @else
          <p class="text-muted d-flex justify-content-end font-weight-bold mt-0 mb-0">Tracking Number : {{ $order['shipping_number'] }}</p>
          @endif

          <h5 class="font-weight-bold title">Order Status</h5>
          <div class="progress mt-3" style="height: 10px;">
            @if($order['order_status'] == 0)
            <div class="progress-bar bg-success" role="progressbar" style="width: 28%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            @elseif($order['order_status'] == 1)
            <div class="progress-bar bg-success" role="progressbar" style="width: 55%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            @elseif($order['order_status'] == 2)
            <div class="progress-bar bg-success" role="progressbar" style="width: 77%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            @elseif($order['order_status'] == 3)
            <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            @else
            <div class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            @endif
          </div>
          <div class="progress-text d-flex justify-content-between mt-3">
            <p class="text-muted font-weight-bold" style="text-align: left">Order Placed</p>
            <p class="text-muted font-weight-bold">Waiting for Payment</p>
            <p class="text-muted font-weight-bold">Preparing to Ship</p>
            <p class="text-muted font-weight-bold">Package Sent</p>
            <p class="text-muted font-weight-bold">Delivered</p>
          </div>

          <h5 class="font-weight-bold title mt-4">Detail Products</h5>
          <table class="mt-3 table product-table">
            @foreach($product as $p)
            @foreach($detail as $d)
            @if($p['id'] == $d['product_id'])
            <tr>
              <td width="5%" style="padding-left: 0;"><img src="{{ asset('/img') }}/{{ $p['image'] }}" alt="" width="70px" class="product-img">
              </td>
              <td style="vertical-align: middle; padding-left: 0;" class="ml-1" width="65%"><span class="font-weight-bold">{{ $p['name'] }}</span><br>
                <span class="text-muted">{{ $d['size'] }} - {{ $d['quantity'] }}pcs</span></td>
                <td style="vertical-align: middle; padding-right: 0;" width="30%" class="font-weight-bold">Rp.<span class="number">{{ $d['price'] }}</span>,-</td>
              </tr>
            @endif
            @endforeach
            @endforeach
          </table>
          <div class="row">
            <div class="col-md-6">
              <h5 class="font-weight-bold title">Payment Details</h5>
              <table width="100%" class="table table-borderless">
                <tr>
                  <td>Product/s</td>
                  <td style="text-align: right">Rp.<span class="number">{{ $order['amount'] - $order['shipping_fee'] }}</span>,-</td>
                </tr>
                <tr>
                  <td>Shipping Fee</td>
                  <td style="text-align: right">Rp.<span class="number">{{ $order['shipping_fee'] }}</span>,-</td>
                </tr>
                <tr>
                  <th class="font-weight-bold">Total Payment</th>
                  <td class="font-weight-bold" style="text-align: right">Rp.<span class="number">{{ $order['amount'] }}</span>,-</td>
                </tr>
              </table>
            </div>
            <div class="col-md-6" style="font-size: 1rem;">
              <h5 class="font-weight-bold title shipping">Shipping Address</h5>
              <p class="mt-3">{{ $order['shipping_name'] }}</p>
              <p>{{ $order['shipping_address'] }}</p>
            </div>
          </div>
        </div>
    </div>
</div>

@include('layouts/footer')

<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
<script src="{{asset('assets/jquery/jquery-3.6.0.min.js')}}"></script>


<script>
    const price = document.querySelectorAll('.number');

    window.addEventListener('load', function() {
        price.forEach((val, index) => {
            valInner = val.innerHTML;
            val.innerHTML = parseFloat(valInner).toLocaleString('id');
        });
    });
</script>