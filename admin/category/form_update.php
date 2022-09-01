<?php
 require '../check_admin_login.php' ;
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update category</title>
    <link rel="icon" href="../../img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../Css/form.css">
</head>
<body>
<?php 

    $id =$_GET['id'];

    include '../menu.php';
    require '../connect.php';
    $sql = "select * from category where id='$id'";
    $result = mysqli_query($connect, $sql);
    $each = mysqli_fetch_array($result);
    
?>
    <div class="right">
        <div class="wrapper">
            <h1>Sửa nhà cung cấp</h1>
            <form action="process_update.php" autocomplete="off" method="POST" class="form" id="register-form" style="border-radius: 8px">
                <input type="hidden" name="id" value="<?php echo $each['id'] ?>">

                <div class="form-group valid">
                    <label for="name" class="form-label">Tên nhà cung cấp</label>
                    <input id="name" name="name" type="text" class="form-control" value="<?php echo $each['name'] ?>">
                </div>

                <div class="form-group valid">
                    <label for="photo" class="form-label">Link ảnh nhà cung cấp</label>
                    <input id="photo" name="photo" type="text" class="form-control" value="<?php echo $each['photo'] ?>">
                </div>

                <button class="form-submit">
                    Sửa nhà cung cấp
                </button>
            </form>
        </div>
    </div>
</body>
</html>