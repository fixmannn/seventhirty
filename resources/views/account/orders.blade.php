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
                <p class="text-muted font-weight-bold">Change Password</p>
                <span class="iconify text-muted" data-icon="ic:baseline-navigate-next" data-inline="false"></span>
            </div></a>
            <a href="{{ url('/orders') }}"><div class="d-flex justify-content-between btn mt-1 list-menu">
                <p class="text-list font-weight-bold">Orders</p>
                <span class="iconify text-list" data-icon="ic:baseline-navigate-next" data-inline="false"></span>
            </div></a>
        </div>
        <div class="col-xl-9">
        <div class="heading d-flex justify-content-between">
          <h5 class="font-weight-bold title">Orders</h5>
        </div>
        <table class="table mt-3">
            <thead class="thead-success">
              <tr>
                <th scope="col">Order No.</th>
                <th scope="col">Order Status</th>
                <th scope="col">Order Date</th>
                <th scope="col">Amount</th>
              </tr>
            </thead>
            <tbody>
            @foreach($order as $id => $orders)
            <a href="{{ url('/order/')$order_number }}">
              <tr>
                <th>{{ $orders->order_number }}</th>
                <td>
                    @if($orders->order_status == 0)
                    Menunggu Pembayaran
                    @elseif($orders->order_status == 1)
                    Paket Siap Dikirim
                    @elseif($orders->order_status == 2)
                    Paket Sedang Menuju Lokasi Anda
                    @elseif($orders->order_status == 3)
                    Paket Sudah Diterima
                    @elseif($orders->order_status == 4)
                    Order gagal (Pembayaran tidak diselesaikan)
                    @endif
                </td>
                <td>{{ $orders->created_at }}</td>
                <td>Rp. <span class="number">{{ $orders->amount }}</span>,-</td>
              </tr>
            </a>
              @endforeach
            </tbody>
          </table>
        </div>
    </div>
</div>

@include('layouts/footer')

<script>
    const price = document.querySelectorAll('.number');

    window.addEventListener('load', function() {
        price.forEach((val, index) => {
            valInner = val.innerHTML;
            val.innerHTML = parseFloat(valInner).toLocaleString('id');
        });
    });
</script>