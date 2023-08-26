<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
};

include 'components/add_cart.php';

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
    <link rel="stylesheet" href="CSS/search.css">
    <link rel="stylesheet" href="CSS/prodcuts.css">


    
    <!---------Remix icons--------->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">

    <!------- Google font -------->

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Prata&display=swap" rel="stylesheet">

    <title>ShoeSence - Search</title>
</head>
<body>

    <!------------------- Nav Bar starts ------------------>   
     <?php include 'components/user_header.php'; ?>
     <!------------------- Nav Bar ends------------------>

    <div class="search-form">
        <form action="" method="post">
            <input type="text" name="search_box" placeholder="Search here ..." class="search-input">
            <button type="submit" class="btn" name="search-btn">
                    <i class="ri-search-line"></i>
            </button>
        </form>
    </div>


     <div class="grid">

        
        <?php
                    if(isset($_POST['search_box']) OR isset($_POST['search-btn'])){
                    $search_box = $_POST['search_box'];
                    $select_products = $conn->prepare("SELECT * FROM `products` WHERE pName LIKE '%{$search_box}%' OR pCategory LIKE '%{$search_box}%' OR pBrand LIKE '%{$search_box}%' OR pDescription LIKE '%{$search_box}%'");
                    $select_products->execute();
                    if($select_products->rowCount() > 0){
                    while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
                ?>

        <form action="" method="post">
        <div class="single_products">

            <input type="hidden" name="pID" value="<?=$fetch_products['pID']; ?>">
            <input type="hidden" name="pName" value="<?=$fetch_products['pName']; ?>">
            <input type="hidden" name="pPrice" value="<?=$fetch_products['pPrice']; ?>">
            <input type="hidden" name="qty" value="1" min="1" max="20" maxlength="2">
            <input type="hidden" name="p_image" value="<?=$fetch_products['pImage1']; ?>">

            <img class="product-img" src="uploaded-img/<?=$fetch_products['pImage1']; ?>" alt="" class="product-img">
            <h5><?=$fetch_products['pBrand']; ?></h5>
            <h4><?=$fetch_products['pName']; ?></h4>
            <h4>Rs. <?=$fetch_products['pPrice']; ?></h4>
            <h4 class="size">Size: <?=$fetch_products['pSize']; ?></h4>
            <a class="btn quickview" href="SingleProducts.php?pID=<?= $fetch_products['pID']; ?>"><i class="ri-eye-line"></i></a>
            <button type="submit" name="add_to_cart" class="btn addtocardicon"><i class="ri-shopping-bag-line"></i></button>

        </div>
        </form>
 

        
        <?php
        }
        }else{
            echo '<h6 class="empty_message"> No Product Found</h6>';
        }
    }
        ?>
</div>
       

    <!------------------- footer------------------>
    <?php include 'components/user_footer.php' ;?>


     <!------------------- Custom Js File------------------>
      <script src="JS/script.js"></script>
</body>
</html>