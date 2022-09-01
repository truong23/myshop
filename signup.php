<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="./Css/signup.css">
    <script src="./Javacript/validator.js"></script>
</head>
<body>
    <div class="main">
        <form action="./process/process_signup.php" autocomplete="off" method="POST" class="form" id="register-form" style="border-radius: 8px">
            <a href="index.php" class="return">
                <i class="material-symbols-outlined">
                    arrow_back_ios
                </i>
                    Quay lại
            </a>
            <h1 class="heading">Đăng Ký</h1>
            <span class="desc">
                <?php 
                    session_start();
                    if(isset($_SESSION['error'])){
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    }
                ?>
            </span>
            <div class="spacer"></div>

            <div class="form-group valid">
                <label for="name" class="form-label">Họ và tên</label>
                <input id="name" name="name" rules="required" type="text" placeholder="VD: Đào Văn Trường"
                    class="form-control">
                <span class="form-message"></span>
            </div>

            <div class="form-group">
                <label for="address" class="form-label">Địa chỉ</label>
                <input id="address" name="address" rules="required" type="text" placeholder="VD: Hà Nội"
                    class="form-control">
                <span class="form-message"></span>
            </div>

            <div class="form-group">
                <label for="phone" class="form-label">Số điện thoại</label>
                <input id="phone" name="phone_number" rules="required" type="text" placeholder="VD: 0859682101"
                    class="form-control">
                <span class="form-message"></span>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input id="email" name="email" rules="required|email" type="email" placeholder="VD: email@domain.com"
                    class="form-control">
                <span class="form-message"></span>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Mật khẩu</label>
                <input id="password" name="password" rules="required|min:6" type="password" placeholder="Nhập mật khẩu"
                    class="form-control">
                <span class="form-message"></span>
            </div>

            <div class="form-group">
                <label for="password-confirmation" class="form-label">Nhập lại mật khẩu</label>
                <input id="password-confirmation" name="confirm" rules="required|confirm"
                    type="password" placeholder="Nhập lại mật khẩu" class="form-control">
                <span class="form-message"></span>
            </div>

            <button class="form-submit">
                Đăng Ký
            </button>
        </form>
    </div>
    <script>
        const registerForm =  new Validator("#register-form");      
    </script>
</body>
</html>