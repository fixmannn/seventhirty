@extends('layouts.login')

@section('title', 'Seven Thirty - Log In')

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
    <button class="navbar-toggler mr-auto" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand mr-auto text-white" href="/">SEVEN THIRTY</a>
    <div class="collapse navbar-collapse ml-auto " id="navbarNavAltMarkup">
        <div class="navbar-nav menu mx-auto">
            <a class="nav-link text-white" href="/">Home <span class="sr-only">(current)</span></a>
            <a class="nav-link text-white" href="/shop">Shop</a>
            <a class="nav-link text-white" href="/gallery">Gallery</a>
            <a class="nav-link text-white" href="/about">About us</a>
        </div>
    </div>
    <div class="navbar-nav">
        <a href="https://wa.link/wrsgrl" class="navlink text-white icons remove"><i class="bi bi-telephone-fill text-white"></i><span>Whatsapp</span></a>
        <a href="/cart" class="navlink icons text-white"><i class="bi bi-cart text-white"></i></a>
    </div>
</nav>
<!-- End of Navbar -->
̀
<!-- Collapsing Login -->
<div class="accordion login" id="accordionExample">
    <div class="card">
        <div class="card-header" id="headingOne" onclick="rotateBtn1()">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left text-body login-btn" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Log In<span class="text-right close close-login closebtn1" aria-hidden="true">+</span>
                </button>
            </h2>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                <form action="{{route('login')}}" method="post">
                    @csrf
                    @if(Session::get('fail'))
                    <div class="alert alert-danger">
                        {{Session::get('fail')}}
                    </div>
                    @endif

                    @if(session('status'))
                    <div class="alert alert-success">
                        {{session('status')}}
                    </div>
                    @endif

                    <div class="form-group">
                        <label for="email-login">Email address</label>
                        <input type="email" class="form-control" id="email-login" name="email" aria-describedby="emailHelp" autocomplete="off" value="{{old('email')}}">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        @error('email')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password-login" name="password">
                        @error('password')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="savelogin">
                        <label class="form-check-label" for="savelogin" name="savelogin">Save Login</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Log In</button>
                </form>
                <div class="redirect-link d-flex justify-content-around">
                    <a href="/register">Create an Account!</a>
                    <a href="/forgot-password">Forgot Password?</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Collapsing Login -->

<!-- Script -->
<script>
    // Close Button Animation
    function rotateBtn1() {
        const closeBtn = document.querySelector('.close-login');
        const closeBtn2 = document.querySelector('.close-signup');
        closeBtn.classList.toggle('closebtn1');
        closeBtn.style.transition = "500ms";
        closeBtn2.style.transition = "500ms";
    }
    // Collapsing Activation
    $('.collapse').collapse();
</script>