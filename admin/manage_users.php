<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:admin_login.php');
}

if (isset($_GET['delete_user'])){

    $delete_id = $_GET['delete_user'];

    $delete_user = $conn->prepare("DELETE FROM `users` WHERE UID = ?");
    $delete_user->execute([$delete_id]);
    header('location:manage_users.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>

        <!---- Browser Tab Icon ----->
        <link rel="icon" type="image/x-icon" href="../images/brower-tab-icon.png">

    <!---Custom CSS -->
    <link rel="stylesheet" href="../admin/CSS/admin_style.css">
    <link rel="stylesheet" href="../admin/CSS/manageproducts.css">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">

    <script src="https://kit.fontawesome.com/b1114c89ce.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>
<body>
<?php include 'menu.php';?>

<section id="interface">
    <?php include 'navsection.php';?>

    <h3 class="i-name">Manage users</h3>
        <div class="board users-table">

            <table width="100%">
                <thead>
                    <tr>
                        <td>User Name</td>
                        <td>User ID </td>
                        <td>Email</td>
                        <td>Phone No</td>
                        <td>Action</td>
                    </tr>
                </thead>

                <tbody>
                <?php
                $select_users = $conn->prepare("SELECT * FROM `users`");
                $select_users->execute();
                if($select_users->rowCount() > 0){
                while($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)){
                ?>
                    <tr>
                        <td >
                            <h5><?= $fetch_users['userName']; ?></h5>
                        </td>
                        <td>
                        <h5><?= $fetch_users['uID']; ?></h5>
                        </td>
                        <td >
                        <h5><?= $fetch_users['userEmail']; ?></h5>
                        </td>
                        <td >
                        <h5><?= $fetch_users['userPhoneNo']; ?></h5>
                        </td>
                        <td class="action-btn-del">
                            <a href="manage_users.php?delete_user=<?= $fetch_users['uID']; ?>" onclick="return confirm('delete user?');">

                            <i class="ri-delete-bin-line"></i></a>
                        </td>
                    </tr>

                </tbody>
                <?php
                }
                }else{
                    echo '<h5 class="empty_message">No Users</h5>';
                }
                ?>
            </table>
        </div>
    </section>

    <script src="../JS/admin_script.js"></script>
</body>
</html>