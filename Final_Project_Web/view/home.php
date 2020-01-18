<?php

require_once "../database/database.php";
require_once "../model/User.php";
require_once "../model/SportClothe.php";
require_once "../model/Shirt.php";
require_once "../model/Dress.php";

$sql = "SELECT * from clothe";
$result = $db->query($sql)->fetch_all(MYSQLI_ASSOC);

$sql1 = "SELECT * from cart";
$result1 = $db->query($sql1)->fetch_all(MYSQLI_ASSOC);

$clothes = array();
for ($i = 0; $i < count($result); $i++) {
  $clothe = $result[$i];
  if ($clothe['type'] == 'sport') {
    array_push($clothes, new SportClothe($clothe['id'], $clothe['name'], $clothe['price'], $clothe['color'], $clothe['image']));
  }
  if ($clothe['type'] == 'shirt') {
    array_push($clothes, new Shirt($clothe['id'], $clothe['name'], $clothe['price'], $clothe['color'], $clothe['image']));
  }
  if ($clothe['type'] == 'dress') {
    array_push($clothes, new Dress($clothe['id'], $clothe['name'], $clothe['price'], $clothe['color'], $clothe['image']));
  }
}

//Add to cart //
if (isset($_POST["addcart"])) {
  $id = $i + 1;
  $name = $result[0]['name'];
  $price = $result[0]['price'];
  $color = $result[0]['color'];
  $type = $result[0]['type'];
  $image = $result[0]['image'];
  $quantity = 1;
  $total = $price * $quantity;
  $sql1 = "INSERT into cart(name,price,color,type,image,quantity,total) values(null," . $id . ",'" . $name . "'," . $price . ",'" . $color . ",'" . $type . "','" . $image . "','" . $quantity . "," . $total . ")";
  $db->query($sql1);
  echo json_encode($sql1);
}

?>
<!DOCTYPE html>
<html>

<head>
  <div class="marquee">
    <marquee> MAI'S FASHION SHOP: 99 To Hien Thanh - Phuoc My - Son Tra - Tp.Da Nang</marquee>
  </div>
  <title>My Fashion Shop - Ho Thi Mai</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
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
          </ul>
        </div>
        <!--   <li class="nav-item">
          <p style="background-color: black; color:white;"><?php echo $_SESSION['name']; ?></p>
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
  <!--====================Sản phẩm======================-->
  <div class="row">
    <div class="container-fluid bg-3 text-center col-md-10 col-sm-6" id="product" tabindex="-1" role="dialog" aria-hidden="true" style="background-color: white">
      <h2 style="color: black; font-weight: bold">SẢN PHẨM</h2>

      <br>
      <div class="grid-container">

        <?php
        for ($i = 0; $i < count($clothes); $i++) {
        ?>
          <div class="grid-item">
            <img class="img-fluid d-block mx-auto" src="<?php echo $clothes[$i]->getImagePath(); ?>" class="img-responsive" style="width:100%" alt="Image">
            <p>
              <?php echo $clothes[$i]->name ?>
              <br>
              <?php echo $clothes[$i]->getType() ?>
              <br>
              <?php echo $clothes[$i]->color ?>
              <br>
              <?php echo $clothes[$i]->getDisplayPrice() ?>
              <br>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <div class="footer">
    <hr style="color: white; margin-top: 0px; margin-bottom: 0px;">
    <footer class="page-footer font-small special-color-dark pt-4">
      <div class="container">
        <ul class="list-unstyled list-inline text-center">
          <li class="list-inline-item">
            <a class="btn-floating btn-fb mx-1" style="color:royalblue;">
              <i class="fab fa-facebook-f"> </i>
            </a>
          </li>
          <li class="list-inline-item">
            <a class="btn-floating btn-tw mx-1" style="color:skyblue;">
              <i class="fab fa-twitter"> </i>
            </a>
          </li>
          <li class="list-inline-item">
            <a class="btn-floating btn-gplus mx-1">
              <i class="fab fa-google-plus-g" style="color:tomato;"> </i>
            </a>
          </li>
          <li class="list-inline-item">
            <a class="btn-floating btn-li mx-1">
              <i class="fab fa-linkedin-in" style="color:navy;"> </i>
            </a>
          </li>
        </ul>
      </div>
      <div class="footer-copyright text-center py-3"> Copyright by Ho Thi Mai:
        <a href="view/index.php"> FashionShop.com</a>
      </div>
    </footer>
</body>

</html>