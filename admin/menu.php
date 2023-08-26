<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!---Custom CSS -->
    <link rel="stylesheet" href="../admin/CSS/admin_style.css">
    <link rel="stylesheet" href="../admin/CSS/manageproducts.css">

    <!---Custom Icon Library Font awesome -->
    <script src="https://kit.fontawesome.com/b1114c89ce.js" crossorigin="anonymous"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  
</head>
<body>
    <section id="menu" >
        <div class="logo">
                <img src="../images/logo_white.png" alt="">
                
        </div>
        <div class="item">
            <li><i class="fa-solid fa-chart-pie"></i><a href="dashboard.php">Dashboard</a></li>
            <li><i class="fa-solid fa-bag-shopping"></i></i><a href="manage_products.php">Products</a></li>
            <li><i class="fa-solid fa-users"></i><a href="manage_users.php">Customers</a></li>
            <li><i class="fa-solid fa-truck-fast"></i><a href="manage_oders.php">Orders</a></li>
            <li><i class="fa-solid fa-inbox"></i><a href="Messages.php">Messages</a></li>
            <li><i class="fa-solid fa-id-card"></i><a href="admin_profile.php">Profile</a></li>
            <li><i class="fa-solid fa-clipboard-user"></i><a href="admins.php">Admins</a></li>
            <li><i class="fa-solid fa-right-from-bracket"></i>
            <a href="../components/admin_logout.php">Logout</a></li>
        </div>
    </section>

    
    <script src="../JS/admin_script.js"></script>
</body>
</html>