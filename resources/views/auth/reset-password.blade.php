@extends('layouts.login')

@section('title', 'Seven Thirty - Reset Password')

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
        <a href="https://wa.link/wrsgrl" class="navlink text-white icons remove"><i class="bi bi-telephone-fill text-white"></i><span>+62 858-9031-7097</span></a>
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
                    Reset your password<span class="text-right close close-login closebtn1" aria-hidden="true">+</span>
                </button>
            </h2>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                <x-auth-validation-errors class="mb-4 text-danger" :errors="$errors" />
                <form action="{{route('password.update')}}" method="post">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" autocomplete="off" value="{{old('email', $request->email)}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="off" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </form>
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