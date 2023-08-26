<?php
$db_name = 'mysql:host=localhost;dbname=shoesence';
$user_name = 'root';
$user_password = '';
    global $conn;
 $conn= new PDO($db_name, $user_name, $user_password);

?>
