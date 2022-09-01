<?php
 require '../check_admin_login.php' ;
 $page = 1;
 $find = '';
 if(isset($_GET['page'])){
      $page = $_GET['page'];
 }
$id = $_POST['id'];
$name = $_POST['name'];
$photo = $_POST['photo'];
require '../connect.php';
$sql = "update category
set
name = '$name',
photo = '$photo'
where
id ='$id'
";
mysqli_query($connect, $sql);
mysqli_close($connect);
$_SESSION['success'] = "Cập nhật thành công";
header('location:index.php');

