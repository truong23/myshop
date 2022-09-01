<?php 
$password = $_POST['password'];

if(isset($_POST['remember'])){
	$remember = true;
} else {
	$remember = false;
}

require '../admin/connect.php';

if(isset($_POST['email'])){
    $email = $_POST['email'];
    $sql = "select * from customers
    where email = '$email' and password = '$password'";
} else {
    $phone_number = $_POST['phone_number'];
    $sql = "select * from customers
    where phone_number = '$phone_number' and password = '$password'";
}
$result = mysqli_query($connect,$sql);
$number_rows = mysqli_num_rows($result);


if($number_rows == 1){
	session_start();
	$each = mysqli_fetch_array($result);
	$id = $each['id'];
	$_SESSION['id'] = $id;
	$_SESSION['name'] = $each['name'];
	if($remember){
		$token = uniqid('user_',true);
		$_SESSION['remember'] = $token;
		// setcookie('remember', $token, time() + 60*60*24*30);
		$sql = "update customers
		set 
		token = '$token'
		where
		id = '$id'
		";
		mysqli_query($connect,$sql);
		
	}
	echo $sql;
	header('location:../index.php');
}else{
	session_start();
	$_SESSION['error'] = 'Sai mật khẩu hoặc tài khoản';
    header('location:../signin.php');
    exit;
}
