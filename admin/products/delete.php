<?php 
require '../check_admin_login.php';
$id = $_GET['id'];

require '../connect.php';
// $sql = "delete inventory from products where id = '$id'";
$sql = "update products set inventory = 0 where id = '$id'";
mysqli_query($connect,$sql);
mysqli_close($connect);
$_SESSION['success'] = "Xóa tồn kho thành công";
header('location: index.php');
