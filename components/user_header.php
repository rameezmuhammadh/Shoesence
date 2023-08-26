<?php
if (isset($message)) {
    foreach ($message as $msg) {
        echo '
       <div class="message message-info">
         <div class="message-content">
           <span>
           <i class="fa-solid fa-circle-exclamation fa-2xl" style="color: #2F86EB;"></i> '.$msg.'
           </span>
           <i class="fa-solid fa-circle-xmark fa-2xs" style="color: #ff355b;" onclick="removeMessage(this.parentElement.parentElement);"></i>
         </div>
         <div class="progress-bar"></div>
       </div>';
    }
}

if (isset($message_success)) {
    foreach ($message_success as $msg_success) {
        echo '
       <div class="message message-success">
         <div class="message-content">
           <span>
               <i class="fa-solid fa-circle-check fa-2xl" style="color: #47d764;"></i> '.$msg_success.'
           </span>
           <i class="fa-solid fa-circle-xmark fa-2xs" style="color: #ff355b;" onclick="removeMessage(this.parentElement.parentElement);"></i>
         </div>
         <div class="progress-bar"></div>
       </div>';
    }
}

if (isset($message_error)) {
    foreach ($message_error as $msg_error) {
        echo '
       <div class="message message-error">
         <div class="message-content">
           <span>
           <i class="fa-solid fa-circle-exclamation fa-2xl" style="color: #ff355b;"></i> '.$msg_error.'
           </span>
           <i class="fa-solid fa-circle-xmark fa-2xs" style="color: #ff355b;" onclick="removeMessage(this.parentElement.parentElement);"></i>
         </div>
         <div class="progress-bar"></div>
       </div>';
    }
}




?>






<!DOCTYPE html>
   <html lang="en">
   <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/navbar.css">
    <link rel="stylesheet" href="CSS/footer.css">
    
     <!---Custom Icon Library Font awesome -->
     <script src="https://kit.fontawesome.com/b1114c89ce.js" crossorigin="anonymous"></script>
   </head>
   <body>
    

   
   <!------------------- Nav Bar starts ------------------>
     <nav>
        <div class="container nav_container">
            <a href="index.php" class="nav_logo">
                <img src="./images/logo.png" alt="Logo">
            </a>

            <Ul class="nav_links">
                <li><a href="index.php">Home</a></li>
                <li><a href="productspage.php">Products</a></li>
                <li><a href="contactus.php">Contact Us</a></li>
                <li><a href="aboutus.php">About us</a></li>
            </Ul>

            <ul class="nav_icons">
                <li>
                    <a href="search.php">
                         <i class="ri-search-line"></i>
                    </a>
                </li>
                <li>
                     <a href="profile.php">
                        <i class="ri-user-line"></i>
                     </a>
                </li>
                <li>
                <?php

                    $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                    $count_cart_items->execute([$user_id]);
                    $total_cart_items = $count_cart_items->rowCount();

                    ?>
                    <a href="cart.php">
                    <i class="ri-shopping-bag-line"></i><p><!--
                    (< //$total_cart_items; ?>) --></p>
                    </a>
                </li>
                <li>
                    <p>(<?= $total_cart_items; ?>)</p>
                     
                </li>
            </ul>

            <button class="nav_toggle-btn" id = "nav_toggle-open"><i class="ri-menu-line"></i></button>
            <button class="nav_toggle-btn" id = "nav_toggle-close"><i class="ri-close-line"></i></button>

        </div>

     
      </nav>

 
        <script>
        function removeMessage(messageElement) {
        messageElement.style.opacity = 0;
        setTimeout(function () {
        messageElement.remove();
        }, 500);
        }

        setTimeout(function () {
        var messageElement = document.querySelector('.message');
        if (messageElement) {
            removeMessage(messageElement);
        }
        }, 5000);

        </script>
  




           
 
