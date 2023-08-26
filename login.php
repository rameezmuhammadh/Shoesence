<?php

    include 'components/connect.php';

    session_start();

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id = '';
    };

    if (isset($_POST['login-submit'])){
        
        $userEmail = $_POST['userEmail'];
        $userEmail = filter_var($userEmail, FILTER_SANITIZE_STRING);

        $userPassword = sha1($_POST['userPassword']);
        $userPassword = filter_var($userPassword, FILTER_SANITIZE_STRING);

        $select_user =$conn->prepare("SELECT * FROM `users` WHERE userEmail = ? AND userPassword = ?");

        $select_user ->execute([$userEmail,$userPassword]);
        $row = $select_user->fetch(PDO::FETCH_ASSOC);

        if ($select_user->rowCount() > 0){
            $_SESSION['user_id'] = $row['uID'];

            header('location:index.php');
        }else{
           $message_error[] = "Incorrect username or password";
        
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ShoeSence Login</title>

        <!---- Browser Tab Icon ----->
        <link rel="icon" type="image/x-icon" href="images/brower-tab-icon.png">
    <!---------Custom Css----------->
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/loginandregister.css">
    <link rel="stylesheet" href="CSS/btn.css">
    <link rel="stylesheet" href="CSS/form.css">


    <!---------Remix icons--------->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">

    <!------- Google font -------->
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Prata&display=swap" rel="stylesheet">


 

</head>
<body>

      <!------------------- Nav Bar ends------------------>
      <?php include 'components/user_header.php' ?>
   
    
        <div class="form-container">
            <div class="logo">
                <img  src="images/logo.png" alt="" width="50px">
                <h4>Your Account for <br> everything ShoeSence</h4>
            </div>
                <span>Login</span>
            <form action="" method="post">
                <input type="email" placeholder="Email" name="userEmail">
                <input type="password" placeholder="Password" name="userPassword">
              
                <a href="register.php" class="register">Register</a>
                <button class="btn" type="submit" name="login-submit">Sign In</button>
            </form>
        </div>



          <!------------------- footer------------------>
    <?php include 'components/user_footer.php';?>
      <!------------------- Custom Js File------------------>
      <script src="JS/script.js"></script>

         <!---Sweet alart ----->
    <script src="JS/sweetalert.min.js"></script> 
</body>
</html>