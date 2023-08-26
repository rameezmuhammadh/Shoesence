<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Messages</title>

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


    <h3 class="i-messageheading">Messages</h3>
    
    <div class="board  messages">
    
        <table width="100%">
            <thead>
            <tr>
                <td>Message ID</td>
                <td>User </td>
                <td>Date</td>
                <td>Message</td>
                <td>Reply</td>
                <td>Action</td>
            </tr>
            </thead>
            <tbody>
            <?php
            $select_messages = $conn->prepare("SELECT * FROM `messages` ORDER BY `m_ID` DESC");
            $select_messages->execute();
            if($select_messages->rowCount() > 0){
            while($fetch_messages = $select_messages->fetch(PDO::FETCH_ASSOC)){
            ?>
            <tr>
                <td class="">
                    <h5>#<?= $fetch_messages['m_ID']; ?></h5>
                </td>
                <td class="">
                    <h5><?= $fetch_messages['sender_name']; ?></h5>
                    <p>#<?= $fetch_messages['user_id']; ?></p>
                </td>
                <td>
                    <h5><?= $fetch_messages['message_date']; ?></h5>
                </td>
                <td>
                   <h5><?= $fetch_messages['message']; ?></h5>
                </td>
                <td>
                    <h5><?= $fetch_messages['reply']; ?></h5>
                </td>
                <td >
                    <a href="reply_messages.php?submit=<?= $fetch_messages['m_ID']; ?>" class="td-reply">Reply</a>
                    <a href="message_details.php?submit=<?= $fetch_messages['m_ID']; ?>" class="td-details">Details</a>
                </td>
            </tr>

                <?php
            }
            }else{
                echo '<p class="empty_message">you have no messages</p>';
            }
            ?>
            </tbody>
        </table>
</section>
<script src="../JS/admin_script.js"></script>
</body>
</html>
  