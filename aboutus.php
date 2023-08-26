<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
   
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoesence About Us</title>

    <!---- Browser Tab Icon ----->
    <link rel="icon" type="image/x-icon" href="images/brower-tab-icon.png">


    <!---------Custom Css----------->
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/aboutus.css">

    <!---------Remix icons--------->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">

    <!------- Google font -------->
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Prata&display=swap" rel="stylesheet">

</head>
<body>

  <!------------------- Nav Bar ends------------------>
  <?php include 'components/user_header.php' ?>
   
    
    <div class="aboutus">
        <div class="about-logo">
            <img src="images/logo.png" alt="">
        </div>
        <div class="about-details">
            <div class="details-info">
            <h4>About ShoeSence</h4>
            <p>ShoeSence is a well-established footwear store that has been serving customers for over 10 years. We take pride in being a trusted and reputable destination for all your footwear needs. At ShoeSence, we believe that a great pair of shoes can enhance your style, comfort, and confidence.</p>
            </div>
            
            <div class="details-info">
       
       <h4>Our Commitment</h4>
            <p>We are dedicated to providing our customers with a wide range of high-quality footwear options for men, women, and children. Whether you're looking for casual shoes, formal footwear, sports shoes, or specialty shoes, we have a vast collection to suit every taste and occasion. Our team of knowledgeable and friendly staff is always available to assist you in finding the perfect pair that matches your style and fits comfortably.</p>  
        </div>

            <div class="details-info">

            <h4>Customer Satisfaction</h4>
            <p>ShoeSence carries a diverse selection of footwear from renowned brands and designers. We carefully curate our inventory to offer the latest trends, timeless classics, and functional shoes to cater to various preferences and lifestyles. From fashionable heels and dress shoes to athletic sneakers and sturdy boots, we have something for everyone</p>
        </div>

            <div class="details-info">

            <h4>Reputation</h4>         
            <p>Over the years, ShoeSence has built a strong reputation for delivering exceptional products and service. We have earned the trust and loyalty of our customers by consistently offering reliable and stylish footwear options. Our reputation as a trusted store has been established through years of providing top-notch customer service and maintaining the highest standards of quality.</p>
        </div>

            <div class="details-info">

            <h4>Community Involvement</h4>     
            <p>At ShoeSence, we believe in giving back to the community that has supported us throughout our journey. We actively participate in local charitable initiatives and events, working to make a positive impact in the lives of those around us. By shopping at ShoeSence, you not only get access to top-notch footwear but also contribute to the betterment of the community.</p>
        </div>
           
            <div class="details-info">

            <h4>Visit ShoeSence</h4>
            <p>We invite you to visit ShoeSence and experience our exceptional range of footwear. Our store is designed to provide a comfortable and welcoming environment where you can explore various options and find the perfect shoes for any occasion. Discover the ShoeSence difference and let us help you put your best foot forward.</p>
            </div>



        </div>
    </div>
    


      <!------------------- footer------------------>
      <?php include 'components/user_footer.php' ?>
      <!------------------- Custom Js File------------------>
      <script src="JS/script.js"></script>
</body>
</html>