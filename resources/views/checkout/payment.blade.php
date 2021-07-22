@extends('layouts/pages')

@section('title', "Seven Thirty - Payment Request")

@section('paymentcss')
<link rel="stylesheet" href="{{asset('css/payment.css')}}">
@endsection

@include('layouts/nav')

@php
    $payment = Session::get('payment');
    $expiration = Session::get('expiration');
    require_once(public_path('/phpqrcode/qrlib.php'));
@endphp


<div class="payment">
  <div class="container">
  <div class="row">
    <div class="col-xl-12">
      <h2 class="text-center payment-title">Your order is confirmed</h2>
      @if($expiration['type'] == 'va' || $expiration['type'] == 'qris')
      {{-- Virtual Account Payment --}}
      <h5 class="text-muted text-center">Order No. {{ $payment['external_id'] }}</h5>
      </div>
      <div class="col-xl-12 mt-5">
        <div class="card text-center">
          <div class="card-body">
            <h3 class="card-title">Selesaikan pembayaranmu dalam</h3>
            <h2 class="countdown font-weight-bold mt-4 mb-4 text-danger">{{ $expiration['timestamp'] }}</h2>
            <p class="card-text text-muted">Batas akhir pembayaran</p>
            <h5 class="expiration font-weight-bold">{{ $expiration['date'] }}</h5>
            <a href="/payment-success" class="btn btn-success btn-lg">Cek status pembayaran</a>
            <p class="text-muted mt-2"><i>*Jika diarahkan kembali ke halaman yang sama, artinya pembayaranmu belum berhasil.</i></p>
          </div>
        </div>
      </div>
      @else 
      {{-- e-Wallets Payment --}}
      <h5 class="text-muted text-center">Order No. {{ $payment['reference_id'] }}</h5>
      </div>
      @if($payment['channel_code'] == 'ID_OVO')
      {{-- OVO Payment --}}
      <div class="col-xl-12 mt-5 mb-5">
        <div class="card text-center">
          <div class="card-body">
            <h3 class="card-title mt-3">Cek notifikasi di Handphone mu, dan selesaikan pembayaran</h3>
            <div class="col-xl-12 mt-5 mb-5">
              <img src="{{ asset('/img/payment/ovo_mockup.png') }}" alt="" width="40%" class="mr-3">
              <img src="{{ asset('/img/payment/ovo_mockup2.png') }}" alt="" width="40%">
            </div>
            <p class="text-muted mt-5">Total Pembayaran</p>
            <h4 class="font-weight-bold mb-5">Rp. <span class="amount number" id="number">{{ $payment['charge_amount'] }}</span>,-</h4>
            <a href="/payment-success" class="btn btn-success mb-5 btn-lg">Cek status pembayaran</a>
            <p class="text-muted mt-2"><i>*Jika diarahkan ke halaman yang checkout, artinya pembayaranmu gagal.</i></p>
          </div>
        </div>
      @elseif($payment['channel_code'] == 'ID_SHOPEEPAY')
      {{-- Shopee Pay Payment --}}
      @php
          QRcode::png($payment['actions']['qr_checkout_string'], $payment['reference_id'].".png","M",3,3);
      @endphp
      <div class="col-xl-12 mt-5">
        <div class="card text-center">
          <div class="card-body">
            <h3 class="card-title">Selesaikan pembayaranmu dalam</h3>
            <h2 class="countdown font-weight-bold mt-4 mb-4 text-danger">{{ $expiration['timestamp'] }}</h2>
            <p class="card-text text-muted">Batas akhir pembayaran</p>
            <h5 class="expiration font-weight-bold">{{ $expiration['date'] }}</h5>
            <div class="mb-3 mt-4">
            <a href="/payment-success" class="btn btn-success btn-lg">Cek status pembayaran</a>
            <p class="text-muted mt-2"><i>*Jika diarahkan kembali ke halaman yang sama, artinya pembayaranmu belum berhasil.</i></p>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <ul class="list-group align-item-center">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <b>METODE PEMBAYARAN</b>
            <span class="badge badge-pill"><img src="{{ asset('/img/payment/') }}/{{ $expiration['method'] }}.png" width="60"></span>
          </li>
        </ul>
          <div class="card text-center">
          <div class="card-body">
            <h5>Scan barcode ini untuk melakukan pembayaran ShopeePay mu atau klik tombol Lanjutkan Pembayaran</h5>
            <img src="{{ $payment['reference_id'] }}.png" alt="">
            <p class="text-muted mt-3">Total Pembayaran</p>
            <h4 class="font-weight-bold">Rp. <span class="amount" id="number">{{ $payment['charge_amount'] }}</span>,-</h4>
            <a href="{{ $payment['actions']['mobile_deeplink_checkout_url'] }}" class="btn btn-success btn-lg" target="_blank">Lanjutkan pembayaran</a>
          </div>
        </div>
      </div>
      @else 
      {{-- DANA & LINK AJA Payment --}}
      <div class="col-xl-12 mt-5">
        <div class="card text-center">
          <div class="card-body">
            <h3 class="card-title">Selesaikan pembayaranmu dalam</h3>
            <h2 class="countdown font-weight-bold mt-4 mb-4 text-danger">{{ $expiration['timestamp'] }}</h2>
            <p class="card-text text-muted">Batas akhir pembayaran</p>
            <h5 class="expiration font-weight-bold">{{ $expiration['date'] }}</h5>
            <div class="mb-3 mt-4">
            <a href="/payment-success" class="btn btn-success btn-lg">Cek status pembayaran</a>
            <p class="text-muted mt-2"><i>*Jika diarahkan kembali ke halaman yang sama, artinya pembayaranmu belum berhasil.</i></p>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <ul class="list-group align-item-center">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <b>METODE PEMBAYARAN</b>
            <span class="badge badge-pill"><img src="{{ asset('/img/payment/') }}/{{ $expiration['method'] }}.png" width="50"></span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <span>
            <p class="text-muted">Total Pembayaran</p>
            <h4 class="font-weight-bold">Rp. <span class="amount" id="number">{{ $payment['charge_amount'] }}</span>,-</h4>
            </span>
            <a href="{{ $payment['actions']['desktop_web_checkout_url'] }}" class="btn btn-success" target="_blank">Lanjutkan pembayaran</a>
          </li>
        </ul>
      </div>
      @endif
      @endif
    </div>
    </div>

  
  @if($expiration['type'] == 'va')
  {{-- Detail virtual account --}}
  <div class="container">
    <ul class="list-group align-item-center">
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <b>{{ strtoupper($expiration['method']) }} VIRTUAL ACCOUNT</b>
        <span class="badge badge-pill"><img src="{{ asset('/img/payment/') }}/{{ $expiration['method'] }}.png" width="40"></span>
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <span>
        <p class="text-muted">Nomor Virtual Account</p>
        <h4 class="font-weight-bold">{{ $payment['account_number'] }}</h4>
        <input type="text" value="{{ $payment['account_number'] }}" class="account_number">
        </span>
        <button class="btn btn-success" onclick="copyNumber()"><i class="bi bi-clipboard" data-container="body" data-toggle="popover" data-placement="right" data-content="Copied"></i> Copy</button>
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <span>
        <p class="text-muted">Total Pembayaran</p>
        <h4 class="font-weight-bold">Rp. <span class="amount" id="number">{{ $payment['expected_amount'] }}</span>,-</h4>
        <input type="text" value="{{ $payment['expected_amount'] }}" class="expected_amount">
        </span>
        <button class="btn btn-success" onclick="copyPrice()"><i class="bi bi-clipboard"></i> Copy</button>
      </li>
    </ul>

  @if($expiration['method'] == 'bni')
    @include('checkout/payment-bni')
  @elseif($expiration['method'] == 'mandiri')
    @include('checkout/payment-mandiri')
  @elseif($expiration['method'] == 'bri')
    @include('checkout/payment-bri')
  @elseif($expiration['method'] == 'permata')
    @include('checkout/payment-permata')
  @endif
  </div>
  @endif

  @if($expiration['type'] == 'qris')
  @php
          QRcode::png($payment['qr_string'], $payment['external_id'].".png","M",3,3);
  @endphp
  <div class="container">
    <ul class="list-group align-item-center">
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <b>METODE PEMBAYARAN</b>
        <span class="badge badge-pill"><img src="{{ asset('/img/payment/bca.png') }}" width="60"></span>
      </li>
    </ul>
      <div class="card text-center">
      <div class="card-body">
        <h5>Scan barcode ini untuk melakukan pembayaran dengan scan QR BCA mu</h5>
        <img src="{{ $payment['external_id'] }}.png" alt="">
        <p class="text-muted mt-3">Total Pembayaran</p>
        <h4 class="font-weight-bold">Rp. <span class="amount" id="number">{{ $payment['amount'] }}</span>,-</h4>
        {{-- <a href="{{ $payment['actions']['mobile_deeplink_checkout_url'] }}" class="btn btn-success btn-lg" target="_blank">Lanjutkan pembayaran</a> --}}
      </div>
    </div>
  </div>
  @endif


</div>

@include('layouts/footer')

<script src="{{asset('js/countdown.js')}}"></script>


<script>
// Currency Format
const priceInner = document.getElementById('number').innerText;
const price = document.getElementById('number');

window.addEventListener('load', function() {
    price.innerHTML = parseFloat(priceInner).toLocaleString('id');
});

// Copy text
function copyNumber() {
  const account_number = document.querySelector('.account_number');
  account_number.select();
  document.execCommand("copy");
  account_number.style.display = "none"; 
  alert('text copied');
}

function copyPrice() {
  const expected_amount = document.querySelector('.expected_amount');
  expected_amount.select();
  document.execCommand("copy");
  expected_amount.style.display = "none";
  alert('text copied');
}
</script>

<script src="{{asset('assets/jquery/jquery-3.6.0.min.js')}}"></script>