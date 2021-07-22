@extends('layouts.login')

@section('title', 'Seven Thirty - Register')

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

<!-- Collapsing Login -->
<div class="accordion login" id="accordionExample">
    <div class="card">
        <div class="card-header" id="headingOne" onclick="rotateBtn2()">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left text-body login-btn collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseOne">
                    Sign Up<span class="text-right close close-signup" aria-hidden="true">x</span>
                </button>
            </h2>
        </div>

        <div id="collapseTwo" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                <form action="{{route('register')}}" method="post">
                    @csrf
                    <div class="result">
                        @if(Session::get('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                        @endif

                        @if(Session::get('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="email-signup">Email address</label>
                        <input type="email" class="form-control" id="email-signup" name="email" aria-describedby="emailHelp" autocomplete="off" value="{{ old('email') }}">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        @error('email')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password-signup">Password</label>
                        <input type="password" class="form-control" id="password-signup" name="password">
                        <small id="emailHelp" class="form-text text-muted">Password must contain min. 8 characters, number and uppercase letter</small>
                        @error('password')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password-signup2">Re-Enter Password</label>
                        <input type="password" class="form-control" id="password-signup2" name="password_confirmation">
                    </div>
                    <button type="submit" class="btn btn-primary">Signup</button>
                </form>
                <a href="/login">Already have an account? Log In!</a>
            </div>
        </div>
    </div>
</div>
<!-- End of Collapsing Login -->

<!-- Script -->
<script>
    function rotateBtn2() {
        const closeBtn = document.querySelector('.close-signup');
        const closeBtn2 = document.querySelector('.close-login');
        closeBtn.classList.toggle('closebtn2');
        closeBtn.style.transition = "500ms";
        closeBtn2.style.transition = "500ms";
    }

    // Collapsing Activation
    $('.collapse').collapse();
</script>