<?php 
session_start();
require 'admin/connect.php';
include 'process/show_notify.php';
$phone = null;
$password = null;
if(isset($_SESSION['remember'])){
	$token = $_SESSION['remember'];
	$sql = "select * from customers where token = '$token' ";
	$result = mysqli_query($connect,$sql);
	$each = mysqli_fetch_array($result);
	$phone = $each['phone_number'];
	$password =$each['password'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="./Css/signin.css">
</head>
<body>  
    <div class="container">
		<a href="index.php" class="return">
			<i class="material-symbols-outlined">
				arrow_back_ios
			</i>
				Quay lại
		</a>
		<header>
			Login
		</header>
		<form method="post" action="./process/process_signin.php">
			<span class="desc">
				<?php 
                    if(isset($_SESSION['error'])){
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    }
                ?>
			</span>
			<div class="input-field">
				<input type="text" name="phone_number" id="option_login" value="<?php echo $phone;?>" required>
				<label>Số điện thoại hoặc email </label>
			</div>
			<div class="input-field">
				<input class="pswrd" type="password" name="password" value="<?php echo $password; ?>" required>
				<span class="show">
					<i class="material-symbols-outlined">visibility</i>
				</span> 
				<label>Password</label>
			</div>
			<div class="wrapper">
				<label>
					<input type="checkbox" name="remember">
					Lưu đăng nhập
				</label>
				<a href="forgot_password.php">Quên mật khẩu?</a>
			</div>
			
			<div class="button">
				<div class="inner">
				</div>
				<button>LOGIN</button>
			</div>
		</form>
		<div class="signup">
			Not a member? <a href="./signup.php">Đăng ký ngay</a>
		</div>
	</div>
    <script src="./Javacript/toggle_pwd.js"></script>
	<script>
		let optionLogin = document.querySelector("#option_login")
		optionLogin.addEventListener("change", myFunction);

		function myFunction() {
			if(isFinite(optionLogin.value) === false){
			optionLogin.setAttribute('name','email');
			}
		}
	</script>
</body>
</html>