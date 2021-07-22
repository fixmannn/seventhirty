@extends('layouts/pages')

@section('title', 'Seven Thirty - Gallery')

@section('gallerycss')
<link rel="stylesheet" href="{{asset('css/gallery.css')}}">
@endsection

@include('layouts/nav')

<!-- Our Gallery -->
<div class="container gallery">
    <div class="row">
        <div class="col">
            <h1 class="text-center">Our Gallery</h1>
        </div>
        <div class="row lookmom">
            <div class="col-xl-6">
                <img src="{{asset('img/gallery/gallery-3.jpg')}}" alt="" class="img-fluid">
            </div>
            <div class="col-xl-6">
                <img src="{{asset('img/gallery/gallery-4.jpg')}}" alt="" class="img-fluid">
                <img src="{{asset('img/gallery/gallery-1.jpg')}}" alt="" class="img-fluid">
            </div>
        </div>
        <div class="row friendship mt-5">
            <div class="col-xl-6">
                <img src="{{asset('img/gallery/gallery-6.jpg')}}" alt="" class="img-fluid">
                <img src="{{asset('img/gallery/gallery-7.jpg')}}" alt="" class="img-fluid">
            </div>
            <div class="col-xl-6">
                <img src="{{asset('img/gallery/gallery-5.jpg')}}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
</div>

@include('layouts/footer')