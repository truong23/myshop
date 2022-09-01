<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="./Css/forgot_password.css">
</head>
<body>
    <header>
        <a href="index.php" class="header__logo">
            <img src="./img/myshop.png" alt="">
        </a>
    </header>
    <div class="body">
        <h1>Chọn mật khẩu mới</h1>
        <?php if(isset($_SESSION['error'])){ ?>
            <div class="error">
                <p>Sai mã xác nhập rồi</p>
            </div>                   
        <?php unset($_SESSION['error']);
        }?>
        <p>Tạo mật khẩu mới có tối thiểu 6 ký tự. Mật khẩu mạnh là mật khẩu được kết hợp từ các ký tự, số và dấu câu.</p>
        <form action="./process/process_password.php" method="post">
            <input type="text" name="password" placeholder="Mật khẩu mới" minlength="6" required>
            <div class="button_wrap">
                <a href="forgot_password.php">Bỏ qua</a>
                <button>Tiếp tục</button>
            </div>
        </form>
    </div>
</body>
</html>