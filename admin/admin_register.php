<?php
include '../components/connect.php';

session_start();
$admin_id=$_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['register-admin'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $number = $_POST['phoneNo'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['password']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = sha1($_POST['cpassword']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE admin_email = ? OR admin_phoneNo = ?");
    $select_admin->execute([$email, $number]);

    if($select_admin->rowCount() > 0){
        $message_error[] = 'email or number already exists!';
    }else{
        if($pass != $cpass){
            $message_error[] = 'confirm password not matched!';
        }else{
            $insert_admin = $conn->prepare("INSERT INTO `admin`(admin_Name, admin_email, admin_phoneNo, admin_password) VALUES(?,?,?,?)");
            $insert_admin->execute([$name, $email, $number, $cpass]);
            $message_success[] = 'new admin registered!';
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
    <title>Admin Register</title>

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
        <h3 class="i-tableheading">Register New Admin</h3>
            <div class="form-container">
              <form action="" method="post">
                <input class="" type="text" placeholder="Name" name="name">
                <input class="" type="text" placeholder="Email" name="email">
                <input class="" type="number" placeholder="Phone Number" name="phoneNo" oninput="enforceLength(this, 10)">
                <input class="" type="Password" placeholder="Password" name="password">
                <input class="" type="Password" placeholder="Retype Password" name="cpassword">

        
                <button type="submit" name="register-admin" class="btn register-admin-btn">Register</button>
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
