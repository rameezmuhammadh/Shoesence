<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
};

include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!---- Browser Tab Icon ----->
        <link rel="icon" type="image/x-icon" href="images/brower-tab-icon.png">

    <!---------Custom Css----------->
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/navbar.css">
    <link rel="stylesheet" href="CSS/footer.css">
    <link rel="stylesheet" href="CSS/btn.css">

    
    <!---------Remix icons--------->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">

    <!------- Google font -------->

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Prata&display=swap" rel="stylesheet">

    <title>ShoeSence - Home</title>
</head>
<body>

    <!------------------- Nav Bar starts ------------------>   
     <?php include 'components/user_header.php'; ?>
     <!------------------- Nav Bar ends------------------>


        <div class="hero">
            <div class="content text">
                <h1>Welcome to ShoeSence</h1>
                <h4>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</h4>
                <a href="productspage.php" class="btn hero-btn">Shop  &nbsp;<i class="ri-arrow-right-line"></i></a>
            </div>
            <div class="content image">
                <img src="./images/hero4.png" alt="">
            </div>
        </div>
 

<div class="category">
    <div class="cat men">
        <img src="images/men.png" alt="">
        <button class="btn"><a href="productspage-men.php">Men</a></button>
    </div>
    <div class="cat women">
        <img src="images/women.png" alt="">
        <button class="btn"><a href="productspage-women.php">Women</a></button>

    </div>
    <div class="cat kids">
        <img src="images/kids.jpeg" alt="">
       <button class="btn"> <a href="productspage-kids.php" class="">Kid</a></button> 

    </div>
</div>


 




    <!------------------- footer------------------>
    <?php include 'components/user_footer.php' ;?>


     <!------------------- Custom Js File------------------>
      <script src="JS/script.js"></script>
</body>
</html>