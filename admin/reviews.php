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

    <title>Reviews</title>

        <!---- Browser Tab Icon ----->
        <link rel="icon" type="image/x-icon" href="../images/brower-tab-icon.png">

    <!---Custom CSS -->
    <link rel="stylesheet" href="../admin/CSS/admin_style.css">
    <link rel="stylesheet" href="../admin/CSS/manageproducts.css">
    <link rel="stylesheet" href="../admin/CSS/messages.css">
    

    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">


    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>
<body>
<?php include 'menu.php';?>


<section id="interface">
    <?php include 'navsection.php';?>


    <h3 class="i-messageheading">Review</h3>
    
    <div class="board  messages">
    
        <table width="100%">
            <thead>
            <tr>
                <td>Review ID</td>
                <td>User ID </td>
                <td>Date</td>
                <td>Review</td>
                <td>Rating</td>
            </tr>
            </thead>
            <tbody>
            <?php
                                if(isset($_GET['get_p_ID'])) {
                                $update_id = $_GET['get_p_ID'];
                                $select_reviews = $conn->prepare("SELECT * FROM `reviews` WHERE p_id = ?");
                                $select_reviews->execute([$update_id]);
                                if($select_reviews->rowCount() > 0){
                                while($fetch_reviews = $select_reviews->fetch(PDO::FETCH_ASSOC)){
                            ?>
            <tr>
                <td class="">
                    <h5>#<?= $fetch_reviews['review_ID']; ?></h5>
                </td>
                <td class="">
                
                    <p>#<?= $fetch_reviews['user_id']; ?></p>
                </td>
                <td>
                    <h5><?= $fetch_reviews['placed_on']; ?></h5>
                </td>
                <td>
                   <h5><?= $fetch_reviews['review']; ?></h5>
                </td>
                <td>
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
                                        </h5>';
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
                </td>
    
            </tr>

                <?php
            }
            }else{
                echo '<h5 class="empty_message">This product has no reviews yet</h4>';
            }
        }
            ?>
            </tbody>
        </table>
</section>
<script src="../JS/admin_script.js"></script>
</body>
</html>
  