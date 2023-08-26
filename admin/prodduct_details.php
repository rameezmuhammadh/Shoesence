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

    <title>Product Details</title>

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

    <h3 class="i-orderheading"> Product Details</h3>
    <div class="board  Order">
       

        <div class="order-details">
        <?php
                            if(isset($_GET['get_p_ID'])) {
                            $update_id = $_GET['get_p_ID'];
                            $select_product = $conn->prepare("SELECT * FROM `products` WHERE pID = ?");
                            $select_product->execute([$update_id]);
                            if($select_product->rowCount() > 0){
                                while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){
                    ?>
                <h4>Product ID: <?=$fetch_product['pID'];?></h4>
                <h4>Product Name : <?=$fetch_product['pName'];?></h4>
                <h4>Product Brand : <?=$fetch_product['pBrand'];?></h4>
                <h4>Price : <?=$fetch_product['pPrice'];?></h4>
                <h4>Size:<?=$fetch_product['pSize'];?></h4>
                <h4>Target Group:<?=$fetch_product['pTargetGroup'];?></h4>
                <h4>Category:<?=$fetch_product['pCategory'];?></h4>
                <h4>Description:</h4><p><?=$fetch_product['pDescription'];?></p>

                <div class="product-img">

                    <img src="../uploaded-img/<?= $fetch_product['pImage1'];?>" alt="">
                    <img src="../uploaded-img/<?= $fetch_product['pImage2'];?>" alt="">
                    <img src="../uploaded-img/<?= $fetch_product['pImage3'];?>" alt="">
                    <img src="../uploaded-img/<?= $fetch_product['pImage4'];?>" alt="">
                    <img src="../uploaded-img/<?= $fetch_product['pImage5'];?>" alt="">

                </div>

                <a href="reviews.php?get_p_ID=<?=$fetch_product['pID']?>" class="btn">Reviews</a>
                <?php 
            } 
            }else{
                echo '<h5 class="empty_message" >you have no products</h5>';
            }
        }
            ?>
        </div>    
    </div>    

</section>
<script src="../JS/admin_script.js"></script>
</body>
</html>
