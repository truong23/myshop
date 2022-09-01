<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../Css/signin.css">
</head>
<body>
    <?php 
    session_start();
    include 'show_notify_login.php';
    ?>
    <div class="container">
		<header>Login</header>
        <form method="post"action="process_login.php">
            <div class="input-field">
                <input type="text" name="email" required>
                <label>Email</label>
            </div>
            <div class="input-field">
                <input class="pswrd" type="password" name="password" required>
                <span class="show">SHOW</span>
                <label>Password</label>
            </div>
            <div class="button">
                <div class="inner">
                </div>
                <button>LOGIN</button>
            </div>
        </form>
    </div>
    <script src="../Javacript/toggle_pwd.js"></script>
</body>
</html>