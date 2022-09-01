<?php
 require '../check_admin_login.php' 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>
<link rel="icon" href="../../img/logo.png" type="image/x-icon" />
<link rel="stylesheet" href="../Css/dashboard.css" type="text/css">
</head>
<body>
<?php
    include '../menu.php';
    $id = $_SESSION['id_ad'];
    require '../connect.php';
    $sql = "select * from admin
    where id = $id";
    $result = mysqli_query($connect,$sql);
    $each = mysqli_fetch_array($result);

    $sql_number_user = "select count(*) from customers";
    $arr_number_user = mysqli_query($connect, $sql_number_user);
    $result_number_user = mysqli_fetch_array($arr_number_user);
    $number_user = $result_number_user['count(*)'];  

    $sql_number_product = "select count(*) from products";
    $arr_number_product = mysqli_query($connect, $sql_number_product);
    $result_number_product = mysqli_fetch_array($arr_number_product);
    $number_product = $result_number_product['count(*)'];  

    $sql_number_order = "select count(*) from orders";
    $arr_number_order = mysqli_query($connect, $sql_number_order);
    $result_number_order = mysqli_fetch_array($arr_number_order);
    $number_order = $result_number_order['count(*)']; 
?>

    <div class="right">
        <div class="dashboard">
            <div class="welcome">
                <h1>Welcome to Dashboard</h1>
                <p>Hello <span><?php echo $each['name']; ?></span>,welcome to your awesome dashboard!</p>
            </div>
            <div class="statistical">
                <div class="statistical_item">
                    <div class="statistical_icon">
                        <i class="material-symbols-outlined material-icons">
                            group
                        </i>
                    </div>
                    <span class="counter"> <?php echo $number_user;?> </span>                     
                    <p> Người dùng</p>
                </div>
                <div class="statistical_item">
                    <div class="statistical_icon">
                        <i class="material-symbols-outlined material-icons">
                            folder_open
                        </i>
                    </div>
                    <span> <?php echo $number_product;?> </span>                     
                    <p> Sản phẩm</p>
                </div>
                <div class="statistical_item">
                    <div class="statistical_icon">
                        <i class="material-symbols-outlined material-icons">
                            shopping_cart
                        </i>
                    </div>
                    <span> <?php echo $number_order;?> </span>                     
                    <p> Đơn hàng</p>
                </div>
            </div>
        </div>     
    </div>
</body>
</html>