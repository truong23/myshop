<?php
session_start();
$otp_code = $_POST['otp'];
$otp = $_SESSION['otp'];
if ($otp_code == $otp){
    header('location:../change_password.php');
} else{
    $_SESSION['error'] = 'Sai mã xác minh';
    header('location:../get_otp.php');
    exit; 
}