<?php
include '../components/connect.php';


session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:admin_login.php');
}

if (isset($_POST['update'])){

    $pID = $_POST['pID'];
    $pID = filter_var($pID, FILTER_SANITIZE_STRING);

    $pName = $_POST['pName'];
    $pName = filter_var($pName, FILTER_SANITIZE_STRING);

    $pBrand = $_POST['pBrand'];
    $pBrand = filter_var($pBrand, FILTER_SANITIZE_STRING);

    $pCategory = $_POST['pCategory'];
    $pCategory = filter_var($pCategory, FILTER_SANITIZE_STRING);

    $pTargetGroup = $_POST['pTarget_Group'];
    $pTargetGroup = filter_var($pTargetGroup, FILTER_SANITIZE_STRING);

    $pPrice = $_POST['pPrice'];
    $pPrice = filter_var($pPrice, FILTER_SANITIZE_STRING);

    $pSize = $_POST['pSize'];
    $pSize = filter_var($pSize, FILTER_SANITIZE_STRING);

    $pDesc = $_POST['pDesc'];
    $pDesc = filter_var($pDesc, FILTER_SANITIZE_STRING);




    $update_product = $conn->prepare("UPDATE `products` SET pName= ?, pBrand= ?, pPrice = ?,pSize = ?, pTargetGroup = ?, pCategory = ?, pDescription = ? WHERE pID =?");
    $update_product->execute([$pName,$pBrand,$pPrice,$pSize,$pTargetGroup,$pCategory,$pDesc,$pID]);

    $message_success[] = 'Product Updated';

    //previous images
    $old_img1 = $_POST['old_img1'];
    $old_img2 = $_POST['old_img2'];
    $old_img3 = $_POST['old_img3'];
    $old_img4 = $_POST['old_img4'];
    $old_img5 = $_POST['old_img5'];

    //Image Files
    $image_1 = $_FILES['image1']['name'];
    $image_1 = filter_var($image_1, FILTER_SANITIZE_STRING);
    $image_Size_1 = $_FILES['image1']['size'];
    $image_tmp_name_1 = $_FILES['image1']['tmp_name'];
    $image_Folder_1 = '../uploaded-img/'.$image_1;


    $image_2 = $_FILES['image2']['name'];
    $image_2 = filter_var($image_2, FILTER_SANITIZE_STRING);
    $image_Size_2 = $_FILES['image2']['size'];
    $image_tmp_name_2 = $_FILES['image2']['tmp_name'];
    $image_Folder_2 = '../uploaded-img/'.$image_2;


    $image_3 = $_FILES['image3']['name'];
    $image_3 = filter_var($image_3, FILTER_SANITIZE_STRING);
    $image_Size_3 = $_FILES['image3']['size'];
    $image_tmp_name_3 = $_FILES['image3']['tmp_name'];
    $image_Folder_3 = '../uploaded-img/'.$image_3;


    $image_4 = $_FILES['image4']['name'];
    $image_4 = filter_var($image_4, FILTER_SANITIZE_STRING);
    $image_Size_4 = $_FILES['image4']['size'];
    $image_tmp_name_4 = $_FILES['image4']['tmp_name'];
    $image_Folder_4 = '../uploaded-img/'.$image_4;


    $image_5 = $_FILES['image5']['name'];
    $image_5 = filter_var($image_5, FILTER_SANITIZE_STRING);
    $image_Size_5 = $_FILES['image5']['size'];
    $image_tmp_name_5 = $_FILES['image5']['tmp_name'];
    $image_Folder_5 = '../uploaded-img/'.$image_5;

    //Define the image Path
    $image_dir ='../uploaded-img/';

    //Error Handling while file handle deletion
    function deleteFile($file){
        global  $image_dir;
        $file_path = $image_dir.$file;

        if (file_exists($file_path)){
            if(unlink($file_path)){
                echo "File Deleted : $file\n";
            }else {
                echo "Error Deleting file : $file\n";
            }
        }else{
            echo "File not Found: $file\n";
        }
    }

    if(!empty($image_1) && ($image_2) && ($image_3) && ($image_4) && ($image_5)){
        //Update Image 1
        if ($image_1 > 2000000){
            $message_error[] = 'Image is too large';
        }else {
            $update_image_1 = $conn->prepare("UPDATE `products` SET 	pImage1 = ? WHERE pID = ?");
            $update_image_1->execute([$image_1, $pID]);
            move_uploaded_file($image_tmp_name_1, $image_Folder_1);
            deleteFile($old_img1);
            $message_success[] = 'image updated!';
        }
        // Update Image 2
        if ($image_2 > 2000000){
            $message_error[] = 'Image is too large';
        }else {
            $update_image_2 = $conn->prepare("UPDATE `products` SET 	pImage2 = ? WHERE pID = ?");
            $update_image_2->execute([$image_2, $pID]);
            move_uploaded_file($image_tmp_name_2, $image_Folder_2);
            deleteFile($old_img2);
            $message_success[] = 'image updated!';
        }
        // Update Image 3
        if ($image_3 > 2000000){
            $message_error[] = 'Image is too large';
        }else {
            $update_image_3 = $conn->prepare("UPDATE `products` SET 	pImage3 = ? WHERE pID = ?");
            $update_image_3->execute([$image_3, $pID]);
            move_uploaded_file($image_tmp_name_3, $image_Folder_3);
            deleteFile($old_img3);
            $message_success[] = 'image updated!';
        }
        // Update Image 4
        if ($image_4 > 2000000){
            $message_error[] = 'Image is too large';
        }else {
            $update_image_4 = $conn->prepare("UPDATE `products` SET 	pImage4 = ? WHERE pID = ?");
            $update_image_4->execute([$image_4, $pID]);
            move_uploaded_file($image_tmp_name_4, $image_Folder_4);
            deleteFile($old_img4);
            $message_success[] = 'image updated!';
        }
        // Update Image 5
        if ($image_5 > 2000000){
            $message_error[] = 'Image is too large';
        }else {
            $update_image_5 = $conn->prepare("UPDATE `products` SET 	pImage1 = ? WHERE pID = ?");
            $update_image_5->execute([$image_5, $pID]);
            move_uploaded_file($image_tmp_name_5, $image_Folder_5);
            deleteFile($old_img5);
            $message_success[] = 'image updated!';
        }
    }
    header('location:manage_products.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Update Product</title>

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

        <div class="board board-edit-product">
        <h3 class="i-tableheading">Update products </h3>

            <div class="form-container">
                <?php
                $update_ID = $_GET['update'];
                $show_products = $conn->prepare("SELECT * FROM `products` WHERE pID = ?");
                $show_products->execute([$update_ID]);
                if ($show_products->rowCount() > 0){
                    while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)){

                ?>
                <div class="product-img">
                    <img src="../uploaded-img/<?= $fetch_products['pImage1'];?>" alt="">

                </div>
              <form action="" method="POST" enctype="multipart/form-data">
                  <!--Hidden Data Fetch -->
                  <input type="hidden" name="pID" value="<?= $fetch_products['pID']; ?>">
                  <input type="hidden" name="old_img1" value="<?= $fetch_products['pImage1']; ?>">
                  <input type="hidden" name="old_img2" value="<?= $fetch_products['pImage2']; ?>">
                  <input type="hidden" name="old_img3" value="<?= $fetch_products['pImage3']; ?>">
                  <input type="hidden" name="old_img4" value="<?= $fetch_products['pImage4']; ?>">
                  <input type="hidden" name="old_img5" value="<?= $fetch_products['pImage5']; ?>">

                  <label>Product Name</label>
                <input class="" type="text" placeholder="Product Name" name="pName" value="<?= $fetch_products['pName']; ?>" >
                <label>Brand</label>
                <select name="pBrand">
                    <option value="<?= $fetch_products['pBrand']; ?>"><?= $fetch_products['pBrand']; ?></option>
                    <option value="Nike">Nike</option>
                    <option value="Adidas">Adidas</option>
                    <option value="Puma">Puma</option>
                    <option value="under armour">Under Armour</option>
                </select>
                <label>Category</label>
                <select name="pCategory" >
                        <option value="<?= $fetch_products['pCategory'];?>"><?= $fetch_products['pCategory'];?></option>
                        <option value="Running">Running</option>
                        <option value="Formal">Formal</option>
                        <option value="Boots">Boots</option>
                        <option value="Casual">Casual</option>
                        <option value="Sneakers">Sneakers</option>
                </select>
                <label>Target Group</label>
                <select name="pTarget_Group" >
                    <option value="<?= $fetch_products['pTargetGroup'];?>"><?= $fetch_products['pTargetGroup'];?></option>
                    <option value="Men">Men</option>
                    <option value="Women">Women</option>
                    <option value="Kids">Kids</option>
                 </select>
                <label>New Price</label>
                <input type="text" placeholder="Price" name="pPrice" value="<?= $fetch_products['pPrice']; ?>" >
                <label>Size</label>
                <input type="number" placeholder="Size" name="pSize" value="<?= $fetch_products['pSize']; ?>" >
                <label>Update Description</label>
                <input type="text"  placeholder="product description" name="pDesc" value="<?= $fetch_products['pDescription']; ?>"  class="textarea" >

             
                <label>Update Images</label>
                <input type="file" placeholder="image1" name="image1" accept="image/jpeg, image/jpg, image/png, image/svg, image/webp" >
                <input type="file" placeholder="image2" name="image2" accept="image/jpeg, image/jpg, image/png, image/svg, image/webp" >
                <input type="file" placeholder="image3" name="image3" accept="image/jpeg, image/jpg, image/png, image/svg, image/webp" >
                <input type="file" placeholder="image4" name="image4" accept="image/jpeg, image/jpg, image/png, image/svg, image/webp" >
                <input type="file" placeholder="image5" name="image5" accept="image/jpeg, image/jpg, image/png, image/svg, image/webp" >

                <button type="submit" name="update" class="btn update-product-btn">Update Product</button>


              </form>
                <?php
                }
                }else{
                  echo '<h5 class="empty_message" >No Products yet</h5>';
                }
                ?>
            </div>
        </div>
    </section>
    <script src="../JS/admin_script.js"></script>
</body>
</html>