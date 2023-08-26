<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
    header('location:login.php');
};


if(isset($_POST['updateInfo'])){

    $name =$_POST['newName'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $email = $_POST['newEmail'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $number = $_POST['newNumber'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);

    if(!empty($name)){
        $update_name = $conn->prepare("UPDATE `users` SET userName = ? WHERE uID = ?");
        $update_name->execute([$name,$user_id]);

    }
    if(!empty($email)){
        $select_email = $conn->prepare("UPDATE `users` SET userEmail = ? WHERE uID = ?");
        $select_email->execute([$email,$user_id]);
        if($select_email->rowCount() > 0){
            $message_error[]= 'Email already exists';
        }else{
            $update_email = $conn->prepare("UPDATE `users` SET userEmail = ? WHERE uID = ?");
            $update_email->execute([$email,$user_id]);
        }
    }

    if(!empty($number)){
        $select_number = $conn->prepare("SELECT * FROM `users` WHERE userPhoneNo = ?");
        $select_number->execute([$number]);
        if($select_number->rowCount() > 0){
           $message[] = 'number already taken!';
        }else{
           $update_number = $conn->prepare("UPDATE `users` SET userPhoneNo  = ? WHERE uID = ?");
           $update_number->execute([$number, $user_id]);
        }
    }

}

if(isset($_POST['updateAddress'])){

    $address = $_POST['uaddNO'] .', '.$_POST['uaddStreet'].', '.$_POST['uaddCity'].', '.$_POST['uaddPcode'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);

   $update_address = $conn->prepare("UPDATE `users` set userAddress = ? WHERE uID = ?");
   $update_address->execute([$address, $user_id]);

   $message_success[] = 'Address update!';
}

if(isset($_POST['updatePassword'])){

    $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
    $select_prev_pass = $conn->prepare("SELECT userPassword FROM `users` WHERE uID = ?");
    $select_prev_pass->execute([$user_id]);
    $fetch_prev_pass = $select_prev_pass->fetch(PDO::FETCH_ASSOC);
    $prev_pass = $fetch_prev_pass['userPassword'];
    $old_pass = sha1($_POST['oldPassword']);
    $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
    $new_pass = sha1($_POST['newPassword']);
    $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
    $confirm_pass = sha1($_POST['newCPassword']);
    $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

    if($old_pass != $empty_pass){
        if($old_pass != $prev_pass){
            $message_error[] = 'old password not matched!';
        }elseif($new_pass != $confirm_pass){
             $message_error[] = 'confirm password not matched!';
        }else{
            if($new_pass != $empty_pass){
                $update_pass = $conn->prepare("UPDATE `users` SET userPassword = ? WHERE uID = ?");
                $update_pass->execute([$confirm_pass, $user_id]);
                $message_success[] = 'Password updated successfully!';
            }else{
                $message_error[] = 'please enter a new password!';
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


      <!---- Browser Tab Icon ----->
      <link rel="icon" type="image/x-icon" href="images/brower-tab-icon.png">

    <!---------Custom Css----------->
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/navbar.css">
    <link rel="stylesheet" href="CSS/footer.css">
    <link rel="stylesheet" href="CSS/btn.css">
    <link rel="stylesheet" href="CSS/profile.css">
    <link rel="stylesheet" href="CSS/form.css">


    
    <!---------Remix icons--------->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">

    <script src="https://kit.fontawesome.com/b1114c89ce.js" crossorigin="anonymous"></script>
    <!------- Google font -------->

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Prata&display=swap" rel="stylesheet">

    <title>ShoeSence Profile</title>
</head>
<body>

<!------------------- Nav Bar starts ------------------>   
 <?php include 'components/user_header.php'; ?>
<!------------------- Nav Bar ends------------------>



<div class="tab-container">
    <div class="tab-header">
      <button class="tab-button active" onclick="openTab(event, 'tab1')"><i class="fa-solid fa-user"></i>Profile</button>
      <button class="tab-button" onclick="openTab(event, 'tab2')"><i class="fa-solid fa-truck-fast"></i>Orders</button>
      <button class="tab-button" onclick="openTab(event, 'tab3')"><i class="fa-solid fa-message"></i>Messages</button>
    </div>

    <div id="tab1" class="tab-content profile-details">
      <div class="nested-tab-container">
      <h3 class="heading">Profile</h3>
            <h5>Manage your ShoeSence Profile</h5>
        <div class="nested-tab-header">
          <button class="nested-tab-button active" onclick="openNestedTab(event, 'nested-tab1')">Details</button>
          <button class="nested-tab-button" onclick="openNestedTab(event, 'nested-tab2')">Update Info</button>
          <button class="nested-tab-button" onclick="openNestedTab(event, 'nested-tab3')">Update Address</button>
          <button class="nested-tab-button" onclick="openNestedTab(event, 'nested-tab4')">Update Password</button>
        </div>

        <div id="nested-tab1" class="nested-tab-content">
            <?php
                $select_profile =$conn->prepare("SELECT * FROM `users` WHERE uID = ?");
                $select_profile->execute([$user_id]);
                if($select_profile-> rowCount() > 0){
                    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

            ?>
            <div class="profile-info">
                <h4><i class="fa-solid fa-user fa-beat-fade"></i> Name :<?= $fetch_profile['userName'];?></h4>
                <h4><i class="fa-solid fa-envelope fa-beat-fade"></i> Email :<?= $fetch_profile['userEmail'];?></h4>
                <h4><i class="fa-solid fa-phone fa-beat-fade"></i> Phone No:<?= $fetch_profile['userPhoneNo'];?></h4>
                <h4><i class="fa-solid fa-location-dot fa-beat-fade"></i> Address :<?= $fetch_profile['userAddress'];?></h4>
                <a href="components/user_logout.php" class="btn">Logout</a>
            </div>
            <?php
            }
            ?>
        </div>
        </div>
        <div id="nested-tab2" class="nested-tab-content">

            <h3 class="heading">Update Info</h3>

            <?php
                            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE uID = ?");
                            $select_profile->execute([$user_id]);
                            if($select_profile->rowCount() > 0){
                            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                        ?>

            <form action="" method="post">
                <input type="text" name="newName" placeholder="Name">
                <input type="email" name="newEmail" placeholder="Email">
                <input type="number" name="newNumber" placeholder="Phone Number" oninput="enforceLength(this, 10)">
                  <button class="btn" type="submit" name="updateInfo">Update Info</button>
            </form>
                        <?php
                            }
                        ?>
        </div>
        <div id="nested-tab3" class="nested-tab-content">

            <h3 class="heading">Update Address</h3>
            <?php
                            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE uID = ?");
                            $select_profile->execute([$user_id]);
                            if($select_profile->rowCount() > 0){
                            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                        ?>
            <form action="" method="post">
                <input type="text" placeholder="Address - No" id="address" name="uaddNO" >
                <input type="text" placeholder="Address - Street Name" id="address" name="uaddStreet" >
                <input type="text" placeholder="Address - City" id="address" name="uaddCity" >
                <input type="number" placeholder="Postal code" id="address" name="uaddPcode"  oninput="enforceLength(this, 5)">
                <button class="btn" type="submit" name="updateAddress">Update Address</button>
            </form>
            <?php
                            }
                        ?>
        </div>
        <div id="nested-tab4" class="nested-tab-content">

            <h3 class="heading">Update Password</h3>
            <?php
                            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE uID = ?");
                            $select_profile->execute([$user_id]);
                            if($select_profile->rowCount() > 0){
                            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                        ?>
            <form action="" method="post">
                <input type="password" name="oldPassword" placeholder="Old Password" minlength="8" oninput="this.value = this.value.replace(/\s/g, '')" required>
                <input type="password" name="newPassword" placeholder="New Password" minlength="8" oninput="this.value = this.value.replace(/\s/g, '')" required>
                <input type="password" name="newCPassword" placeholder="Confirm Password" minlength="8" oninput="this.value = this.value.replace(/\s/g, '')" required>
                <button class="btn" type="submit" name="updatePassword">Update Password</button>
            </form>
            <?php
                            }
                        ?>
        </div>
      </div>
    </div>
    <div id="tab2" class="tab-content">
        <h3 >Orders</h3>
        <h5>You can see your orders here</h5>
  
          <table>
              <thead>
                  <tr>
                  <th>Order ID</th>
                  <th>Products</th>
                  <th>Delivery Status</th>
                  <th>Payment Status</th>
                  <th>Total Price</th>
                  <th>Est Delivery</th>
                  </tr>
              </thead>
              <tbody>
                
              <?php


                 $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
                    $select_orders->execute([$user_id]);
                    if($select_orders->rowCount() > 0){
                    while($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)){
                        
                    ?>
                    
                    <input type="hidden" name="order_id" value="<?= $fetch_order['orders_ID']; ?>">

                  <tr>
                  <td>#<?=$fetch_order['orders_ID'];?></td>
                  <td><?=$fetch_order['total_products'];?></td>
                  <td><?=$fetch_order['deleivery_status'];?></td>
                  <td><?=$fetch_order['payment_status'];?></td>
                  <td>Rs. <?=$fetch_order['total_price'];?></td>
                  <td><?=$fetch_order['estimated_delivery'];?></td>

                  </tr>
                  <?php
                        }
                 
              }else{
                  echo '<h5 class="empty_message">You have no orders</h5>';
              }
            
              ?>
              </tbody>
          </table>
    </div>
    <div id="tab3" class="tab-content">
        <h3 class="heading-msg">Messages</h3>
        <h5>You can watch your Messages and replay here</h5>
  
          <table>
              <thead>
                  <tr>
                  <th>Message</th>
                  <th>Replay</th>
                  </tr>
              </thead>
              <tbody>
              <?php
              $select_messages = $conn->prepare("SELECT * FROM `messages` WHERE user_id = ?");
              $select_messages->execute([$user_id]);
              if($select_messages->rowCount() > 0){
              while($fetch_messages = $select_messages->fetch(PDO::FETCH_ASSOC)){
              ?>
                  <tr>
                  <td><?= $fetch_messages['message']; ?></td>
                  <td><?= $fetch_messages['reply']; ?></td>
                  </tr>
                  <?php
              }
              }else{
                  echo '<h5 class="empty_message">You have no messages</h5>';
              }
              ?>
              </tbody>
          </table>
    </div>
  </div>
  


     <!------------------- Footer section starts------------------>
     <?php include 'components/user_footer.php' ;?>
 <!------------------- Footer section ends------------------>

<script>
    function openTab(event, tabId) {
    // Get all tab content elements
    var tabContent = document.getElementsByClassName('tab-content');

    // Hide all tab content elements
    for (var i = 0; i < tabContent.length; i++) {
    tabContent[i].style.display = 'none';
    }

    // Get all tab buttons and remove 'active' class
    var tabButtons = document.getElementsByClassName('tab-button');
    for (var i = 0; i < tabButtons.length; i++) {
    tabButtons[i].classList.remove('active');
    }

    // Show the selected tab content and mark the button as active
    document.getElementById(tabId).style.display = 'block';
    event.currentTarget.classList.add('active');
    }

    function openNestedTab(event, nestedTabId) {
    // Get all nested tab content elements
    var nestedTabContent = document.getElementsByClassName('nested-tab-content');

    // Hide all nested tab content elements
    for (var i = 0; i < nestedTabContent.length; i++) {
    nestedTabContent[i].style.display = 'none';
    }

    // Get all nested tab buttons and remove 'active' class
    var nestedTabButtons = document.getElementsByClassName('nested-tab-button');
    for (var i = 0; i < nestedTabButtons.length; i++) {
    nestedTabButtons[i].classList.remove('active');
    }

    // Show the selected nested tab content and mark the button as active
    document.getElementById(nestedTabId).style.display = 'block';
    event.currentTarget.classList.add('active');
    }

    // Set the first tab and first nested tab as active by default
    document.getElementsByClassName('tab-button')[0].click();
    document.getElementsByClassName('nested-tab-button')[0].click();


            function enforceLength(input, maxLength) {
            if (input.value.length > maxLength) {
            input.value = input.value.slice(0, maxLength);
                }
            }  
           
</script>


</body>
</html>