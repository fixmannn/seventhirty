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
          <h5 class="font-weight-bold title">Edit Profile</h5>
          <span class="font-weight-bold edit-form">Edit</span>
        </div>
        @if(Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
        @endif
          <form action="/account-details" method="post">
            @csrf
            <div class="form-row mt-3">
              <div class="form-group col-md-6">
                <label for="first-name">Nama Depan</label>
                <input type="text" class="form-control" id="first-name" name="first_name" data-form="form" value="{{ $user->nama_depan }}" readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="last-name">Nama Belakang</label>
                <input type="text" class="form-control" id="last-name" name="last_name" data-form="form" value="{{ $user->nama_belakang }}" readonly>
              </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md">
                    <label for="address">Alamat</label>
                    <input type="text" class="form-control" id="address" name="address" height="130px" data-form="form" value="{{ $user->alamat }}" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="province_destination">Provinsi</label>
                    <input type="text" class="form-control" id="province_destination" name="province_destination" data-form="form" value="{{ $user->provinsi }}" readonly>
                </div>
                <div class="form-group col-md-4">
                    <label for="city_destination">Kota</label>
                    <input type="text" class="form-control" id="city_destionation" name="city_destination" data-form="form" value="{{ $user->kota }}" readonly>
                </div>
                <div class="form-group col-md-4">
                    <label for="district">Kecamatan</label>
                    <input type="text" class="form-control" id="district" name="district" data-form="form" value="{{ $user->kecamatan }}" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}" readonly >
                </div>
                <div class="form-group col-md-6">
                    <label for="phonenumber">No. Handphone / Whatsapp</label>
                    <input type="number" class="form-control" name="phonenumber" id="phonenumber" data-form="form" value="{{ $user->nomor_handphone }}" readonly>
                </div>
            </div>
            <div class="buttons justify-content-end">
                <button class="btn btn-secondary mr-3 discard" type="button">Discard</button>
                <button class="btn btn-save text-white" type="submit">Save Changes</button>
            </div>
          </form>
        </div>
    </div>
</div>

<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
<script src="{{asset('assets/jquery/jquery-3.6.0.min.js')}}"></script>


@include('layouts/footer')

<script>
    var dataForm = $('input[data-form=form]');
    var buttons = $('.buttons');

    $('.edit-form').click(function() {
        dataForm.attr('readonly', false);
        buttons.css('display', 'flex');
        // console.log(dataForm);
    });

    $('.btn-save').click(function() {
        dataForm.attr('readonly', true);
        buttons.css('display', 'none');
        // console.log('ok');
    });

    $('.discard').click(function() {
        dataForm.attr('readonly', true);
        buttons.css('display', 'none');
    });
</script>