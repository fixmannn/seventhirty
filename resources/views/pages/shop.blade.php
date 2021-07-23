@extends('layouts/pages')

@section('title', 'Seven Thirty - Shop')

@section ('shopcss')
<link rel="stylesheet" href="{{asset('css/shop.css')}}">
@endsection

@include('layouts/nav')

<!-- Products -->
<div class="products">
    <div class="row">
        <div class="col-xl">
            <h1>Shop</h1>
        </div>
    </div>
</div>

<!-- End of Products -->

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/')}}" class="text-body">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Shop</li>
    </ol>
</nav>

<!-- End of Breaadcrumbds -->


<!-- Shop -->
<div class="shop">
    <div class="row new-catalog">
        <div class="col">
            <a href="{{url('products/paramore/202118')}}"><img src="{{asset('img/paramore.jpg')}}" alt="" class="catalog"></a>
            <h5>Paramore Vintage T-shirt</h5>
            <p>Rp. 109.920,-</p> 
        </div>
        <div class="col">
            <a href="{{url('products/blackpink/202111')}}"><img src="{{asset('img/blackpink.jpg')}}" alt="" class="catalog"></a>
            <h5>Blackpink Vintage T-shirt</h5>
            <p>Rp. 109.920,-</p>
        </div>
        <div class="col">
            <a href="{{url('products/hayley/202109')}}"><img src="{{asset('img/hayley.jpg')}}" alt="" class="catalog"></a>
            <h5>Hayley Williams Vintage T-shirt</h5>
            <p>Rp. 109.920,-</p>
        </div>
        <div class="col">
            <a href="{{url('products/purpose/202112')}}"><img src="{{asset('img/purpose.jpg')}}" alt="" class="catalog"></a>
            <h5>Justin Bieber - Purpose T-shirt</h5>
            <p>Rp. 109.920,-</p>
        </div>
        <div class="col">
            <a href="{{url('products/zayn/202114')}}"><img src="{{asset('img/zayn.jpg')}}" alt="" class="catalog"></a>
            <h5>Zayn Malik T-shirt</h5>
            <p>Rp. 109.920,-</p>
        </div>
        <div class="col">
            <a href="{{url('products/travis/202106')}}"><img src="{{asset('img/travis.jpg')}}" alt="" class="catalog"></a>
            <h5>Travis Scott Vintage T-shirt</h5>
            <p>Rp. 109.920,-</p>
        </div>
    </div>

    <div class="row new-catalog more-display" style="display: none;">
        <div class="col">
            <a href="{{url('products/beerbongs/202110')}}"><img src="{{asset('img/beerbongs.jpg')}}" alt="" class="catalog"></a>
            <h5>Beerbongs & Bentley T-shirt</h5>
            <p>Rp. 109.920,-</p>
        </div>
        <div class="col">
            <a href="{{url('products/dualipa/202107')}}"><img src="{{asset('img/dualipa.jpg')}}" alt="" class="catalog"></a>
            <h5>Dua Lipa Vintage T-shirt</h5>
            <p>Rp. 109.920,-</p>
        </div>
        <div class="col">
            <a href="{{url('products/drake/202115')}}"><img src="{{asset('img/drake.jpg')}}" alt="" class="catalog"></a>
            <h5>Drake God's Plan T-shirt</h5>
            <p>Rp. 109.920,-</p>
        </div>
        <div class="col">
            <a href="{{url('products/dynamite/202116')}}"><img src="{{asset('img/dynamite.jpg')}}" alt="" class="catalog"></a>
            <h5>BTS - Dynamite T-shirt</h5>
            <p>Rp. 109.920,-</p>
        </div>
        <div class="col">
            <a href="{{url('products/hollywoods/202113')}}"><img src="{{asset('img/hollywoods.jpg')}}" alt="" class="catalog"></a>
            <h5>Hollywoods Bleeding T-shirt</h5>
            <p>Rp. 109.920,-</p>
        </div>
        <div class="col">
            <a href="{{url('products/lookmom/202108')}}"><img src="{{asset('img/lookmom.jpg')}}" alt="" class="catalog"></a>
            <h5>Look Mom I Can Fly T-shirt</h5>
            <p>Rp. 109.920,-</p>
        </div>
        <div class="col">
            <a href="{{url('products/modernity/202119')}}"><img src="{{asset('img/modernity.jpg')}}" alt="" class="catalog"></a>
            <h5>Modernity Has Failed Us T-shirt</h5>
            <p>Rp. 109.920,-</p>
        </div>
        <div class="col">
            <a href="{{url('products/neckdeep/202120')}}"><img src="{{asset('img/neckdeep.jpg')}}" alt="" class="catalog"></a>
            <h5>Neckdeep T-shirt</h5>
            <p>Rp. 109.920,-</p>
        </div>
        <div class="col">
            <a href="{{url('products/starboy/202105')}}"><img src="{{asset('img/starboy.jpg')}}" alt="" class="catalog"></a>
            <h5>The Weeknd - Starboy T-shirt</h5>
            <p>Rp. 109.920,-</p>
        </div>
    </div>

    <div class="load-more">
        <p>LOAD MORE</p>
    </div>
</div>

@include('layouts/footer')

<!-- End of Shop -->

<script src="{{asset('js/shop.js')}}"></script>