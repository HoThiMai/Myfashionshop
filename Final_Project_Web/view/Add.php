<?php
require_once "../database/database.php";
require_once "../model/User.php";
require_once "../model/SportClothe.php";
require_once "../model/Shirt.php";
require_once "../model/Dress.php";

$sql = "SELECT * from clothe";

// Delete 
if (isset($_POST['dele'])) {
    $db->query('DELETE FROM clothe WHERE id =' . $_POST['dele']);
}

// Upadate clothe
if (isset($_POST['edit'])) {
    $sqlEdit = "SELECT * from clothe where id =" . $_POST['edit'];
    $result1 = $db->query($sqlEdit)->fetch_all(MYSQLI_ASSOC);
    // var_dump($result1);
}
if (isset($_POST['update'])) {
    $name_edit = $_POST['nameEd'];
    $price_edit = $_POST['priceEd'];
    $type_edit = $_POST['typeEd'];
    $color_edit = $_POST['colorEd'];
    $target_dir = "images/clothe/";
    $target_file =  $target_dir . basename($_FILES["fileToUploadEd"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["fileToUploadEd"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    $stm = 'UPDATE clothe set name="' . $name_edit . '", price=' . $price_edit . ',type="' . $type_edit . '",color="' . $color_edit . '",image="' . $target_file . '" WHERE id=' . $_POST['update'] . '';
    echo json_encode($stm);
    $db->query($stm);
}


$result = $db->query($sql)->fetch_all(MYSQLI_ASSOC);
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

// INSERT INTO CLOTHES
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $price = $_POST["price"];
    $color = $_POST["color"];
    $type = $_POST["type"];
    $target_dir = "images/clothe/";
    $target_file =  $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    $sql = "INSERT into clothe(id,name,price,color,type,image) values(null,'" . $name . "'," . $price . ",'" . $color . "','" . $type . "','" . $target_file . "')";
    $db->query($sql);
    header("refresh:0");
}

//Logout 
if (isset($_POST['logout'])) {
    unset($_SESSION['name']);
    $_SESSION['log'] = false;
    header("index.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div>
        <button onclick="AddForm()">Add</button>
        <button onclick="EditForm()">Edit</button>
    </div>
    <form style="display: none" id="Admin_Add" action="" method="post" enctype="multipart/form-data">
        <div class="md-form">
            <label for="usr">Name:</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="form-group">
            <label for="select">Type</label>
            <input type="text" class="form-control" name="type">
        </div>
        <div class="form-group">
            <label for="usr">Color:</label>
            <input type="text" class="form-control" name="color">
        </div>
        <div class="form-group">
            <label for="usr">Price</label>
            <input type="text" class="form-control" name="price">
        </div>
        <div class="form-group">
            <label for="img">Image Product</label>
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Add" name="submit">
        </div>
    </form>
    <form style="display: none" id="Admin_edit" action="" method="post" enctype="multipart/form-data">
        <div class="md-form">
            <label for="usr">Name:</label>
            <input type="text" class="form-control" name="nameEd" value="<?php if (isset($_POST['edit'])) {
                                                                                echo  $result1[0]['name'];
                                                                            } ?>">
        </div>
        <div class="form-group">
            <label for="select">Type</label>
            <input type="text" class="form-control" name="typeEd" value="<?php if (isset($_POST['edit'])) {
                                                                                echo  $result1[0]['type'];
                                                                            } ?>">
        </div>
        <div class="form-group">
            <label for="usr">Color:</label>
            <input type="text" class="form-control" name="colorEd" value="<?php if (isset($_POST['edit'])) {
                                                                                echo  $result1[0]['color'];
                                                                            } ?>">
        </div>
        <div class="form-group">
            <label for="usr">Price</label>
            <input type="text" class="form-control" name="priceEd" value="<?php if (isset($_POST['edit'])) {
                                                                                echo  $result1[0]['price'];
                                                                            } ?>">
        </div>
        <div class="form-group">
            <label for="img">Image Product</label>
            <input type="file" name="fileToUploadEd" id="fileToUpload" value="<?php if (isset($_POST['edit'])) {
                                                                                    echo  $result1[0]['image'];
                                                                                } ?>">
            <input type="submit" value="<?php if (isset($_POST['edit'])) {
                                            echo  $result1[0]['id'];
                                        } ?> " name="update">
        </div>
    </form>
    <table align="center" width="600px" border="1" cellspacing="0" cellpadding="3" class="table table-hover table-bordered" id="mytable">
        <tr class="bg-success" style="text-align: center;">
            <th>ID</th>
            <th>Name Product</th>
            <th>Image</th>
            <th>Type</th>
            <th>Color</th>
            <th>New Price</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
        for ($i = 0; $i < count($clothes); $i++) {
            echo '<tr>';
            echo '<td style="text-align: center;">' . $i . '</td>';
            echo '<td style="text-align: center;">' . $clothes[$i]->name . '</td>';
            echo '<td style="text-align: center;"><img src="' . $clothes[$i]->getImagePath() . '" style="width: 50px; height: 50px;" ></td>';
            echo '<td style="text-align: center;">' . $clothes[$i]->getType() . '</td>';
            echo '<td style="text-align: center;">' . $clothes[$i]->color . '</td>';
            echo '<td style="text-align: center;">' . $clothes[$i]->getDisplayPrice() . '</td>';
            echo '<td style="text-align: center;">' . '<form method="post"><button type="submit" style="width: 80px; class="edit" data-toggle="modal" data-target="#modal' . $clothes[$i]->id . '" name="edit" value="' . $clothes[$i]->id . '"> Edit</button></form>' . '</td>';

            echo '<td style="text-align: center;">' . '<form method="post"><button type="submit" class="del" name="dele" value="' . $clothes[$i]->id . '"> Delete</button></form>' . '</td>';
            echo '</tr>';
        } ?>
    </table>

</body>
<script src="Add.js"></script>

</html>