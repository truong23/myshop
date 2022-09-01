<?php 
session_start();
if(empty($_SESSION['level'])) {
    $_SESSION['warning'] = 'Vui lòng đăng nhập với tài khoản super admin';
    header('location:../index.php');
}
