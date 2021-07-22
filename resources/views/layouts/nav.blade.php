<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light scroll-down">
  <button class="navbar-toggler mr-auto" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand mr-auto" href="/">SEVEN THIRTY</a>
  <div class="collapse navbar-collapse ml-auto" id="navbarNavAltMarkup">
    <div class="navbar-nav menu mx-auto">
      <a class="nav-link text-body" href="/">Home <span class="sr-only">(current)</span></a>
      <a class="nav-link text-body" href="/shop">Shop</a>
      <a class="nav-link text-body" href="/gallery">Gallery</a>
      <a class="nav-link text-body" href="/about">About us</a>
    </div>
  </div>
  <div class="navbar-nav">
    <a href="https://wa.link/wrsgrl" class="navlink text-body icons"><i class="bi bi-telephone-fill text-body"></i><span>+62 858-9031-7097</span></a>
    @if(Session::get('LoggedUser'))
    <div class="dropdown collapse navbar-collapse" id="navbarNavAltMarkup">
      <button class="bg-transparent btn dropdown-toggle nav-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="bi bi-person-circle "></i>
        <span>My Account</span>
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item text-light" href="/account-details">Account Details</a>
        <a class="dropdown-item text-light" href="/logout">Log out</a>
      </div>
    </div>
    @else
    <a href="/login" class="nav-link icons text-body"><i class="bi bi-person-circle text-body"></i><span>LOG IN</span></a>
    @endif
    <a href="/cart" class="nav-link icons text-body ml-4"><i class="bi bi-cart text-body"></i></a>
  </div>
</nav>
<!-- End of Navbar -->