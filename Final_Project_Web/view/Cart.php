<?php

require_once "../database/database.php";
require_once "../model/User.php";
require_once "../model/SportClothe.php";
require_once "../model/Shirt.php";
require_once "../model/Dress.php";

$sql2 = "SELECT * from clothe";
$result2 = $db->query($sql2)->fetch_all(MYSQLI_ASSOC);

$sql1 = "SELECT id, name, price, color, type, count(*) as quantity, price*count(*) as tong FROM cart GROUP BY (name)";
$rs = $db->query($sql1);
$result1 = $rs->fetch_all(MYSQLI_ASSOC);

// $result1 = $db->query($sql1)->fetch_all(MYSQLI_ASSOC);
//Delete from cart
if (isset($_POST["id_cart"])) {
    $id = $_POST["id_cart"];
    $sql1 = "DELETE from cart where id= " . $id;
    $db->query($sql1);
    var_dump($sql1);
    header("refresh:0");
}

if (isset($_POST["ord"])) {
    $sql1 = "DELETE from cart";
    $db->query($sql1);
    var_dump($sql1);
    header("refresh:0");
}

function sum($result1)
{
    $sum = 0;
    for ($i = 0; $i < count($result1); $i++) {
        $sum += $result1[$i]['quantity'];
    }
    return $sum;
}
function total($result1)
{
    $total = 0;
    for ($i = 0; $i < count($result1); $i++) {
        $total += $result1[$i]['tong'];
    }
    return $total;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body style="background-image: url(../images/clothe/1.jpg)">
    <div id="cart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="background-color: white;background-image: url(../images/clothe/1.jpg);">
        <form action="index.php" method="">
            <button style=" font-style: italic; color:black;font-size: 16px; border: none; ">Home page</button>
        </form>
        <form action="" method="post">
            <h3 style="color: green; font-weight: bold;margin-left: 550px;font-size: 20px;">MY SHOPPING CART</h3>
            <div class="line">
                <table id="tbl" class="table table-striped" style="margin-left: 10px;background-image: url(../images/clothe/1.jpg)">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Color</th>
                        <th>Type</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Delete</th>
                    </tr>
                    <?php for ($i = 0; $i < count($result1); $i++) { ?>
                        <tr>
                            <td><?php echo $i + 1; ?></td>
                            <td><?php echo $result1[$i]['name']; ?></td>
                            <td><?php echo $result1[$i]['price']; ?></td>
                            <td><?php echo $result1[$i]['color']; ?></td>
                            <td><?php echo $result1[$i]['type']; ?></td>
                            <td><button name="increase" value="<?php echo $i; ?>" style="width: 18px; height: 18px;">-</button><?php echo $result1[$i]['quantity']; ?>
                                <button name="reduction" value="<?php echo $i; ?>" style="width: 18px; height: 18px;">+</button></th>
                            <td><?php echo $result1[$i]['tong']; ?></td>
                            <form method="post">
                                <td><button class="delete" name="id_cart" value="<?php echo $result1[$i]['id']; ?>">X</button></td>
                            </form>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div style="margin-left:550px;margin-top: 50px;">
                <h2>TOTAL YOUR CAT</h2>
                <h4> Product Quantity: <?php echo sum($result1); ?></h4>
                <h4>Delivery charges: <?php echo (sum($result1) * 5000) . " VND"; ?></h4>
                <h4>Total Price: <?php echo (total($result1) + sum($result1) * 5000) . " VND"; ?></h4>

            </div>
            <div style="display: block;" id="formOd">
                <div class="top_body_content">
                    <hr width="30%" height="10px" align="center; color:black;">
                    <p style="color:firebrick; font-weight: bold;">Thông Tin Người Đặt Hàng</p>
                    <hr width="30%" height="10px" align="center; color:black;">
                </div>
                <div class="inOrder" style="margin-left:580px;margin-top: 20px;">

                    <form action="" method="post">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 200px;"><i class="fa fa-home"></i> Fullname </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Fullname">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 200px;"><i class="fa fa-home"></i> Address </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Address">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 200px;"><i class="fa fa-phone"></i> PhoneNumber</span>
                            </div>
                            <input type="text" class="form-control" placeholder="PhoneNumber">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 200px;"><i class="fa fa-phone"></i> Delivery charges</span>
                            </div>
                            <input type="text" class="form-control" value="<?php echo (sum($result1) * 5000) ?>">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="width: 200px;"><i class="fa fa-phone"></i> Total Price</span>
                            </div>
                            <input type="text" class="form-control" value="<?php echo total($result1) ?>"><br>
                        </div>
                        <form action="" method="post">
                            <div style=" margin: center; margin-top: 10px;">
                                <button name="ord" onclick="order()">Confirm Order</button>
                            </div>
                        </form>
                    </form>
                </div>
</body>
<script src="Add.js"></script>

</html>