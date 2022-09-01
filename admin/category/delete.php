<?php 

if(empty($_GET['id'])){
	header('location:index.php?error=Phải truyền mã để xoá');
	exit;
}

$id = $_GET['id'];

require '../connect.php';
$sql = "delete from category
where
id = '$id'
";

mysqli_query($connect,$sql);
mysqli_close($connect);
session_start();
$_SESSION['success'] = "Xóa thành công";
header('location:index.php?success=Xoá thành công');