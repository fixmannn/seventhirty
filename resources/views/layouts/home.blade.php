<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

  <!-- Internal CSS -->
  <link rel="stylesheet" href="{{asset('css/index.css')}}">

  <!-- Bootstrap Icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

  <!-- Mulish Font -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Mulish&display=swap" rel="stylesheet">

  <title>Seven Thirty - This is Where We Started</title>
</head>


<body>

  <footer>
    <h5>FOLLOW US</h5>
    <a href="https://www.instagram.com/seventhirty.id/"><img src="{{asset('img/social-logo/ig-logo.png')}}" alt=""></a>
    <a href="https://shopee.co.id/seventhirty.id"><img src="{{asset('img/social-logo/shopee-logo.png')}}" alt=""></a>
    <a href="https://vm.tiktok.com/ZMejf4Bn5/"><img src="{{asset('img/social-logo/tiktok-logo.png')}}" alt=""></a>
    <p>Copyright &#169; Seven Thirty. 2021.</p>
  </footer>

  <script>
    // Fixed Navbar
    window.onscroll = function() {
      scrollDown()
    };

    const navbar = document.querySelector('.navbar');
    const navShow = document.querySelector('.scroll-down');
    const navText = document.querySelectorAll('.nav-text');
    const fixed = navbar.offsetTop;

    if(window.onload) {
      navText.forEach((val, index) => {
        val.classList.add("nav-color");
      });
    }

    function scrollDown() {
      if (window.pageYOffset > fixed) {
        navbar.classList.add("scroll-down");
        navText.forEach((val, index) => {
        val.classList.remove("nav-color");
      });
      } else {
        navbar.classList.remove("scroll-down");
        navText.forEach((val, index) => {
        val.classList.add("nav-color");
      });
      }
    }

    // New Arrival Hover
    const catalogs = document.querySelectorAll('.catalog');
    let catPics = ['blackpink', 'hayley', 'travis'];

    for (let i = 0; i < catalogs.length; i++) {
      for (let c = 0; c < catPics.length; c++) {
        catalogs[i].addEventListener('mouseover', function() {
          catalogs[i].src = 'https://seventhirty-id.com/img/' + catPics[i] + '-zoomed.jpg';
          catalogs[i].classList.add('fadeIn');
        })
        catalogs[i].addEventListener('mouseout', function() {
          catalogs[i].src = 'https://seventhirty-id.com/img/' + catPics[i] + '.jpg';
          catalogs[i].classList.remove('fadeIn');
        })
      }
    }
  </script>


  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  <!-- Load React. -->
  <!-- Note: when deploying, replace "development.js" with "production.min.js". -->
  <script src="https://unpkg.com/react@17/umd/react.development.js" crossorigin></script>
  <script src="https://unpkg.com/react-dom@17/umd/react-dom.development.js" crossorigin></script>

  <!-- Load our React component. -->
  <script src="{{asset('js/like_button.js')}}"></script>


</body>

</html>