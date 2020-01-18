<head>
  <div class="marquee">
    <marquee> MAI'S FASHION SHOP: 99 To Hien Thanh - Phuoc My - Son Tra - Tp.Da Nang</marquee>
  </div>
  <title>My Fashion Shop - Ho Thi Mai</title>
  <link rel="stylesheet" type="text/css" href="../view/css/style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
  <header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand" href="#">My Fashion</a>
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
          <a class="nav-link" href="view/index.php">Home</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#">Dress</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#">Sport Clothe</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#">Shirt Clothe</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
      <div>
        <ul>
          <a href="Login.php">Login </a>
          <a href="Register.php">SignUp</a>
          <form action="Cart.php" method="" style="text-align: right;">
             <button  style=" color:firebrick; border: none; "><i class="fas fa-shopping-cart"></i></button>
        </form>
        </ul>
      </div>
     <!--   <li class="nav-item">
          <p style="background-color: black; color:white;"><?php echo $_SESSION['name'];?></p>
        </li> -->
  </nav>
</header>
  <!--====================Slide Show======================-->
  <div class="row">
    <div class="w3-content w3-section col-md-12 " style="max-width:450px;">
      <img class="mySlides" src="../images/clothe/slide3.jpg" style="width:1348px;height: 500px;">
      <img class="mySlides" src="../images/clothe/sale.jpg" style="width:1348px;height: 500px;">
      <img class="mySlides" src="../images/clothe/sale1.jpg" style="width:1348px;height: 500px;">
      <img class="mySlides" src="../images/clothe/sale1.png" style="width:1348px;height: 500px;">
    </div>
  </div>
  <script>
    var mySlideShow = 0;
    autoSlide();

    function autoSlide() {
      var i;
      var x = document.getElementsByClassName("mySlides");
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      mySlideShow++;
      if (mySlideShow > x.length) {
        mySlideShow = 1
      }
      x[mySlideShow - 1].style.display = "block";
      setTimeout(autoSlide, 2500);
    }
  </script>