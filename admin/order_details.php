<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:admin_login.php');
}

if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];
    $delete_order = $conn->prepare("DELETE FROM `orders` WHERE orders_ID = ?");
    $delete_order->execute([$delete_id]);
    header('location:manage_oders.php');

 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Order Details</title>

           <!---- Browser Tab Icon ----->
           <link rel="icon" type="image/x-icon" href="../images/brower-tab-icon.png">

    <!---Custom CSS -->
    <link rel="stylesheet" href="../admin/CSS/admin_style.css">
    <link rel="stylesheet" href="../admin/CSS/manageproducts.css">
    <link rel="stylesheet" href="../admin/CSS/orders.css">

    

    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">


    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>
<body>
<?php include 'menu.php';?>


<section id="interface">
    <?php include 'navsection.php';?>

    <h3 class="i-orderheading"> Order Details</h3>
    <div class="board  Order">
       

        <div class="order-details">
        <?php
                            if(isset($_GET['get_order_ID'])) {
                            $update_id = $_GET['get_order_ID'];
                            $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE orders_ID = ?");
                            $select_orders->execute([$update_id]);
                            if($select_orders->rowCount() > 0){
                                while($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)){
                    ?>
                <h4>Order ID: <?=$fetch_order['orders_ID'];?></h4>
                <h4>User Name : <?=$fetch_order['user_Name'];?></h4>
                <h4>User ID : <?=$fetch_order['user_id'];?></h4>
                <h4>Email : <?=$fetch_order['user_email'];?></h4>
                <h4>Telephone Number :<?=$fetch_order['phone_No'];?></h4>
                <h4>Address:<?=$fetch_order['address'];?></h4>
                <h4>Products:<?=$fetch_order['total_products'];?></h4>
                <h4>Total Price:<?=$fetch_order['total_price'];?></h4>
                <h4>Place Date:<?=$fetch_order['placed_on'];?></h4>
                <h4>Estimated Delivery Date:<?=$fetch_order['estimated_delivery'];?></h4>
                <h4>Payment Status:<?=$fetch_order['payment_status'];?></h4>
                <h4>Delivery Status:<?=$fetch_order['deleivery_status'];?></h4>


                <a href="update_order.php?get_order_ID=<?=$fetch_order['orders_ID'];?>" class="btn">Update Payment Status</a>

                <a href="order_details.php?delete=<?=$fetch_order['orders_ID'];?>" onclick="return confirm('Delete this Order?');" class="btn">Delete Order</a>


                <?php 
            } 
            }else{
                echo '<h5 class="empty_message" >you have no orders</h5>';
            }
        }
            ?>
        </div>    
    </div>    

</section>
<script src="../JS/admin_script.js"></script>
</body>
</html>
