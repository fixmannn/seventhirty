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

    @media screen and (min-width: 728px) {
      .container img {
        max-width: 20%;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <img src="https://image.freepik.com/free-vector/add-cart-concept-illustration_114360-1435.jpg" alt="">
    <h2>Hello, ada orderan masuk nih, yuk buruan di proses!</h2>
    <table>
      <tr>
        <th class="header" style="font-weight: bold">Order No. {{ session('order_number') }}</th>
        <td></td>
      </tr>
      @php
          $guest = session('guest')
      @endphp
      @if(Session::get('guest'))
      <tr>
        <th>Nama</th>
        <td>{{ $guest['nama_depan'] }} {{ $guest['nama_belakang'] }}</td>
      </tr>
      <tr>
        <th>Alamat</th>
        <td>{{ $guest['alamat'] }} <br>
        {{ $guest['kecamatan'] }} <br>
        {{ $guest['kota'] }}</td>
      </tr> 
      <tr>
        <th>No. Handphone</th>
        <td>{{ $guest['nomor_handphone'] }}</td>
      </tr>
      <tr>
        <th>Email</th>
        <td>{{ $guest['email'] }}</td>
      </tr>
      @else
      <tr>
        <th>Nama</th>
        <td>{{ $details[0]['nama_depan'] }} {{ $details[0]['nama_belakang'] }}</td>
      </tr>
      <tr>
        <th>Alamat</th>
        <td>{{ $details[0]['alamat'] }} <br>
        {{ $details[0]['kecamatan'] }} <br>
        {{ $details[0]['kota'] }}</td>
      </tr> 
      <tr>
        <th>No. Handphone</th>
        <td>{{ $details[0]['nomor_handphone'] }}</td>
      </tr>
      <tr>
        <th>Email</th>
        <td>{{ $details[0]['email'] }}</td>
      </tr>
      @endif
      <tr>
        <th class="header" style="font-weight: bold">Items</th>
      </tr>
      @foreach(session('cart') as $id => $item)
      <tr>
        <td class="item" style="text-align: left">{{ $item['name'] }}</td>
        <td>Size {{ $item['size'] }}, {{ $item['quantity'] }} pcs</td>
      </tr>
      @endforeach
      <tr style="font-weight: bold">
        <th style="font-weight: bold">Biaya Ongkir</th>
        <td>Rp. {{ $order[0]['shipping_fee'] }},-</td>
      </tr>
      <tr style="font-weight: bold">
        <th style="font-weight: bold">Total Pembayaran</th>
        <td>Rp. {{ $order[0]['amount'] }},-</td>
      </tr>
    </table>
  </div>
</body>
</html>