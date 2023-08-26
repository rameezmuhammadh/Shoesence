<?php

include '../components/connect.php';


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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!---Custom CSS -->
    <link rel="stylesheet" href="../admin/CSS/admin_style.css">
    <link rel="stylesheet" href="../admin/CSS/manageproducts.css">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>
<body>

        <div class="navigation">
            <div class="n1">
                <di>
                    <i  id ="menu-btn" class="ri-menu-line"></i>
                </di>
                <!-- <div class="search">
                    <i class="ri-search-2-line"></i>
                    <input type="text" placeholder="Search">
                </div> -->
            </div>
            <div class="profile">
            <?php
            $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE admin_ID = ?");
            $select_profile->execute([$admin_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
                <p>
                    <small> Welcome Back 👨‍💻 </small><br>
                    <?= $fetch_profile['admin_Name']; ?>
                   
                </p>
                
            </div>
            <?php 
            }
            ?>
        </div>

        
        
        <script src="../JS/admin_script.js"></script>
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
</body>
</html>