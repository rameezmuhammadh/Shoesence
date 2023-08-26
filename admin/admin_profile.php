<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:admin_login.php');
};


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>

    <!---- Browser Tab Icon ----->
    <link rel="icon" type="image/x-icon" href="../images/brower-tab-icon.png">

    <!---Custom CSS -->
    <link rel="stylesheet" href="../admin/CSS/admin_style.css">
    <link rel="stylesheet" href="../admin/CSS/manageproducts.css">
    <link rel="stylesheet" href="../admin/CSS/admin_login.css">


    <script src="https://kit.fontawesome.com/b1114c89ce.js" crossorigin="anonymous"></script>


    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>
<body>
<?php include 'menu.php';?>


<section id="interface">
    <?php include 'navsection.php';?>

    <div class="board admin-details">

        <div class=profile-details>
            <?php
            $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE admin_ID = ?");
            $select_profile->execute([$admin_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
        <h3 class="i-tableheading">Admin Details</h3>

                <h4><i class="fa-solid fa-user fa-beat-fade"></i> Name : <?= $fetch_profile['admin_Name']; ?></h4>
                <h4><i class="fa-solid fa-id-card fa-beat-fade"></i> Admin ID : <?= $fetch_profile['admin_ID']; ?></h4>
                <h4><i class="fa-solid fa-envelope fa-beat-fade"></i> Email : <?= $fetch_profile['admin_email']; ?></h4>
                <h4><i class="fa-solid fa-phone fa-beat-fade"></i> Phone No: <?= $fetch_profile['admin_phoneNo']; ?></h4>

                <a href="update_admin.php">Update Admin Info</a>
        </div>
        <?php
             }else
        ?>


    </div>
    </section>
    <script src="../JS/admin_script.js"></script>
</body>
</html>
