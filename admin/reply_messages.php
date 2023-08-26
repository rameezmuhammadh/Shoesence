<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['reply-message'])){

    $msg_id = $_POST['msg_id'];
    $msg_id = filter_var($msg_id, FILTER_SANITIZE_STRING);
    $reply = $_POST['reply'];
    $reply = filter_var($reply, FILTER_SANITIZE_STRING);

    $reply_date = $_POST['replay_date'];
    $reply_date = filter_var($reply_date, FILTER_SANITIZE_STRING);

    $update_messages = $conn->prepare("UPDATE `messages` SET reply = ?, reply_time = ? WHERE m_ID = ?");
    $update_messages->execute([$reply,$reply_date, $msg_id]);
    $message_success[] = 'Reply Send successfully';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reply Messages</title>

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
    
    <div class="board  messages-replay">
        
    <div class="message-reply">

        <form action="" method="post">

        <?php
        $update_id = $_GET['submit'];
        $show_messages = $conn->prepare("SELECT * FROM `messages` WHERE m_ID = ?");
        $show_messages->execute([$update_id]);
        if($show_messages->rowCount() > 0){
        while($fetch_messages = $show_messages->fetch(PDO::FETCH_ASSOC)){

        ?>

        <h4>Sender Name :  <?= $fetch_messages['sender_name']; ?></h4>
        <h4>User ID :  <?= $fetch_messages['user_id']; ?></h4>
        <h4>Message ID :  <?= $fetch_messages['m_ID']; ?></h4>
        <h4>Message :  <?= $fetch_messages['message']; ?></h4>
        <h4>Reply :  <?= $fetch_messages['reply']; ?></h4>

            <input type="hidden" name="msg_id" value="<?= $fetch_messages['m_ID']; ?>">

            <input type="hidden" name="replay_date" value="<?= date('Y-m-d'); ?>">


            <input type="text" name="reply" id="" placeholder="Reply Message">
            <Button type="submit" class="btn" name="reply-message">Reply</Button>
            <?php
                }
            }
            ?>
        </form>

        </div>
       
       

    </div>    

</section>
<script src="../JS/admin_script.js"></script>
</body>
</html>
