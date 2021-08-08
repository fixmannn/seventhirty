<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Seven Thirty - Order Mail</title>
  <style>
    body {
      margin: 0;
      padding: 0;
    }
    .container {
      margin: auto;
    }
    
    .container img, h2 {
      display: block;
      margin: 0 auto;
      max-width: 40%;
    }

    h2 {
      text-align: center;
    }

    table {
      margin: 0 auto;
      padding: 20px;
      width: 500px;
    }

    tr th {
      padding: 10px;
    }

    th {
      text-align: left;
      font-weight: normal;
    }
    
    td {
      text-align: right;
    }

    .button {
      margin: 0 auto;
      max-width: 450px;
      height: 50px;
      background-color: #92b6b1;
      color: white;
      font-weight: bold;
      border-radius: 2px;
      text-align: center;
      line-height: 50px;
    }

    .card-body li, h4, h3 {
      margin-left: auto;
      margin-right: auto;
      max-width: 470px;
    }

    p.message {
      margin-left: auto;
      margin-right: auto;
      width: 470px;
    }

    @media screen and (min-width: 728px) {
      .container img {
        max-width: 20%;
      }
    }
  </style>
</head>
@php
    $expiration = session('expiration');
    $payment = session('payment');
    $guest = session('guest');
@endphp

<body>
  <div class="container">
    <img src="https://bit.ly/custpayment" alt="">
    <h2>Order Berhasil Dibayar!</h2>
    @if(Session::get('guest'))
    <p class="message">{{ $guest['nama_depan'] }} {{ $guest['nama_belakang'] }}, ordermu sudah berhasil dibayar! Lihat detail nya di bawah ini:</p>
    @else
    <p class="message">{{ $details[0]['nama_depan'] }} {{ $details[0]['nama_belakang'] }}, ordermu sudah berhasil dibayar! Lihat detail nya di bawah ini:</p>
    @endif
    <table>
      <tr>
        <th class="header" style="font-weight: bold">Order No. {{ session('order_number') }}</th>
        <td></td>
      </tr> 
      <tr>
        <th>Nama</th>
        @if(Session::get('guest'))
        <td>{{ $guest['nama_depan'] }} {{ $guest['nama_belakang'] }}</td>
        @else
        <td>{{ $details[0]['nama_depan'] }} {{ $details[0]['nama_belakang'] }}</td>
        @endif
      </tr>
      <tr>
        <th>Tanggal order</th>
        <td>{{ $order[0]['updated_at'] }}</td>
      </tr> 
      <tr>
        <th>Metode Pembayaran</th>
        <td>{{ strtoupper($expiration['method']) }}</td>
      </tr>
      <tr>
        <th class="header" style="font-weight: bold">Detail Pembayaran</th>
        <td></td>
      </tr> 
      <tr>
        <th>Produk</th>
        <td>Rp. {{ $order[0]['amount'] - $order[0]['shipping_fee']}},-</td>
      </tr>
      <tr>
        <th>Ongkos Kirim</th>
        <td>Rp. {{ $order[0]['shipping_fee']}},-</td>
      </tr>
      <tr style="font-weight: bold">
        <th style="font-weight: bold">Total Pembayaran</th>
        <td>Rp. {{ $order[0]['amount'] }},-</td>
      </tr>
    </table>
    <a href="{{ url('/order') }}/{{ $order[0]['order_number'] }}" style="text-decoration: none;">
    <div class="button">
      LIHAT ORDER
    </div>
    </a>
  </div>
</body>
</html>