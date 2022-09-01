<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,200,0,0">
    <link rel="stylesheet" href="./Css/order_detail.css">
</head>
<body>
    <?php 
    session_start();
    $order_id = $_GET['id'];
    require 'admin/connect.php';
    include './process/header.php';
    $sql = "select * from orders where id = $order_id";
    $rows = mysqli_query($connect,$sql);
    $row = mysqli_fetch_array($rows);
    $getCreateBill = date_create($row['created_at']);
    $getShippingTime = date_create($row['time_success']);
    $timeCreatBill = date_format($getCreateBill,"d-m-Y H:i");
    $timeShipping = date_format($getShippingTime,"d-m-Y H:i");

    $getDate = strtotime($row['time_success']); // your date
    $timeSuccess = date("d-m-Y H:i", strtotime("+2 day", $getDate));
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $today = date("d-m-Y H:i");


    $sql ="select
    *
    from order_product
    join products on products.id = order_product.product_id 
    where order_id = '$order_id' ";
    $result = mysqli_query($connect , $sql);
    $sum = 0;
    ?>
    <div class="order_detail">
        <div class="order_header">
            <p class="order_introduction">
                <a href="order_history.php?id=<?php echo $_SESSION['id'];?>">
                    <i class="material-symbols-outlined">
                    arrow_back
                    </i>
                </a>
                <span>Thông tin đơn hàng</span> 
            </p>
            <a href="">
                <i class="material-symbols-outlined">
                    help
                </i>
            </a>
        </div>
        <div class="order_notifications">
            <p class="order_status">
                Đơn hàng 
                <?php  
                    switch ($row['status']){
                        case '0':
                            echo "đang chờ duyệt";
                        break;
                        case '1':
                            
                            if($today > $timeSuccess) {
                                echo "đã hoàn thành"; 
                            } else{
                                echo "đang được vận chuyển";
                            }
                           
                        break;
                        case '2':
                            echo "đã bị hủy";
                        break;
                    }
                ?>
            </p>
            <p><?php if($row['status'] != 2){ ?>
                Cảm ơn bạn đã mua hàng!
                <?php } else { ?>
                Xin lỗi vì sự cố này!
                <?php }?>
            </p>
        </div>
        <?php if($row['status'] == 1) {?>
        <div class="order_info border-bottom">
            <div class="order_title">
                <i class="material-symbols-outlined">
                    local_shipping
                </i>
                <span>Thông tin vận chuyển</span>
            </div>
            <span class="mgl-32">Nhanh</span>
            <p class="mgl-32">Best Xpress - <?php echo $row['shipping_code'] ?></p>
            <?php if($today > $timeSuccess) {?>
            <div class="shipping_status status--success">
                <!-- <span>&#8901;</span> -->
                <i class="material-symbols-outlined">
                    radio_button_unchecked
                </i>
                
                <p>Giao hàng thành công</p>
            </div>
            <p class="mgl-32">
                <?php echo $timeSuccess;?>
            </p>
            <?php } else {?>
                <div class="shipping_status ">
                <!-- <span>&#8901;</span> -->
                    <i class="material-symbols-outlined">
                        radio_button_unchecked
                    </i>
                    <p>Đang giao hàng</p>
                </div>
            <?php }?>
        </div>
        <?php }?>
        <div class="order_info">
            <div class="order_title">
                <i class="material-symbols-outlined">
                    location_on
                </i>
                <span>Địa chỉ nhận hàng</span>
            </div>
            <p class="mgl-32"><?php echo $row['name_receiver'] ?></p>
            <p class="mgl-32"><?php echo $row['phone_receiver'] ?></p>
            <p class="mgl-32"><?php echo $row['address_receiver'] ?></p>
        </div>
       
        <?php foreach ($result as  $each):  ?>
        <div class="order_product">
            <div class="product_img">
                <img src="./admin/products/photos/<?php echo $each['photo'] ?>" alt="">
            </div>
            <div class="product_info">
                <p class="product_name"><?php echo $each['name']?></p>
                <p class="product_wrap">
                    <span><?php echo $each['screen_quality']?></span>
                    <span>x<?php echo $each['quantity']?></span>
                </p>
                
                <div class="product_item">
                    <p>7 ngày trả hàng</p>
                    <p class="price_wrap">
                        <?php if($each['price_old'] != $each['price']){ ?>
                        <span class="price_old"><?php echo number_format($each['price_old'],0,"",".")?>&#8363</span>
                        <?php }?>
                        <span class="price"><?php echo number_format($each['price'],0,"",".")?>&#8363</span>
                    </p>                    
                </div>
                
            </div>
        </div>
        <?php endforeach; ?>

        <div class="price_total">
            <span>Thành tiền</span>
            <span>
                <?php echo number_format($row['total_price'],0,"",".")?>&#8363
            </span>
        </div>
        <?php if($row['time_success'] != '') {?>
        <div class="order_time">
            <div class="order_time-item">
                <p>Mã đơn hàng</p>
                <p><?php echo $row['order_code'] ?></p>
            </div>
            <div class="order_time-item">
                <p>Thời gian đặt hàng</p>
                <p><?php echo $timeCreatBill ;?></p>
            </div>
            <div class="order_time-item">
                <p>Thời gian thanh toán</p>
                <p><?php echo $timeCreatBill ;?></p>
            </div>
            <div class="order_time-item">
                <p>Thời gian giao hàng cho vận chuyển</p>
                <p><?php echo $timeShipping ;?></p>
            </div>
            <?php if($today > $timeSuccess){ ?>
            <div class="order_time-item">
                <p>Thời gian hoàn thành</p>
                <p><?php echo $timeSuccess ;?></p>
            </div>
            <?php }?>
        </div>
        <?php }?>

    </div>
    <?php include './process/scroll_top.php'; ?>
    
</body>
</html>