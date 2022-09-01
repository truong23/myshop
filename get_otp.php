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
        <h1>Nhập mã bảo mật</h1>
        <?php 
        session_start();
        if(isset($_SESSION['error'])){ ?>
            <div class="error">
                <p>Sai mã xác nhập rồi</p>
            </div>                  
        <?php unset($_SESSION['error']);
        }?>
        <p>Vui lòng kiểm tra mã trong email của bạn. Mã này gồm 4 số.</p>
        <form action="./process/process_otp.php" method="post">
            <input type="number" name="otp" placeholder="Nhập mã"  required>
            <div class="button_wrap">
                <a href="forgot_password.php">Hủy</a>
                <button>Tiếp tục</button>
            </div>
        </form>
    </div>
</body>
</html>