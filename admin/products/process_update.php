<?php
 require '../check_admin_login.php' ;
$id = $_POST['id'];
$name = $_POST['name'];
$photo_new = $_FILES['photo_new'];
$photo_old = $_POST['photo_old'];
if($photo_new['size'] > 0){
    unlink("photos/$photo_old");
    $folder ='photos/';
    $file_extension = explode('.', $photo_new['name'])[1];
    $file_name = time() . '.' . $file_extension;
    $path_file = $folder . $file_name;
    
    move_uploaded_file($photo_new["tmp_name"], $path_file);
}
else {
    $file_name = $photo_old;
}
$price = $_POST['price'];
$price_old = $_POST['price_old'];
$screen_size = $_POST['screen_size'];
$screen_quality = $_POST['screen_quality'];
$inventory = $_POST['inventory'];
$description = $_POST['description'];
$category_id = $_POST['category_id'];
require '../connect.php';
$sql = "update products 
set
name = '$name',
photo = '$file_name',
price = '$price',
price_old = '$price_old',
screen_size = '$screen_size',
screen_quality = '$screen_quality',
inventory = '$inventory',
description = '$description',
category_id = '$category_id'
where
id ='$id'
";
 mysqli_query($connect, $sql);
mysqli_close($connect);
// session_start();
$_SESSION['success'] = "Cập nhật thành công";
header('location:index.php');

