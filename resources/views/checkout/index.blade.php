@extends('layouts/pages')

@section('title', "Seven Thirty - Checkout")

@section('checkoutcss')
<link rel="stylesheet" href="{{asset('css/checkout.css')}}">
<link rel="stylesheet" href="{{asset('assets/select2-4.0.6-rc.1/dist/css/select2.min.css')}}">
@endsection

@include('layouts/nav')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/" class="text-body">Home</a></li>
    <li class="breadcrumb-item"><a href="/shop" class="text-body">Shop</a></li>
    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
  </ol>
</nav>
<!-- End of Breadcrumbs -->


<!-- Billing Details -->
<div class="billing align-items-center">
  <div class="row">
    <div class="col-xl-12">
      <h2>Checkout</h2>
    </div>
  </div>

  @if(!Session::get('LoggedUser'))
  <form action="/payment" method="post"> 
    <div class="guest">
      @method('patch')
    </div>
    @csrf
    @else
    <form action="/payment" method="post">
      @method('patch')
      @csrf
      @endif
      <div class="row">
        <div class="col-md-7">
          <h3 class="summary mb-3">Shipping Details</h3>
          <p class="text-muted"><i>Shipping address will be saved to your account</i></p>
          @error('email')
          <div class="alert alert-danger">
            {{ $message }}
          </div>
          @enderror
          @error('password')
          <div class="alert alert-danger">
            {{ $message }}
          </div>
          @enderror
          <hr>
        </div>
        @if(!Session::get('LoggedUser'))
        <div class="col-md-7">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="first-name">Nama Depan<span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="first-name" name="first_name" required value="">
            </div>
            <div class="form-group col-md-6">
              <label for="last-name">Nama Belakang<span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="last-name" name="last_name" required value="">
            </div>
          </div>
          <div class="form-group">
            <label for="address">Alamat Lengkap<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Masukkan alamat lengkap" required value="">
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <!-- Hidden Origin -->
              <label for="province_destination">Provinsi<span class="text-danger">*</span></label>
              <select id="province_destination" class="form-control" name="province_destination" required>
                <option>Pilih Provinsi</option>
                @foreach($provinces as $province => $value)
                <option value="{{$value}}" provid="{{$province}}">{{$value}}</option>
                @endforeach
              </select>
              <img src="../img/loading.gif" width="35" id="load1" style="display:none;" />
            </div>
            <div class="form-group col-md-4 CityDiv">
              <label for="city_destination">Kota/Kabupaten<span class="text-danger">*</span></label>
              <select name="city_destination" class="form-control" id="city_destination" required>
                <option>Pilih kota</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="district">Kecamatan<span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="district" name="district" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="email">Email<span class="text-danger">*</span>
            </label>
              <input type="email" class="form-control" id="email" name="email" required value="">
            </div>
            <div class=" form-group col-md-6">
              <label for="phonenumber">No. Handphone / Whatsapp<span class="text-danger">*</span></label>
              <input type="number" class="form-control" id="phonenumber" name="phonenumber" required value="">
            </div>
          </div>
          <div class=" form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="gridCheck" name="gridCheck">
              <label class="form-check-label" for="gridCheck">
                Create an account
              </label>
            </div>
          </div>
          <div class="form-row password-row" style="display: none;">
            <div class="form-group col-md-12">
              <label for="password">Password<span class="text-danger">*</span>
              </label>
              <p class="text-muted"><i>password minimal mengandung 8 karakter, angka, dan huruf kapital</i></p>
              <input type="password" class="form-control pwinput" id="password" name="password">
            </div>
            <div class="form-group col-md-12">
              <label for="password_confirmation">Confirm Password<span class="text-danger">*</span></label>
              <input type="password" class="form-control pwinput2" id="password_confirmation" name="password_confirmation">
            </div>
          </div>
        </div>
        @endif

        @if(Session::get('LoggedUser'))
        <div class="col-md-7">
          <div class="form-row">
            <div class="form-group col-md-6">
              <!-- Hidden Input -->
              <input type="hidden" name="id" value="{{Session::get('LoggedUser')}}">
              <label for="first-name">Nama Depan<span class="text-danger">*</span></label>

              <input type="text" class="form-control" id="first-name" name="first_name" required value="{{$user->nama_depan}}">
            </div>
            <div class="form-group col-md-6">
              <label for="last-name">Nama Belakang<span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="last-name" name="last_name" required value="{{$user->nama_belakang}}">
            </div>
          </div>
          <div class="form-group">
            <label for="address">Alamat Lengkap<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Masukkan alamat lengkap" required value="{{$user->alamat}}">
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="province_destination">Provinsi<span class="text-danger">*</span></label>
              <select id="province_destination" class="form-control" name="province_destination" required>
                <option>Pilih Provinsi</option>
                @foreach($provinces as $province => $value)
                <option value="{{$value}}" provid="{{$province}}">{{$value}}</option>
                @endforeach
              </select>
              <img src="../img/loading.gif" width="35" id="load1" style="display:none;" />
            </div>
            <div class="form-group col-md-4 CityDiv">
              <label for="city_destination">Kota/Kabupaten<span class="text-danger">*</span></label>
              <select name="city_destination" class="form-control" id="city_destination" required>
                <option>Pilih kota</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="district">Kecamatan<span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="district" name="district" required value="{{$user->kecamatan}}">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="email">Email<span class="text-danger">*</span></label>
              <input type="email" class="form-control" id="email" name="email" required value="{{$user->email}}" readonly>
            </div>
            <div class=" form-group col-md-6">
              <label for="phonenumber">No. Handphone / Whatsapp<span class="text-danger">*</span></label>
              <input type="number" class="form-control" id="phonenumber" name="phonenumber" required value="{{$user->nomor_handphone}}">
            </div>
            <div class="form-group col-md-12">
              @if(Session::get('fail'))
              <div class="alert alert-danger">
                {{ Session::get('fail') }}
              </div>
              @endif
            </div>
          </div>
        </div>
        @endif

        <!-- Order Summary -->
        <div class="col-md-5">
          <div class="order-summary">
            <table class="cart-summary">
              <tr class="summary">
                <th>Your Cart</th>
                <td></td>
              </tr>
              <?php $subtotal = 0 ?>
              <?php $total = 0 ?>
              @foreach(session('cart') as $id => $details)
              <?php $subtotal += $details['quantity'] * ($details['price'] - $details['discount_amount']) ?>
              <tr>
                <th><span>{{$details['name'] . ' - ' . $details['category'] . ' - ' . $details['size']}} ({{ $details['quantity'] }} pcs)</span></th>
                <td>Rp. <span class="currency">{{$details['quantity'] * ($details['price'] - $details['discount_amount'])}} </span>,-</td>
              </tr>
              @endforeach
            </table>
            <table class="total-summary">
              <tr class="summary">
                <th>Order Summary</th>
                <td class="text-muted">#<span>{{$order_number}}</span></td>
              </tr>
              <tr>
                <th>Subtotal</th>
                <td id="subtotal" data-subtotal="{{$subtotal}}">Rp. <span class="currency">{{$subtotal}}</span>,-</td>
              </tr>
              <tr>
                <th>Shipping (JNE REG)</th>
                <td>Rp. 
                  <span class="shipping currency">0</span>,-
                  <input type="hidden" id="shipping">
                </td>
              </tr>
              <tr class="summary">
                <th>Total</th>
                <td>Rp. 
                  <span id="total" class="currency total">0</span>,-
                  <input type="hidden" id="totalz">
                </td>
              </tr>
            </table>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
              Pilih Metode Pembayaran
            </button>
          </div>

          <!-- Modal -->
          @include('checkout/payment-modal')
        </div>
      </div>
    </form>
