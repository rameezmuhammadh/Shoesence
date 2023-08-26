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

        <h3 class="i-name">Manage Orders</h3>

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
                        $select_orders =$conn->prepare("SELECT * FROM `orders` ORDER BY `orders_ID` DESC");
                        $select_orders->execute();
                        if($select_orders->rowCount() > 0){
                            while ($fetch_orders =$select_orders->fetch(PDO::FETCH_ASSOC)){

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
                        <form method="post">
                        <input type="hidden" name="order_id" value="<?= $fetch_orders['orders_ID']; ?>">
                        <a href="update_order.php?get_order_ID=<?=$fetch_orders['orders_ID'];?>" class="td-update">Update</a>
                        <a href="order_details.php?get_order_ID=<?=$fetch_orders['orders_ID']?>" class="td-Details">Details</a>
                        </td>
                            </form>
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

    <script src="../JS/admin_script.js"></script>
</body>
</html>