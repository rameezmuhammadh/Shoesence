<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update_payment'])){

    $order_id_payment = $_POST['order_id-payment'];
    $payment_status = $_POST['payment_status'];
    $update_payment_status = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE orders_ID = ?");
    $update_payment_status->execute([$payment_status, $order_id_payment]);
    $message_success[] = 'payment status updated!';

}
if(isset($_POST['update-delivery'])){

    $order_id_delivey = $_POST['order_id-delivery'];
    $delivey_status = $_POST['delivery_status'];
    $update_delivey_status = $conn->prepare("UPDATE `orders` SET deleivery_status = ? WHERE orders_ID = ?");
    $update_delivey_status->execute([$delivey_status, $order_id_delivey]);
    $message_success[] = 'delivery status updated!';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Update Order</title>

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


    <h3 class="i-orderheading">Update Order </h3>
    
    <div class="board  Order">

        <div class="update-order-details">

            <?php
                $update_orders_id = $_GET['get_order_ID'];
                $show_orders = $conn->prepare("SELECT * FROM `orders` WHERE orders_ID = ?");
                $show_orders->execute([$update_orders_id]);
                if($show_orders->rowCount() > 0){
                while($fetch_orders = $show_orders->fetch(PDO::FETCH_ASSOC)){
            ?>
                <h4>Order ID:<?=$fetch_orders['orders_ID'];?></h4>
                <h4>User ID :<?=$fetch_orders['user_id'];?></h4>
                <h4>Placed On :<?=$fetch_orders['placed_on'];?></h4>
                <h4>Products:<?=$fetch_orders['total_products'];?> </h4>
                <h4>Payment Status:<?=$fetch_orders['payment_status'];?></h4>
                <h4>Delivery Status:<?=$fetch_orders['deleivery_status'];?></h4>

                <form action="" method="post">

                    <input type="hidden" name="order_id-payment" value="<?= $fetch_orders['orders_ID']; ?>">
                    <label for="">Update Payment Status</label>
                    <select name="payment_status" id="">
                        <option value="">----</option>
                        <option value="Pending">Pending</option>
                        <option value="Complete">Complete</option>
                    </select>
                    <button type="submit" class="btn" name="update_payment">Update Payment</button>
                </form>

                <form action="" method="post">
                    <input type="hidden" name="order_id-delivery" value="<?= $fetch_orders['orders_ID']; ?>">
                    <label for="">Update Delivery Status</label>
                    <select name="delivery_status" id="">
                        <option value="">----</option>
                        <option value="Dropped off">Dropped off</option>
                        <option value="Shipped">Shipped</option>
                        <option value="Delivered">Delivered</option>
     
                    </select>
                    <button type="submit" class="btn" name="update-delivery">Update Delivery</button>
                </form>
                <?php
            }
            }else{
                echo '<h5 class="empty_message">No Orders</h5>';
            }
            ?>
        </div>    
    </div>    

</section>
<script src="../JS/admin_script.js"></script>
</body>
</html>
