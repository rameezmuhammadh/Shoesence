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
    <title>Admin Dashboard</title>


          <!---- Browser Tab Icon ----->
          <link rel="icon" type="image/x-icon" href="../images/brower-tab-icon.png">

    <!---Custom CSS -->
    <link rel="stylesheet" href="../admin/CSS/admin_style.css">
    <link rel="stylesheet" href="../admin/CSS/manageproducts.css">
    <link rel="stylesheet" href="../admin/CSS/orders.css">


    <!---Custom Icon Library Font awesome -->
    <script src="https://kit.fontawesome.com/b1114c89ce.js" crossorigin="anonymous"></script>

    <!---Custom Icon Library Remix Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">


    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>
<body>
    <?php include 'menu.php'?>
    <section id="interface">

        <?php include 'navsection.php'?>

        <h3 class="i-name">Dashboard</h3>


        <div class="values">
            <div class="val-box">
            <?php
                $select_users = $conn->prepare("SELECT * FROM `users`");
                $select_users->execute();
                $numbers_of_users = $select_users->rowCount();
            ?>
            <i class="fa-solid fa-users"></i>
                <div>
                    <h3><?= $numbers_of_users; ?></h3>
                    <span>Total Users</span>
                </div>
            </div>
            <div class="val-box">
            <?php
                $select_orders = $conn->prepare("SELECT * FROM `orders`");
                $select_orders->execute();
                $numbers_of_orders = $select_orders->rowCount();
            ?>
                <i class="ri-shopping-cart-2-line"></i>
                <div>
                    <h3><?= $numbers_of_orders; ?></h3>
                    <span>Total Orders</span>
                </div>
            </div> 
            
            <div class="val-box">
            <?php
                $total_completes = 0;
                $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
                $select_completes->execute(['complete']);
                while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
                    $total_completes += $fetch_completes['total_price'];
                }
            ?>
                <i class="ri-funds-line"></i>
                <div>
                    <h3>Rs. <?= $total_completes; ?></h3>
                    <span>Total Earnings</span>
                </div>
        </div>
        
        </div>

        <h3 class="i-tableheading">Recent Orders</h3>
        <div class="board manage-orders">

<table width="100%">
    <thead>
        <tr>
            <td>Order Id</td>
            <td>Products</td>
            <td>User </td>
            <td>Price</td>
            <td>Payment status</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        <?php
       $select_orders = $conn->prepare("SELECT * FROM `orders` ORDER BY `orders_ID` DESC LIMIT 5");
       $select_orders->execute();
   
       if ($select_orders->rowCount() > 0) {
           while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {

        ?>
        <tr>
            <td>#<?= $fetch_orders['orders_ID'];?></td>
            <td class="td-orderedproduces">
            
                <h5>
                    <?= $fetch_orders['total_products'];?>
                </h5>
           
            </td>
            <td class="td-User">
            <h5><?= $fetch_orders['user_Name'];?></h5>
            <p>#<?= $fetch_orders['user_id'];?></p>
            </td>
            <td class="td-price">
            <h5>Rs <?= $fetch_orders['total_price'];?></h5>
            </td>
            <td class="td-payment-status">
            <h5>
                <?= $fetch_orders['payment_status'];?>
            </h5>
            </td>
            <td>
            <a href="update_order.php?get_order_ID=<?=$fetch_orders['orders_ID'];?>" class="td-update">Update</a>
            <a href="order_details.php?get_order_ID=<?=$fetch_orders['orders_ID'];?>" class="td-Details">Details</a>
            </td>
        </tr>
                    <?php
                }
            }else{
                echo '<p class="empty_message">no accounts available</p>';
            }
        ?>
    </tbody>
</table>
</div>
    </section>

    <script src="../JS/admin_script.js">
        $('#menu-btn').click(function(){
            $('#menu').toggleClass("active");
            })
    </script>
</body>
</html>