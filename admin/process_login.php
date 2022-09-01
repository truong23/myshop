<?php 
session_start();
$email = $_POST['email'];
$password = $_POST['password'];
require 'connect.php';
$sql = " select * from admin 
where email = '$email' and password = '$password' ";
$result = mysqli_query($connect,$sql);
if(mysqli_num_rows($result) == 1 ){
    $each = mysqli_fetch_array($result);
    
    $_SESSION['id_ad'] = $each['id'];
    $_SESSION['name_ad'] = $each['name'];
    $_SESSION['level'] = $each['level'];
    header('location:root/index.php');
    exit;
}
$_SESSION['error'] = 'Sai mật khẩu hoặc tài khoản vui lòng thử lại';
header('location:index.php');