</div>
<!-- End of Billing Details -->



@include('layouts/footer')

<!-- Script -->



<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="{{asset('assets/jquery/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/select2-4.0.6-rc.1/dist/js/select2.min.js')}}"></script>
<script src="{{asset('assets/select2-4.0.6-rc.1/dist/js/i18n/id.js')}}"></script>

<script>
  $('#myModal').on('shown.bs.modal', function() {
    $('#myInput').trigger('focus')
  })

  $('#ovo').on('change', function() {
    if ($('#ovo:checked')) {
      $('#ovo_number').prop('type', 'number');
    } else {
      $('#ovo_number').prop('type', 'hidden');
    }
  });
</script>


<script>
  $(document).ready(function() {
    $('select[name="province_destination"]').on('change', function() {
      // let provinceId = $(this).val();
      let provinceId = $('option:selected', this).attr('provid');
      // console.log(provinceId);
      if (provinceId) {
        $.ajax({
          url: '/province/' + provinceId,
          type: "GET",
          dataType: "json",
          success: function(data) {
            $('select[name="city_destination"]').empty();
            $.each(data, function(key, value) {
              $('select[name="city_destination"]').append('<option cityid="' + key + '" value="' + value + '">' + value + '</option>');
            });
          },
        });
      } else {
        $('select[name="city_destination"]').empty();
      }
    });

    $('select[name="city_destination"]').on('change', function() {
      let cityId = $('option:selected', this).attr('cityid');
      let subtotalRaw = document.querySelector('#subtotal').getAttribute('data-subtotal');
      let total = document.querySelector('#total').innerText;

      const subtotal = parseInt(subtotalRaw);

      if (cityId) {
        $.ajax({
          url: '/shipping/' + cityId,
          type: "GET",
          dataType: 'html',
          success: function(data) {
            $('.shipping').html(data);
            let shippingRaw = data;
            let shipping = Number(shippingRaw);

            $('#total').text(subtotal + shipping);
            $('#totalz').attr('value', subtotal + shipping);
            $('#totalz').attr('name', 'amount');
            $('#shipping').attr('name', 'shipping');
            $('#shipping').attr('value', shipping);


            const finalTotal = $('#total').text();
            // numberFormatter.format(parseInt(finalTotal)).replace(/\D00$/, '');
            Number(finalTotal);
            shipping.toLocaleString('id');
            finalTotal.toLocaleString('id');
          },
        });
      } else {
        console.log('error');
      }
    });

    if ( ! $('input[name="payment"]').is(':checked') ) {
      $("#payment-btn").hide();
    } 

    if ($('input[name="payment"]').change(function() {
      $("#payment-btn").show();
    }));
  });


</script>


<script src="{{asset('js/checkout.js')}}"></script>