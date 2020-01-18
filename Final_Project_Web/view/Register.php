 <?php
    require_once "../database/database.php";
    $sql2 = "SELECT * from users";
    $result2 = $db->query($sql2)->fetch_all();
    $check = true;
    /*====================Register==========================*/
    if (isset($_POST['logup'])) {
        $username = ($_POST['nameLogup']);
        $useraccount = ($_POST['accountLogup']);
        $password = ($_POST['passLogup']);
        if (!$username || !$useraccount || !$password) {
            echo "Please input all information";
            exit;
        }
        for ($i = 0; $i < count($result2); $i++) {
            if ($username == $result2[$i][1] && $useraccount == $result2[$i][2] && $password == $result2[$i][3]) {
                $check = true;
                echo "Account exit! Log in!";
                exit;
            } else {
                $check = false;
            }
        }
        if ($check == false) {
            $role = "user";
            $sql2 = "INSERT into users values(null,'" . $username . "','" . $useraccount . "','" . $password . "','" . $role . "')";
            $db->query($sql2);
            echo "Log up successful!";
            header("location:Login.php");
            exit;
        }
    }
    ?>
 <!DOCTYPE html>
 <html>

 <head>
     <title></title>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <link rel="stylesheet" type="text/css" href="css/register.css">
 </head>

 <body>
     <form action="" method="post">
         <div class="line">
             <h1>SIGN UP</h1>
             <img src="../images/clothe/01.png">
             <label> NAME</label>
             <input type="text" name="nameLogup" placeholder="name"><br><br>
             <label> USERNAME </label>
             <input type="text" name="accountLogup" placeholder="Username"><br><br>
             <img src="../images/clothe/02.png">
             <label> PASSWORD </label>
             <input type="text" name="passLogup" placeholder="Password"><br><br>
             <button name="logup" class="btn btn-primary btn-lg btn-block">SIGN UP</button><br>
         </div>
     </form>
 </body>

 </html>