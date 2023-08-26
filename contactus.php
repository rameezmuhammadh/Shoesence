<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
};

if(isset($_POST['send-message'])){

    $name = $_POST['senderName'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['senderEmail'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $number = $_POST['senderPhoneNo'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $msg = $_POST['message'];
    $msg = filter_var($msg, FILTER_SANITIZE_STRING);
    $message_date = $_POST['message_date'];
    $message_date = filter_var($message_date, FILTER_SANITIZE_STRING);

    $select_message = $conn->prepare("SELECT * FROM `messages` WHERE sender_name = ? AND sender_email = ? AND sender_phoneNo = ? AND message = ?");
    $select_message->execute([$name, $email, $number, $msg]);

    if($select_message->rowCount() > 0){
        $message[] = 'already sent message!';
    }else{

        $insert_message = $conn->prepare("INSERT INTO `messages`(user_id,sender_name, sender_email, sender_phoneNo, message,message_date) VALUES(?,?,?,?,?,?)");
        $insert_message->execute([$user_id,$name, $email, $number, $msg, $message_date]);
        $message_success[] = 'sent message successfully!';
    }
    }


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
   
    <link rel="stylesheet" href="CSS/form.css">
    <link rel="stylesheet" href="CSS/btn.css">
    <link rel="stylesheet" href="CSS/contactus.css">

    
    <!---------Remix icons--------->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">

    <!------- Google font -------->

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Prata&display=swap" rel="stylesheet">

    <title>ShoeSence - Contact us</title>
</head>
<body>

  <!------------------- Nav Bar ends------------------>
  <?php include 'components/user_header.php' ?>
   
    <div class="contactus contacus-container">
        <div class="item item-1">
            <img src="images/logo.png" alt="">

            <div class="contact-details">    
                <div class="details email">
                    <h4>Email</h4>
                    <p>info@shoesence.com</p>
                </div>
                <div class="details phone-no">
                    <h4>Contact No</h4>
                    <p>035 2240 123<br></p>
                    <p>035 2240 124</p>
                </div>
                <div class="details address">
                    <h4>Address</h4>
                    <p>63/2, <br>Uyanwatta, <br>Dewanagala.</p>
                </div>
            </div>
        </div>
        <div class="item item-2">
            <span>Send Message</span>
            <form action="" method="post">
                <input type="text" placeholder="Name" name="senderName">
                <input type="email" placeholder="Email" name="senderEmail">
                <input type="number" placeholder="Telephone" name="senderPhoneNo" id="phoneNo" oninput="enforceLength(this, 10)">

                <textarea  id="" cols="30" rows="10" placeholder="Please type your message here" name="message" ></textarea>

                <input type="hidden" name="user_id" >
                <input type="hidden" name="message_date" value="<?= date('Y-m-d'); ?>">
                <button class="btn" type="submit" name="send-message">Send Message</button>
            </form>
        </div>

    </div>


      <!------------------- footer------------------>
      <?php include 'components/user_footer.php' ;?>
      
         <!------------------- Custom Js File------------------>
         <script src="JS/script.js"></script>
         
         <!------------------- Custom Js File------------------>
         
            <script>
            function enforceLength(input, maxLength) {
            if (input.value.length > maxLength) {
            input.value = input.value.slice(0, maxLength);
                }
            }  
            </script>
</body>
</html>