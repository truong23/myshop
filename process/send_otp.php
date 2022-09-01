<?php
session_start();
$email = $_POST['email'];

require '../admin/connect.php';
$sql = "select * from customers
where email = '$email'";
$result = mysqli_query($connect,$sql);
$each = mysqli_fetch_array($result);
$number_rows = mysqli_num_rows($result);

if($number_rows == 1){
    require "../mail.php";
    $permitted_chars = '0123456789';
    function generate_string($input, $strength = 10) {
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[random_int(0, $input_length - 1)];
            $random_string .= $random_character;
        }
        return $random_string;
    }
    $otp_code = generate_string($permitted_chars, 4);
    $subject = "Xác nhận email của bạn";
    $body = "Mã xác thực của bạn là: $otp_code";
    sendmail($email,$subject,$body);
    $_SESSION['otp'] = $otp_code;
    $_SESSION['id'] = $each['id'];
    header('location:../get_otp.php');
}else{
	$_SESSION['error'] = 'Không có kết quả tìm kiếm' ;
    header('location:../forgot_password.php');
    exit;
}