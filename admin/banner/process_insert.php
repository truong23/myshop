<?php
require '../check_admin_login.php' ;
$photo = $_FILES['photo'];

$folder ='images/';
$file_extension = explode('.', $photo['name'])[1];
$file_name = time() . '.' . $file_extension;
$path_file = $folder . $file_name;

move_uploaded_file($photo["tmp_name"], $path_file);

require '../connect.php';

$sql = " insert into banner(photo)
 Values('$file_name')";
 mysqli_query($connect, $sql);
 mysqli_close($connect);
session_start();
$_SESSION['success'] = "Thêm  thành công";
 header('location:index.php');

