<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
};

    if (isset($_POST['register-submit'])) {

    $username = $_POST['uName'];
    $username = filter_var($username, FILTER_SANITIZE_STRING);

    $userEmail = $_POST['uEmail'];
    $userEmail = filter_var($userEmail, FILTER_SANITIZE_STRING);

    $userPhoneNo = $_POST['uPhoneNo'];
    $userPhoneNo = filter_var($userPhoneNo, FILTER_SANITIZE_STRING);

    $userAddress = $_POST['uaddNO'] . ', ' . $_POST['uaddStreet'] . ', ' . $_POST['uaddCity'] . ', ' . $_POST['uaddPcode'];
    $userAddress = filter_var($userAddress, FILTER_SANITIZE_STRING);

    $userPassword = sha1($_POST['uPassword']);
    $userPassword = filter_var($userPassword, FILTER_SANITIZE_STRING);

    $userPasswordCon = sha1($_POST['uConPassword']);
    $userPasswordCon = filter_var($userPasswordCon, FILTER_SANITIZE_STRING);

    $select_user = $conn->prepare("SELECT * FROM `users` WHERE userEmail  = ? OR userPhoneNo = ?");
    $select_user->execute([$userEmail, $userPhoneNo]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);

    if ($select_user->rowCount() > 0){
        $message_error []= "Email already taken";
    }
    else {
        if ($userPassword != $userPasswordCon){
            $message_error = "confirm password not match";
        }
        else {
            $insert_user = $conn->prepare("INSERT INTO `users` (userName,userEmail,userAddress,userPhoneNo ,userPassword) VALUES (?,?,?,?,?)");
            $insert_user->execute([$username,$userEmail,$userAddress,$userPhoneNo,$userPasswordCon]);
            $select_user = $conn ->prepare("SELECT * FROM `users` WHERE userEmail = ? AND userPassword = ? ");
            $select_user->execute([$userEmail,$userPasswordCon]);
            $row = $select_user->fetch(PDO::FETCH_ASSOC);
            if ($select_user ->rowCount() > 0){
                $_SESSION[`user_id`] =$row[`uID`];
                $message_success []= "Account Created Successfully";
                header('Location:index.php');
                }
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Shoesence Register</title>


        <!---- Browser Tab Icon ----->
        <link rel="icon" type="image/x-icon" href="images/brower-tab-icon.png">
    <!---------Custom Css----------->
    <link rel="stylesheet" href="CSS/style.css">

    <link rel="stylesheet" href="CSS/loginandregister.css">
    <link rel="stylesheet" href="CSS/btn.css">
    <link rel="stylesheet" href="CSS/form.css">
    <link rel="stylesheet" href="CSS/footer.css">

    <!---------Remix icons--------->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">

    <!------- Google font -------->
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Prata&display=swap" rel="stylesheet">

</head>
<body>

      <!------------------- Nav Bar ends------------------>
      <?php include 'components/user_header.php' ?>
   
    
        <div class="form-container ">
            <div class="logo">
                <img  src="images/logo.png" alt="" width="50px">
                <h4>Welcome to ShoeSence</h4>
            </div>
                <span>Register</span>
            <form action="" method="post">

                <input type="text" placeholder="Name" id="name" name="uName" required>
                <input type="email" placeholder="Email" name="uEmail" required>
                <input type="number" placeholder="Phone No" id="phoneNo" name="uPhoneNo" required  oninput="enforceLength(this, 10)">

                <input type="text" placeholder="Address - No" id="address" name="uaddNO" required>
                <input type="text" placeholder="Address - Street Name" id="address" name="uaddStreet" required>
                <input type="text" placeholder="Address - City" id="address" name="uaddCity" required>
                <input type="number" placeholder="Postal code" id="address" name="uaddPcode"  required  oninput="enforceLength(this, 5)">
                <input type="password" placeholder="Password" name="uPassword" minlength="8" required >
                <input type="password" placeholder="Confirm Password" name="uConPassword" minlength="8" required>

              
                <a href="login.php" class="login-link">Already have a account</a>
                <button class="btn" type="submit" name="register-submit">Register</button>
            </form>
        </div>
        <div class="space"></div>
            
        

    <!------------------- footer------------------>
    <?php include 'components/user_footer.php'; ?>
      <!------------------- Custom Js File------------------>
      <script src="JS/script.js"></script>

       
      <script>
            function enforceLength(input, maxLength) {
            if (input.value.length > maxLength) {
            input.value = input.value.slice(0, maxLength);
                }
            }  
            </script>
</body>
</html>