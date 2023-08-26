<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:admin_login.php');
}

if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];
    $delete_order = $conn->prepare("DELETE FROM `messages` WHERE m_ID = ?");
    $delete_order->execute([$delete_id]);
    header('location:Messages.php');

 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Messages details</title>

         <!---- Browser Tab Icon ----->
         <link rel="icon" type="image/x-icon" href="../images/brower-tab-icon.png">

    <!---Custom CSS -->
    <link rel="stylesheet" href="../admin/CSS/admin_style.css">
    <link rel="stylesheet" href="../admin/CSS/manageproducts.css">
    <link rel="stylesheet" href="../admin/CSS/messages.css">
    

    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">


    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>
<body>
<?php include 'menu.php';?>


<section id="interface">

    <?php include 'navsection.php';?>


    <h3 class="i-messageheading">Messages </h3>
    
    <div class="board  messages">

        <div class="message-details">
            <?php
         if(isset($_GET['submit'])) {
            $update_id = $_GET['submit'];
            $select_orders = $conn->prepare("SELECT * FROM `messages` WHERE m_ID = ?");
            $select_orders->execute([$update_id]);
            if($select_orders->rowCount() > 0){
                while($fetch_messages = $select_orders->fetch(PDO::FETCH_ASSOC)){
            ?>
                <h4>Sender Name :&nbsp &nbsp <?= $fetch_messages['sender_name']; ?></h4>
                <h4>User ID :&nbsp &nbsp <?= $fetch_messages['user_id']; ?></h4>
                <h4>Email :&nbsp &nbsp <?= $fetch_messages['sender_email']; ?></h4>
                <h4>Telephone Number :&nbsp &nbsp <?= $fetch_messages['sender_phoneNo']; ?></h4>
                <h4>Message ID :&nbsp &nbsp <?= $fetch_messages['m_ID']; ?></h4>
                <h4>Message Date :&nbsp &nbsp <?= $fetch_messages['message_date']; ?></h4>
                <h4>Message :&nbsp &nbsp <?= $fetch_messages['message']; ?></h4>
                <h4>Reply :&nbsp &nbsp <?= $fetch_messages['reply']; ?></h4>
                <h4>Reply Date :&nbsp &nbsp <?= $fetch_messages['reply_time']; ?></h4>
 

                <a href="message_details.php?delete=<?=$fetch_messages['m_ID'];?>" onclick="return confirm('Delete this Messages?');" class="btn">Delete Message</a>
                <?php
            }
            }else{
                echo '<p class="empty_message">you have no messages</p>';
            }
        }
            ?>
        </div>    
    </div>    

</section>
<script src="../JS/admin_script.js"></script>
</body>
</html>
