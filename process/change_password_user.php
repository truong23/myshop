<?php
session_start();
$id = $_POST['id'];
$current_password = $_POST['current_password'];
$new_password = $_POST['new_password'];

require '../admin/connect.php';
$sql = "select * from customers
where password = '$current_password' and id = '$id'";
$result = mysqli_query($connect,$sql);
$number_rows = mysqli_num_rows($result);

if($number_rows == 1){
	$sql1 = "update customers
    set 
    password = '$new_password'
    where id = '$id'";
    mysqli_query($connect, $sql1);
    $_SESSION['success'] = 'Thay đổi mật khẩu thành công';
    header('location:../user.php');
}
else{
	$_SESSION['errorpw'] = 'Hãy nhập mật khẩu hợp lệ rồi thử lại.';
    header('location:../user.php');
    exit;
}