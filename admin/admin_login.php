<?php

include '../components/connect.php';

session_start();


if(isset($_POST['admin-login'])){

    $name = $_POST['email'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['password']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE admin_email = ? AND admin_password = ?");
    $select_admin->execute([$name, $pass]);

    if($select_admin->rowCount() > 0){
        $fetch_admin_id = $select_admin->fetch(PDO::FETCH_ASSOC);
        $_SESSION['admin_id'] = $fetch_admin_id['admin_ID'];
        header('location:dashboard.php');
    }else{
        $message_error[] = 'incorrect username or password!';
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

        <!---- Browser Tab Icon ----->
        <link rel="icon" type="image/x-icon" href="../images/brower-tab-icon.png">

    <!---Custom CSS -->
    <link rel="stylesheet" href="../admin/CSS/admin_style.css">
    <link rel="stylesheet" href="../admin/CSS/manageproducts.css">
    <link rel="stylesheet" href="../admin/CSS/admin_login.css">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>
<body>


<div class=admin-login>
  <h3 class="login-heading">Admin Login</h3>
              <form action="" method="post">
                <input class="" type="text" placeholder="Email" name="email">
                <input class="" type="password" placeholder="Password" name="password">
                <button type="submit" name="admin-login" class="btn">Login</button>
              </form> 
</div>

    <script src="../JS/admin_script.js"></script>
</body>
</html>
