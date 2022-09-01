<?php
 require '../check_admin_login.php' ;
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add category</title>
    <link rel="icon" href="../../img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../Css/form.css">
</head>
<body>
    <?php 
    include '../menu.php';
    ?>
    <div class="right">
        <div class="wrapper">
            <h1>Thêm danh mục sản phẩm</h1>
            <form action="process_insert.php" autocomplete="off" method="POST" class="form" id="register-form" style="border-radius: 8px">
                <div class="form-group valid">
                    <label for="name" class="form-label">Tên chuyên mục</label>
                    <input id="name" name="name" type="text" class="form-control" placeholder="Mời nhập tên chuyên mục" required>
                </div>

                <div class="form-group valid">
                    <label for="photo" class="form-label">Link ảnh chuyên mục</label>
                    <input id="photo" name="photo" type="text" class="form-control" placeholder="mời nhập link ảnh chuyên mục" required>
                </div>

                <button class="form-submit">
                    Thêm chuyên mục sản phẩm
                </button>
            </form>
        </div>
    </div>
</body>
</html>