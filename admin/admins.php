<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if (isset($_GET['delete_admin'])){

    $delete_id = $_GET['delete_admin'];
    $delete_admin_dp = $conn->prepare("SELECT * FROM `admin` WHERE admin_ID = ?");
    $delete_admin_dp->execute([$delete_id]);
    $delete_admin_dp = $delete_admin_dp->fetch(PDO::FETCH_ASSOC);
    unlink('../uploaded-img/'.$delete_admin_dp['admin_dp']);


    $delete_admin = $conn->prepare("DELETE FROM `admin` WHERE admin_ID = ?");
    $delete_admin->execute([$delete_id]);
    header('location:admins.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

           <!---- Browser Tab Icon ----->
           <link rel="icon" type="image/x-icon" href="../images/brower-tab-icon.png">

    <!---Custom CSS -->
    <link rel="stylesheet" href="../admin/CSS/admin_style.css">
    <link rel="stylesheet" href="../admin/CSS/manageproducts.css">


    <!---Custom Icon Library Font awesome -->
    <script src="https://kit.fontawesome.com/b1114c89ce.js" crossorigin="anonymous"></script>

    <!---Custom Icon Library Remix Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>
<body>
<?php include 'menu.php';?>


<section id="interface">
    <?php include 'navsection.php';?>

    <div class="manage-product-btn admin-btn">
            <a class="add" href="admin_register.php">New Admin</a>
            <a href="update_admin.php" class="add">Update Admin Info</a>
         </div>

    <h3 class="i-tableheading admin-heading">Admins</h3>

        <div class="board  admin-table">
            <table width="100%">
                <thead>
                    <tr>
                        <td>Admin Name</td>
                        <td>Email </td>
                        <td>Phone No</td>
                        <td></td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                <?php
                $select_admins = $conn->prepare("SELECT * FROM `admin`");
                $select_admins->execute();
                if($select_admins->rowCount() > 0){
                while($fetch_admins = $select_admins->fetch(PDO::FETCH_ASSOC)){
                ?>
                    <tr>
                        <td class="tb-product">
                        <div class="people-de">
                            <h5><?= $fetch_admins['admin_Name']; ?></h5>
                            <p>#<?= $fetch_admins['admin_ID']; ?></p>
                        </div>
                        </td>
                        <td class="">
                        <h5><?= $fetch_admins['admin_email']; ?></h5>
                        </td>
                        <td class="">
                            <h5><?= $fetch_admins['admin_phoneNo']; ?></h5>
                            </td>
                        <td class="">
                            <a href="admins.php?delete_admin=<?= $fetch_admins['admin_ID']; ?>" class=" btn-del" onclick="return confirm('delete admin?');" ><i class="ri-delete-bin-line"></i></a>
                        </td>
                    </tr>
                    <?php
                }
                }
                ?>
                </tbody>
            </table>
        </div>
       
    </section>
    <script src="../JS/admin_script.js"></script>
</body>
</html>
