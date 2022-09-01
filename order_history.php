<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử đơn hàng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,100,0,0">
    <link rel="stylesheet" href="./Css/order_history.css">
</head>
<body>
    <?php 
    session_start();
    $id = $_GET['id'];
    require 'admin/connect.php';
    include "./process/header.php";
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $last_year = date("d/m/Y",strtotime("-1 Years"));
    $today = date("d/m/Y");

    $sql ="select 
    orders.*,
    customers.name,
    customers.phone_number,
    customers.address
    from orders
    join customers 
    on customers.id = orders.customer_id 
    where customers.id= '$id' and created_at > $last_year";
    $result = mysqli_query($connect , $sql);
    $number_rows = mysqli_num_rows($result);
    $nowDay = date("d-m-Y H:i");
    ?>
    <div class="orders">
        <div class="order__header">
            <a href="index.php" class="order__link"> 
                <i class="fa-solid fa-chevron-left"></i>Trở về
            </a>
            <span>Đơn hàng đã mua gần đây</span>
        </div>    

        <?php if($number_rows === 0){ ?>
        <div class="order__emty">
            <i class="material-symbols-outlined">
                sentiment_dissatisfied
            </i>
            <p>Lịch sử đơn hàng của bạn đang trống</p>
            <a href="index.php">Quay lại trang chủ</a>
        </div>
        <?php }  else{?>
            <div class="order_body">
                <div class="introduce">
                    <i class="material-symbols-outlined">
                        info
                    </i>
                    <p>Đây là danh sách đơn hàng bạn đã đặt mua từ ngày <span><?php echo $last_year ;?></span> đến <span><?php echo $today ;?></span></p>
                </div>
                <?php foreach ($result as  $each): ?>
                <?php    
                $getDate = strtotime($each['time_success']); 
                $timeSuccess = date("d-m-Y H:i", strtotime("+2 day", $getDate));
                ?>
                <div class="order_list">
                    <div class="order_top">
                        <p class="order_code">
                            Đơn hàng:<span> #<?php echo $each['order_code']; ?></span>
                        </p>
                        <p class="order_status">
                            <?php  
                                switch ($each['status']){
                                    case '0':
                                        echo "<span style='color:orange'>Đang chờ duyệt</span>";
                                    break;
                                    case '1':               
                                        if($nowDay < $timeSuccess) {  
                                            echo "<span style='color:#79c9a6'>Đang giao hàng</span>";                                                      
                                        }else{
                                            echo "<span style='color:#79c9a6'>Đã hoàn thành</span>";
                                        }
                                    break;
                                    case '2':
                                        echo "<span style='color:red'>Đơn hàng bị hủy</span>";
                                    break;
                                }
                            ?>
                        </p>
                    </div>
                    <?php     
                        $order_id = $each['id'];            
                        $sql ="select
                        *
                        from order_product
                        join products on products.id = order_product.product_id 
                        where order_id = '$order_id'
                        order by products.price desc
                        limit 1";
                        $phones = mysqli_query($connect , $sql);
                        $phone = mysqli_fetch_array($phones);

                        $sql="select * from order_product where order_id = '$order_id'";
                        $rows = mysqli_query($connect , $sql);
                        $number_order = mysqli_num_rows($rows) - 1;
                        
                    ?>
                    <div class="order_item">
                        <div class="order_wrap">
                            <img src="./admin/products/photos/<?php echo $phone['photo']; ?>" alt="">
                            <div class="order_info">
                                <p class="product_name">
                                    <?php echo $phone['name']; ?>
                                    <?php if($number_order!== 0){?>
                                        và <strong><?php echo $number_order; ?> s.phẩm</strong> khác
                                    <?php }?>
                                </p>
                                <p class="order_create">Ngày đặt: <?php echo date_format(date_create($each['created_at']),"d/m/Y") ;?></p>
                                <?php if($each['status'] == 0) {?>
                                <a href="./process/delete_from_order.php?id=<?php echo $each['id']?>">Hủy đơn hàng</a>
                                <?php } else{ ?>
                                <a href="order_detail.php?id=<?php echo $each['id']?>">Xem chi tiết</a>
                                <?php } ?>
                            </div>
                        </div>
                        <span class="product_price" ><?php echo number_format($each['total_price'],0,"",".")?><sup>&#8363</sup></span> 
                    </div>                              
                </div>
                <?php endforeach; ?>
            </div>           
        <?php }?>     
        <?php include './process/scroll_top.php'; ?>  
</body>
</html>