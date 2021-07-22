<?php
session_start();

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

  <!-- Internal CSS -->
  <link rel="stylesheet" href="../CSS/account-details.css">
  <link rel="stylesheet" href="../index.css">

  <!-- Bootstrap Icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

  <!-- Mulish Font -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Mulish&display=swap" rel="stylesheet">

  <title>Seven Thirty - Cart</title>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light scroll-down">
    <button class="navbar-toggler mr-auto" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand mr-auto" href="../index.php">SEVEN THIRTY</a>
    <div class="collapse navbar-collapse ml-auto" id="navbarNavAltMarkup">
      <div class="navbar-nav menu mx-auto">
        <a class="nav-link text-body" href="../index.php">Home <span class="sr-only">(current)</span></a>
        <a class="nav-link text-body" href="./shop.php">Shop</a>
        <a class="nav-link text-body" href="./gallery.php">Gallery</a>
        <a class="nav-link text-body" href="./about.php">About us</a>
      </div>
    </div>
    <div class="navbar-nav">
      <a href="https://wa.link/wrsgrl" class="navlink text-body icons remove"><i class="bi bi-telephone-fill text-body"></i><span>+62 858-9031-7097</span></a>
      @if(Session::get('LoggedUser'))
      <div class="dropdown collapse navbar-collapse" id="navbarNavAltMarkup">
        <button class="bg-transparent btn dropdown-toggle nav-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="bi bi-person-circle "></i>
          <span>My Account</span>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="/account-details">Account Details</a>
          <a class="dropdown-item" href="/logout">Log out</a>
        </div>
      </div>
      @else
      <a href="{{url('/register')}}" class="nav-link icons text-body remove"><i class="bi bi-person-circle text-body"></i><span>LOG IN</span></a>
      @endif
    </div>
  </nav>
  <!-- End of Navbar -->

  <!-- Account Details -->






  <!-- Footer -->
  <footer>
    <h5>FOLLOW US</h5>
    <a href="https://www.instagram.com/seventhirty.id/"><img src="../img/social logo/ig-logo.png" alt=""></a>
    <a href="https://shopee.co.id/seventhirty.id"><img src="../img/social logo/shopee-logo'.png" alt=""></a>
    <a href="https://vm.tiktok.com/ZMejf4Bn5/"><img src="../img/social logo/tiktok-logo.png" alt=""></a>
    <p>Copyright &#169; Seven Thirty. 2021.</p>
  </footer>
  <!-- End of Footer -->




  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
-->
</body>

</html>