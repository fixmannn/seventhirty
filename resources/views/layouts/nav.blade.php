<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light scroll-down">
  <button class="navbar-toggler mr-auto" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand mr-auto nav-text" href="/">SEVEN THIRTY</a>
  <div class="collapse navbar-collapse ml-auto" id="navbarNavAltMarkup">
    <div class="navbar-nav menu mx-auto">
      <a class="nav-link text-body" href="/">HOME<span class="sr-only">(current)</span></a>
      <a class="nav-link text-body" href="/shop">SHOP</a>
      <a class="nav-link text-body" href="/gallery">GALLERY</a>
      <a class="nav-link text-body" href="/about">ABOUT US</a>
    </div>
    <div class="navbar-nav">
      <a href="https://wa.link/wrsgrl" class="text-body icons remove"><i class="bi bi-telephone-fill text-body"></i><span class="wa-number menu">+62 858-9031-7097</span></a>
      @if(Session::get('LoggedUser'))
      <div class="nav-item dropdown my-account">
        <button class="bg-transparent btn menu dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="bi bi-person-circle"></i>
          <span class="text-body menu" style="font-size: 14px">MY ACCOUNT</span>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item text-body" href="/account-details">ACCOUNT DETAILS</a>
          <a class="dropdown-item text-body" href="/orders">MY ORDER</a>
          <a class="dropdown-item text-body" href="/logout">LOG OUT</a>
        </div>
      </div>
      @else
      <a href="/login" class="nav-link icons text-body"><i class="bi bi-person-circle text-body"></i><span class="nav-link text-body ml-0 my-account-home">LOG IN</span></a>
      @endif
    </div>
  </div>
  <div class="navbar-nav">
    <a href="/cart" class="icons text-body"><i class="bi bi-cart text-body"></i></a>
  </div>
</nav>
<!-- End of Navbar -->