<?php
include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
   header('location:index.php');
};

if(isset($_POST['delete'])){
    $cart_id =$_POST['cart_id'];
    $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE cart_ID = ?");
    $delete_cart_item->execute([$cart_id]);
    $message[] = 'cart item deleted!';
}
if(isset($_POST['update_qty'])){
    $cart_id = $_POST['cart_id'];
    $qty = $_POST['qty'];
    $qty = filter_var($qty, FILTER_SANITIZE_STRING);
    $update_qty = $conn->prepare("UPDATE `cart` SET product_qty = ? WHERE cart_ID = ?");
    $update_qty->execute([$qty, $cart_id]);
    $message_success[] = 'cart quantity updated';
}


$grand_total =0;
$super_sub =0;
$shippingfee =0;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!---- Browser Tab Icon ----->
    <link rel="icon" type="image/x-icon" href="images/brower-tab-icon.png">


    <!---------Custom Css----------->
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/navbar.css">
    <link rel="stylesheet" href="CSS/footer.css">
    <link rel="stylesheet" href="CSS/btn.css">
    <link rel="stylesheet" href="CSS/cart.css">

    
    <!---------Remix icons--------->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">

    <!------- Google font -------->

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Prata&display=swap" rel="stylesheet">

    <title>Shoesence Cart </title>
</head>
<body>

<!------------------- Nav Bar starts ------------------>
<?php include 'components/user_header.php'; ?>
<!------------------- Nav Bar ends------------------>

        <div class="cart-container">

            <table>
                <tr>
                    <th>Product</th>
                    <th>Remove</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
                <tr>
                    <?php
                    $grand_total = 0;
                    $super_sub =0;
                    $shippingfee =0;
                    $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                    $select_cart->execute([$user_id]);
                    if($select_cart->rowCount() > 0){
                    while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <form action="" method="post">
                        <input type="hidden" name="cart_id" value="<?= $fetch_cart['cart_ID']; ?>">
                    <td>
                        <div class="cart-info">
                            <img src="uploaded-img/<?= $fetch_cart['prouduct_image'];?>" >
                            <div>
                                <p><?= $fetch_cart['product_name']; ?></p>
                                <small>Rs. <?= $fetch_cart['product_price']; ?>.00</small><br>
                            </div>
                        </div>
                    </td>
                    <td>
                        <button type="submit"  name="delete" onclick="return confirm('Remove this Product form cart?');" ><i class="ri-delete-bin-line"></i></button>
                    </td>
                    <td>
                        <input name="qty" type="number" min="1" max="20" maxlength="2" value="<?=$fetch_cart['product_qty'];?>">
                        <button type="submit" name="update_qty"><i class="ri-edit-box-line"></i></button>
                    </td>
                    <td>Rs. <?=$sub_total = ($fetch_cart['product_price']* $fetch_cart['product_qty']);?>.00</td>
                </tr>
                </form>
            <?php
                $super_sub +=$sub_total;
                $shippingfee=($super_sub *0.1);
            }
            $grand_Total=($super_sub + $shippingfee);

            }else{
                echo '<h5 class="empty_message">Your Cart is empty</h5>';
            }
            ?>
            </table>
                <div class="total-price">
                    <table>
                        <tr>
                            <td>Sub Total</td>

                            <td>Rs. <?=$super_sub; ?>.00</td>

                        </tr>
                        <tr>
                            <td>Shipping Fee</td>
                            <td>Rs. <?= $shippingfee ;?>.00</td>
                        </tr> <tr>
                            <td>Total</td>
                            <td>Rs. <?= $grand_Total?>.00</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <a href="checkout.php" class="btn checkout-btn" <?= ($grand_total > 1)?'':'disabled'; ?>>Proceed to checkout </a></td>
                        </tr>
                       
                    </table>
                   
                </div>
        </div>



    <!------------------- footer------------------>
    <?php include 'components/user_footer.php' ;?>
     <!------------------- Custom Js File------------------>
     <script src="JS/script.js"></script>
</body>
</html>