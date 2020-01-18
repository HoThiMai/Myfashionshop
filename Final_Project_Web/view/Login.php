<?php
require_once "../database/database.php";
$sql2 = "SELECT * from users";
$result2 = $db->query($sql2)->fetch_all();
$check = true;
session_start();
error_reporting(0);

if (isset($_POST['login'])) {
    $_SESSION['username'] = $_POST["accountLogin"];
    $_SESSION['password'] = $_POST["passLogin"];
    if (!$_SESSION['username'] || !$_SESSION['password']) {
        echo "Please input all information";
        exit;
    }
    for ($i = 0; $i < count($result2); $i++) {
        if ($_SESSION['username'] == $result2[$i][2] && $_SESSION['password'] == $result2[$i][3]) {
            $check = true;

            if ($result2[$i][4] == "admin") {
                $log = true;
                $_SESSION['log'] = $log;
                $_SESSION['fullname'] = $username;
                header("location:Add.php");
            } else {
                $log = false;
                $_SESSION['log'] = $log;
                $_SESSION['fullname'] = $username;
                header("location:index.php");
                echo $_SESSION['name'];
            }
        } else {
            $check = false;
        }
    }
    if ($check == false) {
        echo "Tên đăng nhập hoặc mật khẩu không đúng!<a href='javascript: history.go(-1)'>Go back</a>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
    <form action="" method="post">
        <div class="line">
            <h1>SIGN IN</h1>
            <img src="../images/clothe/01.png">
            <label>USERNAME</label>
            <input type="text" name="accountLogin" placeholder="Username"><br><br>
            <img src="../images/clothe/02.png">
            <label>PASSWORD</label>
            <input type="text" name="passLogin" placeholder="Password"><br><br>
            <button name="login" class="btn btn-primary btn-lg btn-block">LOGIN</button><br>
            <a href="#">Forgot password</a><br>
            <a href="#">Don't You Have Account?</a> <a href="Register.php">REGISTER</a><img src="../images/clothe/03.png">
        </div>
    </form>
</body>

</html>