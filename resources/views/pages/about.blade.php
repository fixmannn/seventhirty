@extends('layouts/pages')

@section('title', 'Seven Thirty - About')

@section('aboutcss')
<link rel="stylesheet" href="{{asset('css/about.css')}}">
@endsection

@include('layouts/nav')

<div class="about">
  <div class="row mt-4 mb-5">
    <div class="col">
      <div class="container">
        <img src="{{ asset('/img/page-down.png') }}" alt="" class="img-fluid mx-auto d-block img-content">
      </div>
    </div>
  </div>
</div>

@include('layouts/footer')