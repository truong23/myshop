<?php
 require '../check_admin_login.php' ;
$name = $_POST['name'];
$photo = $_FILES['photo'];
$price = $_POST['price'];

$price_old = $_POST['price'];
if($_POST['price_old'] != ''){
$price_old = $_POST['price_old'];
}
$screen_size = $_POST['screen_size'];
$screen_quality = $_POST['screen_quality'];
$inventory = $_POST['inventory'];
$description = $_POST['description'];
$category_id = $_POST['category_id'];

$folder ='photos/';
$file_extension = explode('.', $photo['name'])[1];
$file_name = time() . '.' . $file_extension;
$path_file = $folder . $file_name;

move_uploaded_file($photo["tmp_name"], $path_file);

require '../connect.php';

$sql = " insert into products(name,photo,price,price_old,screen_size,screen_quality,inventory,description,category_id)
 Values('$name','$file_name','$price','$price_old','$screen_size','$screen_quality','$inventory','$description','$category_id')";

 mysqli_query($connect, $sql);

 mysqli_close($connect);
 session_start();
 $_SESSION['success'] = "Thêm thành công";
 header('location:index.php');


