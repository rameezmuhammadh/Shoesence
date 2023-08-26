<?php

if(isset($_POST['add_to_cart'])) {
    if($user_id == '') {
        header('location:login.php');
    } else {
        $pid = $_POST['pID'];
        $pid = filter_var($pid, FILTER_SANITIZE_STRING);
        $pro_name = $_POST['pName'];
        $pro_name = filter_var($pro_name, FILTER_SANITIZE_STRING);
        $price = $_POST['pPrice'];
        $price = filter_var($price, FILTER_SANITIZE_STRING);
        $image = $_POST['p_image'];
        $image = filter_var($image, FILTER_SANITIZE_STRING);
        $qty = $_POST['qty'];
        $qty = filter_var($qty, FILTER_SANITIZE_STRING);

        $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE product_name = ? AND user_id = ?");
        $check_cart_numbers->execute([$pro_name, $user_id]);

        if ($check_cart_numbers->rowCount() > 0) {
            $message[] = 'already added to cart!';
        } else {
            $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, product_id, product_name, product_price, product_qty, prouduct_image) VALUES(?,?,?,?,?,?)");
            $insert_cart->execute([$user_id, $pid, $pro_name, $price, $qty, $image]);
            $message_success[] = 'added to cart!';

        }

    }
}


