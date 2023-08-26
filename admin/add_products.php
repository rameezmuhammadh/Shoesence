<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:admin_login.php');
}



    if(isset($_POST['add_product'])){

        $productName = $_POST['productName'];
        $productName = filter_var($productName, FILTER_SANITIZE_STRING);

        $brandName = $_POST['brandName'];
        $brandName = filter_var($brandName,FILTER_SANITIZE_STRING);

        $category = $_POST['category'];
        $category = filter_var($category, FILTER_SANITIZE_STRING);

        $target_group = $_POST['target_group'];
        $target_group = filter_var($target_group, FILTER_SANITIZE_STRING);

        $price =$_POST['price'];
        $price =filter_var($price, FILTER_SANITIZE_STRING);

        $size =$_POST['size'];
        $size = filter_var($size, FILTER_SANITIZE_STRING);

        $desc = $_POST['desc'];
        $desc = filter_var($desc, FILTER_SANITIZE_STRING);


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
  
        $select_products = $conn->prepare("SELECT * FROM `products` WHERE pName = ?");
        $select_products->execute([$productName]);

        if($select_products->rowCount() >0){
            $message_error[] ='product name already exist!';
        }else{
            if ($image_Size_1 > 2000000 && $image_Size_2 > 2000000 && $image_Size_3 > 2000000 && $image_Size_4 >  2000000 && $image_Size_5 > 2000000){
                $message_error[] = 'image size is too large';
            }
            else {
                move_uploaded_file($image_tmp_name_1, $image_Folder_1);
                move_uploaded_file($image_tmp_name_2, $image_Folder_2);
                move_uploaded_file($image_tmp_name_3, $image_Folder_3);
                move_uploaded_file($image_tmp_name_4, $image_Folder_4);
                move_uploaded_file($image_tmp_name_5, $image_Folder_5);

                $insert_product = $conn->prepare("INSERT INTO `products`( `pName`, `pBrand`, `pPrice`, `pSize`, `pTargetGroup`, `pCategory`, `pDescription`, `pImage1`, `pImage2`, `pImage3`, `pImage4`, `pImage5`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
                $insert_product->execute([$productName,$brandName,$price,$size,$target_group,$category,$desc,$image_1,$image_2,$image_3,$image_4,$image_5]);

                $message_success[] = 'new product added!';
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

    <title>Add Product</title>

        <!---- Browser Tab Icon ----->
        <link rel="icon" type="image/x-icon" href="../images/brower-tab-icon.png">

    <!---Custom CSS -->
    <link rel="stylesheet" href="../admin/CSS/admin_style.css">
    <link rel="stylesheet" href="../admin/CSS/manageproducts.css">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">

        <!---Custom Icon Library Font awesome -->
        <script src="https://kit.fontawesome.com/b1114c89ce.js" crossorigin="anonymous"></script>
        
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>
<body>
<?php include 'menu.php';?>


    <section id="interface">
        <?php include 'navsection.php';?>

        <div class="board board-add-product">
            <h3 class="i-tableheading">Add products </h3>
            <div class="form-container">

              <form action="" method="post" enctype="multipart/form-data">
                <input class="" type="text" placeholder="Product Name" name="productName" required>
                <select name="brandName" required>
                    <option value="" disabled selected>Select Brand</option>
                    <option value="Nike">Nike</option>
                    <option value="Adidas">Adidas</option>
                    <option value="Puma">Puma</option>
                    <option value="Under Armour">Under Armour</option>
                </select>
                <select name="category" required>
                        <option value="" disabled selected>Select Category</option>
                        <option value="Running">Running</option>
                        <option value="Formal">Formal</option>
                        <option value="Boots">Boots</option>
                        <option value="Casual">Casual</option>
                        <option value="Sneakers">Sneakers</option>
                </select>
                <select name="target_group" required>
                    <option value="" disabled selected>Select Target Group</option>
                    <option value="Men">Men</option>
                    <option value="Women">Women</option>
                    <option value="Kids">Kids</option>
                 </select>
                <input type="text" placeholder="Price" name="price" required>
                <input type="number" placeholder="Size" name="size" required>
                <textarea  cols="30" rows="10" placeholder="product description" name="desc" required></textarea>
                <input type="file" placeholder="image1" name ="image1" accept="image/jpeg, image/jpg, image/png, image/svg, image/webp" required>
                <input type="file" placeholder="image2" name ="image2" accept="image/jpeg, image/jpg, image/png, image/svg, image/webp" required>
                <input type="file" placeholder="image3" name ="image3" accept="image/jpeg, image/jpg, image/png, image/svg, image/webp" required>
                <input type="file" placeholder="image4" name ="image4" accept="image/jpeg, image/jpg, image/png, image/svg, image/webp" required>
                <input type="file" placeholder="image5" name ="image5" accept="image/jpeg, image/jpg, image/png, image/svg, image/webp" required>
                <button type="submit" name="add_product" class="btn add-product-btn">Add Product</button>
              </form> 
            </div>
        </div>
    </section>
    <script src="../JS/admin_script.js"></script>
</body>
</html>
