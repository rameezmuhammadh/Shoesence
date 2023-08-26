<?php
include '../components/connect.php';

session_start();
$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}
if(isset($_POST['update-info'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $number = $_POST['phoneNo'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pwd']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);


    $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE admin_password = ?");
    $select_admin->execute([$pass]);

    if($select_admin->rowCount() > 0){
        $fetch_admin_id = $select_admin->fetch(PDO::FETCH_ASSOC);
        $_SESSION['admin_id'] = $fetch_admin_id['admin_ID'];
        header('location:update_admin.php');

        if(!empty($name)){
            $update_name = $conn->prepare("UPDATE `admin` SET admin_Name = ? WHERE admin_ID = ?");
            $update_name->execute([$name, $admin_id]);
        }

        if(!empty($email)){
            $select_email = $conn->prepare("SELECT * FROM `admin` WHERE admin_email = ?");
            $select_email->execute([$email]);
            if($select_email->rowCount() > 0){
                $message_error[] = 'Email already taken!';
            }else{
                $update_email = $conn->prepare("UPDATE `admin` SET admin_email = ? WHERE admin_ID = ?");
                $update_email->execute([$email, $admin_id]);
                $message_success[] = "Email updated";
            }
        }
 
        if(!empty($number)){
            $select_number = $conn->prepare("SELECT * FROM `admin` WHERE admin_phoneNo = ?");
            $select_number->execute([$number]);
            if($select_number->rowCount() > 0){
                $message_error[] = 'Number already taken!';
            }else{
                $update_number = $conn->prepare("UPDATE `admin` SET admin_phoneNo = ? WHERE admin_ID = ?");
                $update_number->execute([$number, $admin_id]);
                header('location:admin_profile.php');
            }
        }
    }else {
            $message_error[] = 'Incorrect password!';
        }
     }
    


if(isset($_POST['update-admin-pwd'])){

    $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
    $select_old_pass = $conn->prepare("SELECT admin_password FROM `admin` WHERE admin_ID = ?");
    $select_old_pass->execute([$admin_id]);
    $fetch_prev_pass = $select_old_pass->fetch(PDO::FETCH_ASSOC);
    $prev_pass = $fetch_prev_pass['admin_password'];
    $old_pass = sha1($_POST['oldpwd']);
    $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
    $new_pass = sha1($_POST['newPassword']);
    $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
    $confirm_pass = sha1($_POST['cPassword']);
    $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

    if($old_pass != $empty_pass){
        if($old_pass != $prev_pass){
            $message_error[] = 'old password not matched!';
        }elseif($new_pass != $confirm_pass){
            $message_error[] = 'confirm password not matched!';
        }else{
            if($new_pass != $empty_pass){
                $update_pass = $conn->prepare("UPDATE `admin` SET admin_password = ? WHERE admin_ID = ?");
                $update_pass->execute([$confirm_pass, $admin_id]);
                $message_success[] = 'password updated successfully!';
            }else{
                $message[] = 'please enter a new password!';
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
    <title>Update Admin</title>

        <!---- Browser Tab Icon ----->
        <link rel="icon" type="image/x-icon" href="../images/brower-tab-icon.png">

    <!---Custom CSS -->
    <link rel="stylesheet" href="../admin/CSS/admin_style.css">
    <link rel="stylesheet" href="../admin/CSS/manageproducts.css">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>
<body>

<?php include 'menu.php';?>


<section id="interface">
    <?php include 'navsection.php';?>

        <div class="board board-form">
        <h3 class="i-tableheading">Update Admin Details</h3>

            <div class="form-container">
              <form action="" method="post">

                  <?php
                  $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE admin_ID = ?");
                  $select_profile->execute([$admin_id]);
                  if($select_profile->rowCount() > 0){
                  $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                  ?>


                  <input class="" type="text" placeholder="Name" name="name">
                <input class="" type="text" placeholder="Email" name="email">
                <input class="" type="number" placeholder="Phone Number" name="phoneNo" oninput="enforceLength(this, 10)">
                  <input class="" type="Password" placeholder="Enter Password" name="pwd">
                <button type="submit" name="update-info" class="btn register-admin-btn">Update Info</button>

              </form>
                <?php
                }
                ?>
                <h3 class="i-tableheading">Update Admin Password</h3>

              <form action="" method="post">


                <input class="" type="Password" placeholder="Enter old Password" name="oldpwd">
                <input class="" type="Password" placeholder="Password" name="newPassword">
                <input class="" type="Password" placeholder="Retype Password" name="cPassword">
                <button type="submit" name="update-admin-pwd" class="btn register-admin-btn">Update Password</button>

              </form>

            </div>
        </div>
       
    </section>
    <script src="../JS/admin_script.js"></script>
     
    <script>
            function enforceLength(input, maxLength) {
            if (input.value.length > maxLength) {
            input.value = input.value.slice(0, maxLength);
                }
            }  
            </script>
</body>
</html>
