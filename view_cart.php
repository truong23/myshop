<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="icon" href="./img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./Css/view_cart.css">
</head>
<body>
    <?php 
    session_start();
    if (isset($_SESSION['cart'])){
    $cart = $_SESSION['cart'];
    };
    $sum = 0 ;
    ?>
    
    <?php include './process/header.php' ?>
    <div class="cart">
        <div class="cart__header">
            <a href="index.php" class="cart__link"> 
                <i class="fa-solid fa-chevron-left"></i>Mua thêm sản phẩm khác
            </a>
            <span>Giỏ hàng của bạn</span>
        </div>    

        <?php if(empty($cart)){ ?>
        <div class="cart__emty">
            <i class="material-symbols-outlined">
                sentiment_dissatisfied
            </i>
            <p>Không có sản phẩm nào trong giỏ hàng, vui lòng quay lại</p>
            <a href="index.php">Quay lại trang chủ</a>
        </div>
        <?php } else {  ?>             
        <div class="cart__body">
            <?php foreach ($cart as $id => $each):  ?>
            <div class="cart__product">
                <div class="cart__img">
                    <img src="admin/products/photos/<?php echo $each['photo'] ?>">
                </div>
                <div class="cart__details">
                    <h1 class="cart__name"><?php echo $each['name']?></h1>
                    <span class="cart__price"><?php echo number_format($each['price'],0,"",".")?><sup>₫</sup></span>
                    <p class="cart__quantity">Chọn số lượng: 
                        <span class="cart__amount"> 
                            <a href="./process/update_quantity_in_cart.php?id=<?php echo $id?>&type=decre">-</a>
                            <?php echo $each['quantity']?>
                            <a href="./process/update_quantity_in_cart.php?id=<?php echo $id?>&type=incre">+</a></span> 
                    </p>
                </div>
                <div class="cart__delete">
                    <a href="./process/delete_from_cart.php?id=<?php echo $id?>">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                </div>
            </div>
            <?php
                $result = $each['price'] * $each['quantity'];
                $sum += $result;
            ?>
            <?php endforeach ?>        
        </div>
        <div class="cart__footer">
            <div class="cart__total">
                <p>Tổng tiền tạm tính:</p>
                <span>
                    <?php echo number_format($sum,0,"",".") ?><sup>₫</sup>
                </span>
            </div>
            <div class="cart__info">
		        <h2>Thông tin người nhận</h2>
                <?php $id = $_SESSION['id']; 
                    require 'admin/connect.php';
                    $sql = "select * from customers where id = '$id'";
                    $result = mysqli_query($connect,$sql);
                    $each = mysqli_fetch_array($result);
                ?>
                <form method="post" action="./process/process_checkout.php">
                    <div class="input-field">
                        <input type="text" name="name_receiver" value="<?php echo $each['name']?>">
                        <label>Tên người nhận</label>
                    </div>
                    <div class="input-field">
                        <input type="text"  name="phone_receiver" value="<?php echo $each['phone_number']?>">
                        <label>số điện thoại người nhận</label>
                    </div>
                    <div class="input-field">
                        <input type="text"  name="address_receiver" value="<?php echo $each['address']?>">
                        <label>địa chỉ người nhận</label>
                    </div>
                    <div class="button">
                        <div class="inner">
                        </div>
                        <button>Đặt hàng</button>
                    </div>
                    <?php include './process/scroll_top.php' ?>
                </form>
	        </div>
        </div>
        <?php } ?>
    </div>
</body>
</html>