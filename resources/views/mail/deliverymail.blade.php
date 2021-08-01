
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
      background-color: rgb(4, 161, 4);
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
    <h2>Order {{ $order['shipping_number'] }} Sedang Dalam Perjalanan</h2>
    <p class="message">{{ $order['name'] }}, sedang dalam perjalanan nih, yuk sit tight and wait for the package to come.</p>
    <table>
      <tr>
        <th class="header" style="font-weight: bold">Order No. {{ $order['order_number'] }}</th>
        <td></td>
      </tr> 
      <tr>
        <th>Nama</th>
        <td>{{ $order['shipping_name'] }}</td>
      </tr>
      <tr>
        <th>Metode Pengiriman</th>
        <td>JNE REG</td>
      </tr> 
      <tr>
        <th>Nomor Resi</th>
        <td>{{ $order['shipping_number'] }}</td>
      </tr> 
      <tr>
        <th>Alamat Penerima</th>
        <td>{{ $order['shipping_address'] }}</td>
      </tr> 
    </table>
    <a href="" style="text-decoration: none;">
    <div class="button">
      LIHAT ORDER
    </div>
    </a>
  </div>
</body>
</html>