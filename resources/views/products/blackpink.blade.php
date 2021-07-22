@extends('layouts/pages')

@section('title', 'Seven Thirty - Products')

@section('productscss')
<link rel="stylesheet" href="{{asset('css/products.css')}}">
@endsection

@include('layouts/nav')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/')}}" class="text-body">Home</a></li>
        <li class="breadcrumb-item"><a href="{{url('/shop')}}" class="text-body">Shop</a></li>
        <li class="breadcrumb-item active" aria-current="page">Products</li>
    </ol>
</nav>
<!-- End of Breadcrumbs -->


<!-- Products Description -->
<div class="products">
    <div class="products-desc">
        <div class="thumbnail">
            <a href=""><img src="{{asset('img/blackpink.jpg')}}" alt="" class="thumb1"></a>
            <a href=""><img src="{{asset('img/blackpink-zoomed.jpg')}}" alt="" class="thumb2"></a>
        </div>
        <div class="preview">
            <a href=""><img src="{{asset('img/blackpink.jpg')}}" alt="" class="img-fluid previewImg img1"></a>
        </div>

        <!-- Product Details -->
        @include('products/details/detail')
        <!-- End of Product Details -->
    </div>

    <!-- Description -->
    @include('products/details/description')
    <!-- End of Description -->

    <!-- Related Products -->
    @include('products/related/blackpink')
    <!-- End of Related Products -->

</div>

@include('layouts/footer')



<script>
    const catalogs = document.querySelectorAll('.catalog');
    let catPics = ['hayley', 'paramore', 'travis', 'hollywoods'];
</script>


<script src="{{asset('js/products.js')}}"></script>