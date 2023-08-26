<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:admin_login.php');
}


if (isset($_GET['delete_product'])){

    $delete_id = $_GET['delete_product'];
    $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE pID = ?");
    $delete_product_image->execute([$delete_id]);
    $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
    unlink('../uploaded-img/'.$fetch_delete_image['pImage1']);
    unlink('../uploaded-img/'.$fetch_delete_image['pImage2']);
    unlink('../uploaded-img/'.$fetch_delete_image['pImage3']);
    unlink('../uploaded-img/'.$fetch_delete_image['pImage4']);
    unlink('../uploaded-img/'.$fetch_delete_image['pImage5']);

    $delete_product = $conn->prepare("DELETE FROM `products` WHERE pID = ?");
    $delete_product->execute([$delete_id]);
    $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE product_id = ?");
    $delete_cart->execute([$delete_id]);
    header('location:manage_products.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>

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

    <div class="manage-product-btn">
            <a class="addproduct add" href="add_products.php">Add Products</a>
        
    </div>
    <h3 class="i-tableheading">Products </h3>
    <div class="board products-table">
        <table width="100%">
            <thead>
                <tr>
                    <td>Product</td>
                    <td>Category</td>
                    <td>Brand</td>
                    <td>Price</td>
                    <td>Size</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
            <?php
            $show_products = $conn->prepare("SELECT * FROM `products`");
            $show_products ->execute();
            if($show_products->rowCount() > 0){
                while ($fetch_product = $show_products->fetch(PDO::FETCH_ASSOC)){
            ?>
            
                <tr>
                    <td class="tb-product">
                    <img src="../uploaded-img/<?= $fetch_product['pImage1'];?>" alt="">
                    <div class="people-de">
                        <h5><?= $fetch_product['pName'];?></h5>
                        <p>#<?= $fetch_product['pID'];?></p>
                    </div>
                    </td>
                    <td class="">
                    <h5><?= $fetch_product['pCategory'];?></h5>
                    <p><?= $fetch_product['pTargetGroup'];?></p>
                    </td>
                    <td class="">
                    <h5><?= $fetch_product['pBrand'];?></h5>
                    </td>
                    <td class="">
                    <h5><?= $fetch_product['pPrice'];?></h5>
                    </td>
                    <td>
                        <h5><?= $fetch_product['pSize'];?></h5>
                    </td>
                    <td class="td-action">
                    <a href="manage_products.php?delete_product=<?= $fetch_product['pID']; ?>" class=" btn-del" onclick="return confirm('delete this product?');">
                    <i class="ri-delete-bin-line"></i>
                    <a>
                    <a href="edit_product.php?update=<?= $fetch_product['pID']; ?>" class="btn-edit">Edit</a>
                    <a href="prodduct_details.php?get_p_ID=<?=$fetch_product['pID']?>" class="td-Details">Details</a>

                    </td>
                </tr>
            <?php
                }
            }else{
                echo '<h5 class="empty_message">No Products Added Yet</h5>';
            }
            ?>
            </tbody>
        </table>
    </div>
</section>

    <script src="../JS/admin_script.js"></script>
</body>
</html>