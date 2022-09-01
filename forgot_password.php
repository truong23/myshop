<?php 
session_start();
require 'admin/connect.php';
$each['phone_number'] = null;
$each['password'] = null;
if(isset($_SESSION['remember'])){
	$token = $_SESSION['remember'];
	$sql = "select * from customers where token = '$token' limit 1";
	$result = mysqli_query($connect,$sql);
	$each = mysqli_fetch_array($result);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot password</title>
    <link rel="stylesheet" href="./Css/forgot_password.css">
</head>
<body>
    <header>
        <a href="index.php" class="header__logo">
            <img src="./img/myshop.png" alt="">
        </a>
        <div class="header-wrapper">
            <form method="post" action="./process/process_signin.php">
                <input type="text" name="phone_number" placeholder="Email hoặc điện thoại" id="option_login" value="<?php echo $each['phone_number']; ?>" required>
                <input class="pswrd" type="password" placeholder="Mật khẩu" name="password" value="<?php echo $each['password']; ?>" required>
                <button class="btn">Đăng Nhập</button>
            </form>
            <a href="./signup.php">Tạo tài khoản mới?</a>
        </div>
    </header>
    <div class="body">
        <h1>Tìm tài khoản của bạn</h1>
        
        <?php if(isset($_SESSION['error'])){ ?>
            <div class="error">
                <h2>Không có kết quả tìm kiếm</h2>
                <p>Tìm kiếm không trả về kết quả nào. Vui lòng thử lại với thông tin khác.</p>
            </div>                   
        <?php unset($_SESSION['error']);
        }?>
        
        
        <p>Vui lòng nhập email để tìm kiếm tài khoản của bạn</p>
        <form action="./process/send_otp.php" method="post">
            <input type="email" name="email" placeholder="Nhập email của bạn"  required>
            <div class="button_wrap">
                <a href="signin.php">Hủy</a>
                <button>Tìm kiếm</button>
            </div>
        </form>
    </div>
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

