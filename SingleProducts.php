<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
};

include 'components/add_cart.php';


if(isset($_POST['submit-review'])){

    if($user_id == ''){
        header('location:login.php');
    }else{
    $pid = $_POST['pid'];
    $pid = filter_var($pid, FILTER_SANITIZE_STRING);

    $user_name = $_POST['username'];
    $user_name = filter_var($user_name, FILTER_SANITIZE_STRING);

    $review = $_POST['review'];
    $review = filter_var($review, FILTER_SANITIZE_STRING);
    $rate = $_POST['rate'];
    $rate = filter_var($rate, FILTER_SANITIZE_STRING);
    $placed_on = $_POST['placed_on'];
    $placed_on = filter_var($placed_on, FILTER_SANITIZE_STRING);
 
    $check_user = $conn->prepare("SELECT * FROM `users` WHERE uID = ?");
    $check_user->execute([$user_id]);
 
    $select_reviews = $conn->prepare("SELECT * FROM `reviews` WHERE user_name = ? AND review = ?");
    $select_reviews->execute([$user_name, $review]);
 
    if($select_reviews->rowCount() > 0){
       $message[] = 'already sent review!';
    }else{
    
       $insert_reviews = $conn->prepare("INSERT INTO `reviews` (user_id, p_id, user_name, review, rate, placed_on) VALUES (?,?,?,?,?,?)");
       $insert_reviews->execute([$user_id, $pid, $user_name,  $review, $rate, $placed_on]);
 
       $message_success[] = 'Send review successfully!';
    }
 
 }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single Product Page</title>

      <!---- Browser Tab Icon ----->
      <link rel="icon" type="image/x-icon" href="images/brower-tab-icon.png">
    <!---------Custom Css----------->
    <link rel="stylesheet" href="CSS/singleproduct.css">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/btn.css">
    <link rel="stylesheet" href="CSS/form.css">

  

    <!---------Remix icons--------->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">

    <!------- Google font -------->
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Prata&display=swap" rel="stylesheet">

</head>
<body>
       <!------------------- Nav Bar ------------------>
  <?php include 'components/user_header.php'; ?>
    
    <!----------------- Single product page------------------>

    <div class="small-container single-product">
        <?php
            if(isset($_GET['pID'])){
                $pID = $_GET['pID'];
                $select_products = $conn->prepare("SELECT * FROM `products` WHERE pID = ?");
                $select_products->execute([$pID]);
                if($select_products->rowCount() > 0){
                    while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){

        ?>
        <form action="" method="post">
            <input type="hidden" name="pID" value="<?= $fetch_products['pID'];?>">
            <input type="hidden" name="pName" value="<?= $fetch_products['pName'];?>">
            <input type="hidden" name="pBrand" value="<?= $fetch_products['pBrand'];?>">
            <input type="hidden" name="pPrice" value="<?= $fetch_products['pPrice'];?>">
            <input type="hidden" name="pSize" value="<?= $fetch_products['pSize'];?>">
            <input type="hidden" name="pTargetGroup" value="<?= $fetch_products['pTargetGroup'];?>">
            <input type="hidden" name="pCategory" value="<?= $fetch_products['pCategory'];?>">
            <input type="hidden" name="pDescription" value="<?= $fetch_products['pDescription'];?>">
            <input type="hidden" name="pImage1" value="<?= $fetch_products['pImage1'];?>">
            <input type="hidden" name="pImage2" value="<?= $fetch_products['pImage2'];?>">
            <input type="hidden" name="pImage3" value="<?= $fetch_products['pImage3'];?>">
            <input type="hidden" name="pImage4" value="<?= $fetch_products['pImage4'];?>">
            <input type="hidden" name="pImage5" value="<?= $fetch_products['pImage5'];?>">


            <input type="hidden" name="p_image" value="<?=$fetch_products['pImage1']; ?>">

        <div class="row">
            <div class="col-2">
                <img src="uploaded-img/<?= $fetch_products['pImage1'] ;?>" alt="" width="100%" id="product-img">
                <div class="small-img-row">
                    <div class="small-img-col">
                        <img src="uploaded-img/<?= $fetch_products['pImage1'] ;?>" alt="" width="100%" class="small-img" onclick="imagePointer(this)">
                   </div>
                    <div class="small-img-col">
                         <img src="uploaded-img/<?= $fetch_products['pImage2'] ;?>" alt="" width="100%" class="small-img" onclick="imagePointer(this)">
                    </div>
                    <div class="small-img-col">
                        <img src="uploaded-img/<?= $fetch_products['pImage3'] ;?>" alt="" width="100%" class="small-img" onclick="imagePointer(this)">
                   </div>
                    <div class="small-img-col">
                         <img src="uploaded-img/<?= $fetch_products['pImage4'] ;?>" alt="" width="100%" class="small-img" onclick="imagePointer(this)">
                    </div>
                     <div class="small-img-col">
                        <img src="uploaded-img/<?= $fetch_products['pImage5'] ;?>" alt="" width="100%" class="small-img" onclick="imagePointer(this)">
                    </div>

                </div>
            </div>
            <div class="col-2">

                <h1><?= $fetch_products['pName'] ;?></h1>
                <h5  class="Catogory"><?= $fetch_products['pCategory'] ;?></h5>
                <h4><?= $fetch_products['pPrice'] ;?></h4>
                <h4>Size :<?= $fetch_products['pSize'] ;?> </h4>
                <h4><?= $fetch_products['pTargetGroup'] ;?> </h4>

                <input type="number" value="1"  min="1" max="20" maxlength="2" name="qty" >
                <input type="hidden" name="p_image" value="<?=$fetch_products['pImage1']; ?>">

                <button type="submit"  name="add_to_cart"  class="btn">Add to Card  <i class="ri-shopping-bag-line"></i></button>
                
                <h3 > product details</h3>
                <p>
                    <?= $fetch_products['pDescription'] ;?>
                </p> 
            </div>
        </div>
        </form>
        <?php
                }
                }else{
                    echo '<h5 class="empty_message" >Product Not Added</h5>';
                }
            }else{
                    echo '<h5 class="empty_message">Product Not Specified </h5>';

            }
        ?>
    </div>


    <div class="tabs">
            <div class="tab-button">
            <button class="tablink active" onclick="openTab(event, 'description')">Description</button>
            <button class="tablink" onclick="openTab(event, 'reviews')">Reviews</button>
            <button class="tablink" onclick="openTab(event, 'size-chart')">Size Chart</button>
            </div>
            <div id="description" class="tabcontent">

            <?php
            if(isset($_GET['pID'])){
                $pID = $_GET['pID'];
                $select_products = $conn->prepare("SELECT * FROM `products` WHERE pID = ?");
                $select_products->execute([$pID]);
                if($select_products->rowCount() > 0){
                    while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){

        ?>
                <h3>Description</h3>
                <h3><?= $fetch_products['pName'] ;?></h3>
                <h5> <?= $fetch_products['pTargetGroup'] ;?> &nbsp &nbsp &nbsp &nbsp
                <?= $fetch_products['pCategory'] ;?></h5>
                

                <p> <?= $fetch_products['pDescription'] ;?></p>
            </div>

            <?php
                    }
                }
            }
            ?>
            <div id="reviews" class="tabcontent">
                <h3>Reviews</h3>
            <?php
                            if(isset($_GET['pID'])) {
                            $update_review_show_id = $_GET['pID'];
                            $select_reviews = $conn->prepare("SELECT * FROM `reviews` WHERE p_id = ?");
                            $select_reviews->execute([$update_review_show_id]);
                            if($select_reviews->rowCount() > 0){
                            while($fetch_reviews = $select_reviews->fetch(PDO::FETCH_ASSOC)){
                        ?>

                <div class="single-review">
                <h5><?= $fetch_reviews['user_name']; ?></h5>
          

                    <?php 
                                $rate = $fetch_reviews['rate'];
                                    if ($rate ==1  ){
                                        echo '
                                        <h5>
                                        <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                        <i class="fa-solid fa-star" style="color: #ececec;"></i>
                                        <i class="fa-solid fa-star" style="color: #ececec;"></i>
                                        <i class="fa-solid fa-star" style="color: #ececec;"></i>
                                        <i class="fa-solid fa-star" style="color: #ececec;"></i>
                                        </h5> ';
                                    }
                                    elseif ($rate ==2) { 
                                        echo '
                                        <h5>
                                        <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                        <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                        <i class="fa-solid fa-star" style="color: #ececec;"></i>
                                        <i class="fa-solid fa-star" style="color: #ececec;"></i>
                                        <i class="fa-solid fa-star" style="color: #ececec;"></i>
                                        </h5> ';
                                    }
                                    elseif ($rate ==3) {
                                        echo '
                                        <h5>
                                        <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                        <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                        <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                        <i class="fa-solid fa-star" style="color: #ececec;"></i>
                                        <i class="fa-solid fa-star" style="color: #ececec;"></i>
                                        </h5> ';
                                     }
                                    elseif ($rate ==4) { 
                                        echo '
                                        <h5>
                                        <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                        <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                        <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                        <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                        <i class="fa-solid fa-star" style="color: #ececec;"></i>
                                        </h5> ';
                                    }
                                    else{ 
                                        echo '
                                        <h5>
                                        <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                        <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                        <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                        <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                        <i class="fa-solid fa-star" style="color: #ffbf00;"></i>
                                        </h5> ';
                                    }
                                    ?>
                
                                    <p><?= $fetch_reviews['review']; ?></p>
                        </div>
                        <?php
                                }
                                }else{
                                echo '<h5 class="empty_message">No reviews Yet</h5>';
                                }
                            }

                            ?>

                <div class="review-from">

                    <form action="" method="post" enctype="multipart/form-data">
                        <h5>Place a Review</h5>


                        <?php
                        $select_profile = $conn->prepare("SELECT * FROM `users` WHERE uID = ?");
                        $select_profile->execute([$user_id]);
                        if($select_profile->rowCount() > 0){
                        $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                        ?>

                        <input type="hidden" name="username" value="<?= $fetch_profile['userName']; ?>">

                     <?php
                            }
                    ?>
                        <input type="number" name="rate" max="5" placeholder="Rating">
                        <input type="text" placeholder="Your Review" class="your-review" name="review">

                            <?php

                                if(isset($_GET['pID'])) {
                                $update_review_id = $_GET['pID'];
                                $select_products = $conn->prepare("SELECT * FROM `products` WHERE pID = ?");
                                $select_products->execute([$update_review_id]);
                                if($select_products->rowCount() > 0){
                                    while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
          
                            ?>
                        <input type="hidden" name="pid"   value="<?= $fetch_products['pID']; ?>">

                        <?php
                                    }
                                }
                             }
                        ?>
                     <input type="hidden" name="placed_on" value="<?= date('Y-m-d'); ?>">


                
                        <button type="submit" class="btn" name="submit-review">Review</button>

                    </form>
                </div>
            </div>

            <div id="size-chart" class="tabcontent">
    
                <h3>HOW TO MEASURE</h3>
                <p>
                    Follow these easy steps to get the right size. For the best fit, measure your feet at the end of the day.</p>
                <div class="size_chart">
                    <div class="size_content">
                        <h4>
                        1.Step on а piece of paper with your heel slightly touching a wall behind. </h4>
                        <h4>
                        2.Мark the end of your longest toe on the paper (you might need a friend to help you) and measure from the wall to the marking. </h4>
                        <h4>
                        3.Do the same for the other foot and compare measurements with our size chart to get the right size.
                        </h4>

                    </div>
                    <div class="size_content">
                        <img src="images/how-to-measure-shoes.png" alt="">
                    </div>
                </div>

                <table>
              <thead>
                  <tr>
                  <th>Size</th>
                  <td>4</td>
                  <td>5</td>
                  <td>6</td>
                  <td>7</td>
                  <td>8</td>
                  <td>9</td>
                  <td>10</td>
                  <td>11</td>
                  <td>12</td>
                  <td>13</td>
                  <td>14</td>
                  <td>15</td>
                  <td>16</td>
                  <td>17</td>
                  <td>18</td>
                  <td>19</td>
                  <td>20</td>


                  </tr>
              </thead>
              <tbody>
                <tr>
                  <th>Heel Toe (CM)</th>

                    <td>22.1</td>
                    <td>22.9</td>
                    <td>23.8</td>
                    <td>24.6</td>
                    <td>25.5</td>
                    <td>26.3</td>
                    <td>27.1</td>
                    <td>28.0</td>
                    <td>28.8</td>
                    <td>29.7</td>
                    <td>30.5</td>
                    <td>31.4</td>
                    <td>32.6</td>
                    <td>33.5</td>
                    <td>34.3</td>
                    <td>35.2</td>
                    <td>35.9</td>
            
            </tbody>
                    
                </table>
            </div>
            </div>
        </div>





      <!------------------- footer------------------>
      <?php include 'components/user_footer.php'; ?>
    <!------------------- Custom Js File------------------>
    <script src="JS/script.js"></script>


    <script>
                function openTab(evt, tabName) {
            var i, tabcontent, tablinks;

            // Hide all tab content
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Remove "active" class from all tab links
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the selected tab content and mark the button as active
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
            }

            // Set the first tab as active by default
            document.getElementsByClassName("tablink")[0].click();

    </script>
</body>
</html>