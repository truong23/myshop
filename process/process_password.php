<?php
session_start();
$password = $_POST['password'];
$id = $_SESSION['id'];
require '../admin/connect.php';
$sql = "update customers
    set 
    password = '$password'
    where id = '$id'";
    mysqli_query($connect, $sql);
    $_SESSION['success'] = 'Thay đổi mật khẩu thành công';
    header('location:../index.php');
