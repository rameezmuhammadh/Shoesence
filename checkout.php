<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
    header('location:login.php');
};

include 'components/add_cart.php';

if(isset($_POST['place_order'])) {

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $address = $_POST['address'];
    $address = filter_var($address, FILTER_SANITIZE_STRING);
    $total_products = $_POST['total_products'];
    $total_price = $_POST['total_price'];
    $placed_on = $_POST['placed_on'];
    $placed_on = filter_var($placed_on, FILTER_SANITIZE_STRING);

    $currentDate = date('Y-m-d'); // Get the current date in the format 'YYYY-MM-DD'
    $EstimatedshippingDate = date('Y-m-d', strtotime($currentDate . ' +10 days'));

    $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $check_cart->execute([$user_id]);


    if($check_cart->rowCount() > 0){

        $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, user_Name, phone_No, user_email, address, total_products, total_price, placed_on, estimated_delivery) VALUES(?,?,?,?,?,?,?,?,?)");
        $insert_order->execute([$user_id, $name, $number, $email, $address, $total_products, $total_price, $placed_on,$EstimatedshippingDate]);

            $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
            $delete_cart->execute([$user_id]);

            $message_success[] = 'Order placed successfully!';
            header('location:profile.php');


    }else{
        $message[] = 'your cart is empty';
    }

}
            $grand_total = 0;
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
    <link rel="stylesheet" href="CSS/checkout.css">


    
    <!---------Remix icons--------->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">

    <script src="https://kit.fontawesome.com/b1114c89ce.js" crossorigin="anonymous"></script>

    <!------- Google font -------->

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Prata&display=swap" rel="stylesheet">

    <title>ShoeSence checkout</title>
</head>
<body>
        <!------------------- Nav Bar starts ------------------>   
        <?php include 'components/user_header.php'; ?>
     <!------------------- Nav Bar ends------------------>
    
<div class="checkout_container">
    <div class="billing-info">
            <h3>Billing Detail</h3>
        <form action="" method="post">

        <?php
        //User Information Fetching
        $select_profile = $conn->prepare("SELECT * FROM `users` WHERE uID = ?");
        $select_profile->execute([$user_id]);
        if($select_profile->rowCount() > 0){
        $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
        ?>
            <table>
                    <tr>
                    <td><i class="fa-solid fa-user fa-beat-fade"></i>  <?= $fetch_profile['userName'] ?></td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-envelope fa-beat-fade"></i>  <?= $fetch_profile['userEmail'] ?></td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-phone fa-beat-fade"></i>   <?= $fetch_profile['userPhoneNo'] ?></td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-location-dot fa-beat-fade"></i>  <?= $fetch_profile['userAddress'] ?></td>
                    </tr>
                    <tr>
                        <td><a href="profile.php" class="btn update-address-btn">Update Address</a></td>
                    </tr>
                <?php
                }
                ?>
            </table>
            
        <div class="payment-option">
            <h3>Enter your payment details</h3>



                <input type="hidden" name="name" value="<?= $fetch_profile['userName'] ?>">
                <input type="hidden" name="number" value="<?= $fetch_profile['userPhoneNo'] ?>">
                <input type="hidden" name="email" value="<?= $fetch_profile['userEmail'] ?>">
                <input type="hidden" name="address" value="<?= $fetch_profile['userAddress'] ?>">

                <input type="text" name="" id="" placeholder="Name on card" required><br>
                <input type="No" name="" id="" placeholder="Card Number" maxlength="16" minlength="12" required><br>

                <label for="">Expired Date</label>
                <select required>
                    <option value="">Year</option>
                    <option value="">23</option>
                    <option value="">24</option>
                    <option value="">25</option>
                    <option value="">26</option>
                    <option value="">27</option>
                    <option value="">28</option>
                    <option value="">29</option>
                    <option value="">30</option>
                </select>
                <select required>
                    <option value="">Month</option>
                    <option value="">01</option>
                    <option value="">02</option>
                    <option value="">03</option>
                    <option value="">04</option>
                    <option value="">05</option>
                    <option value="">06</option>
                    <option value="">07</option>
                    <option value="">08</option>
                    <option value="">09</option>
                    <option value="">10</option>
                    <option value="">11</option>
                    <option value="">12</option>
                </select>
                <br>
                <input type="number" name="" id="" max="999" placeholder="CCV" maxlength="3" required oninput="enforceLength(this, 3)"><br>

                <button class="btn btn-place-order" name="place_order">Place Order</button>



       </div>
    </div>

    <div class="cart-info">
        <h3>Cart info</h3>


        <table>
                <tr>
                    <th>Products</th>
                
                    <th>Sub Total</th>
                </tr>
            <?php


            $cart_items[] = '';
            $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $select_cart->execute([$user_id]);
            if($select_cart->rowCount() > 0){
            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
                $cart_items[] = $fetch_cart['product_name'].' ('.$fetch_cart['product_price'].' x '. $fetch_cart['product_qty'].'),  ';
                $total_products = implode($cart_items);

            ?>
       
            <input type="hidden" name="pay_method">
                <tr>
                    <td>
                        <div class="product-info">
                            <img src="uploaded-img/<?= $fetch_cart['prouduct_image']; ?>"" >
                            <div>
                                <p><?= $fetch_cart['product_name']; ?></p>
                                <small><p>x <?= $fetch_cart['product_qty']; ?></p></small>
                            </div>
                        </div>
                    </td>
                    <td><?= $sub_total = ($fetch_cart['product_price'] * $fetch_cart['product_qty']); ?></td>
                </tr>
                <?php


                $sub_total = ($fetch_cart['product_price'] * $fetch_cart['product_qty']);

                $todayDate = date('Y-m-d'); 
                $deliveryDate = date('Y-m-d', strtotime($todayDate . ' +10 days'));
                $super_sub += $sub_total;
                $shippingfee = ($super_sub *0.1);

              
            }
            $grand_total += $super_sub+$shippingfee;

            ?>
            
            <input type="hidden" name="total_products" value="<?= $total_products; ?>">
            <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
            <input type="hidden" name="placed_on" value="<?= date('Y-m-d'); ?>">
            <?php
            }else{
                echo '<p class="empty_message">your cart is empty!</p>';
            }
            ?>
                <tr class="totals">
                    <td>Estimated delivery on</td>
                    <td><?= $deliveryDate; ?></td>
                </tr>
                <tr class="totals">
                    <td>
                        Sub Total</td>
                    <td>Rs. <?=$super_sub; ?></td>
                </tr>
                <tr>
                    <td>Shipping Fee</td>
                    <td>Rs. <?= $shippingfee ?></td>
                </tr>
                <tr>
                    <td>Grand Total</td>
                    <td>Rs. <?= $grand_total; ?></td>

                </tr>
        
        </table>

        </form>
    </div>

</div>


    <!------------------- footer------------------>
    <?php include 'components/user_footer.php' ;?>

    
     <!------------------- Custom Js File------------------>
     <script src="JS/script.js">     </script>
            <script>
                    
                    function enforceLength(input, maxLength) {
                                if (input.value.length > maxLength) {
                                input.value = input.value.slice(0, maxLength);
                                    }
                                }  


            </script>

</body>
</html>