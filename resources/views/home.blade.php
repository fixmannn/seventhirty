@extends('layouts/home')

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
  <button class="navbar-toggler mr-auto" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand mr-auto nav-text" href="/">SEVEN THIRTY</a>
  <div class="collapse navbar-collapse ml-auto" id="navbarNavAltMarkup">
    <div class="navbar-nav menu mx-auto">
      <a class="nav-link text-body nav-text" href="/">HOME <span class="sr-only">(current)</span></a>
      <a class="nav-link text-body nav-text" href="/shop">SHOP</a>
      <a class="nav-link text-body nav-text" href="/gallery">GALLERY</a>
      <a class="nav-link text-body nav-text" href="/about">ABOUT US</a>
    </div>
    <div class="navbar-nav">
      <a href="https://wa.link/wrsgrl" class="navlink icons remove"><i class="bi bi-telephone-fill nav-text"></i><span class="nav-text wa-number">+62 858-9031-7097</span></a>
      @if(Session::get('LoggedUser'))
      <div class="dropdown nav-item my-account">
        <button class="bg-transparent btn dropdown-toggle nav-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="bi bi-person-circle nav-text"></i>
          <span class="nav-text">MY ACCOUNT</span>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item text-body" href="/account-details">ACCOUNT DETAILS</a>
          <a class="dropdown-item text-body" href="/orders">MY ORDER</a>
          <a class="dropdown-item text-body" href="/logout">LOG OUT</a>
        </div>
      </div>
      @else
      <a href="/login" class="nav-link icons text-body login-link"><i class="bi bi-person-circle text-body"></i><span class="nav-link text-body ml-0">LOG IN</span></a>
      @endif
    </div>
  </div>
  <div class="navbar-nav">
    <a href="/cart" class="nav-link icons text-body"><i class="bi bi-cart text-body"></i></a>
  </div>
</nav>
<!-- End of Navbar -->


<!-- Carousel  -->
<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{asset('img/img-header.jpg')}}" class="d-block w-100" alt="Music-Edition">
      <div class="carousel-caption slide-1">
        <h1>Music Edition</h1>
        <h3>Post Malone - Holywoords Bleeding.</h3>
        <button type="button" class="btn btn-light shop-now" onclick="location.href = '/shop'">SHOP NOW!</button>
      </div>
    </div>
    <div class=" carousel-item">
      <img src="{{asset('img/login/IMG_1495.jpg')}}" class="d-block w-100" alt="...">
      <div class="carousel-caption slide-2">
        <h1>Signature Collection</h1>
        <h3>We made tee with philosophy.</h3>
        <button type="button" class="btn btn-light shop-now" onclick="location.href = '/shop'">SHOP NOW!</button>
      </div>
    </div>
  </div>
</div>
<!-- End of Carousel -->

<!-- New Arrival -->
<div class="container new-arrival">
  <div class="row judul">
    <div class="col text-center">
      <h1>New Arrival</h1>
    </div>
  </div>

  <div class="row new-catalog">
    <div class="col-xl">
      <a href="/products/blackpink/202111" style="text-decoration: none;"><img src="{{asset('img/blackpink.jpg')}}" alt="" class="catalog">
        <h5>Blackpink Vintage T-shirt</h5>
      </a>
      <p>Rp. 99.000,-</p>
    </div>
    <div class="col-xl">
      <a href="products/hayley/202109" style="text-decoration: none;"><img src="{{asset('img/hayley.jpg')}}" alt="" class="catalog">
        <h5>Hayley Williams Vintage T-shirt</h5>
      </a>
      <p>Rp. 99.000,-</p>
    </div>
    <div class="col-xl">
      <a href="products/travis/202106" style="text-decoration: none;"><img src="{{asset('img/travis.jpg')}}" alt="" class="catalog">
        <h5>Travis Scott Vintage T-shirt</h5>
      </a>
      <p>Rp. 99.000,-</p>
    </div>
  </div>
  <div class="load-more">
    <a href="/shop" style="text-decoration: none;" class="text-muted">
      <p>LOAD MORE</p>
    </a>
  </div>
</div>
<!-- End of New Arrival -->

<!-- Collection -->
<div class="collection">
  <div class="row">
    <div class="col-sm-4">
      <h2>Music Edition</h2>
    </div>
    <div class="col-sm-8">
      <p>We make music edition because for us music is one of the most important thing in our life, its part of our soul, and we'd love to see our favorite musician to be shown. All of our music edition t-shirt are not official merchandise from the artist, so if you want the original, please go to their official merch store.
      </p>
    </div>
  </div>
  <div class="row">
    <div class="col-xl">
      <img src="{{asset('img/img-square1.jpg')}}" alt="" class="img-fluid">
    </div>
    <div class="col-xl">
      <img src="{{asset('img/image-landscape-1.jpg')}}" alt="" class="img-fluid">
      <img src="{{asset('img/image-landscape-2.jpg')}}" alt="" class="img-fluid">
    </div>
  </div>
</div>
<!-- End of Collection -->