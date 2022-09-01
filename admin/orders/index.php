<?php
 require '../check_super_admin_login.php' ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="icon" href="../../img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="../Css/orders.css">
</head>
<body>
     <?php   
          include '../menu.php';
          require '../connect.php';
          $page = 1;
          $find = '';
          if(isset($_GET['page'])){
               $page = $_GET['page'];
          }
          if(isset($_GET['find'])){
               $find = $_GET['find'];
          }

          $sql_number_order = "select count(*) from orders where order_code like '%$find%'";

          $arr_number_order = mysqli_query($connect, $sql_number_order);
          $result_number_order = mysqli_fetch_array($arr_number_order);
          $number_orders = $result_number_order['count(*)'];

          $number_in_page = 5;
          $number_page = ceil($number_orders / $number_in_page);
          $skip = $number_in_page * ($page - 1);

          $sql = "select 
          orders.*,
          customers.name,
          customers.phone_number,
          customers.address
          from orders
          join customers 
          on customers.id = orders.customer_id 
          where orders.order_code like '%$find%'
          limit $number_in_page offset $skip";
          $result = mysqli_query($connect, $sql);
     ?>

        <div class="right">
            <div class="orders">
                <h1>Danh sách đơn đặt hàng </h1>
                <form class="orders__search">
                    <input type="text" class="input-search" placeholder="Mời nhập mã đơn hàng  ..."  name="find" autocomplete="off" maxlength="100">
                    <button type="submit" class="search-btn">
                    <i class="material-symbols-outlined material-icons">
                        search
                    </i>
                    </button>
                </form>                               
                <?php if($number_orders == 0 ) { ?>
                <p class="orders--empty">
                        Không tìm thấy đơn hàng cho id '<strong><?php echo $_GET['find']?></strong>'
                </p>
                <?php } 
                else { ?>
                    <table border="1" width="100%">
                        <tr>
                            <th>Mã</th>
                            <th>Mã đơn hàng</th>
                            <th>Thời gian đặt</th>
                            <th>Thông tin người nhận</th>
                            <th>Thông tin người đặt</th>
                            <th>Trạng thái</th>
                            <th>Tổng tiền</th>
                            <th>hành động</th>
                        </tr>
                        <?php foreach ($result as $each): ?>
                        <tr>
                        <td><?php echo $each['id'] ?></td>
                        <td><?php echo $each['order_code'] ?></td>
                        <td><?php echo $each['created_at'] ?></td>
                        <td>
                            <?php echo $each['name_receiver'] ?><br>
                            <?php echo $each['phone_number'] ?><br>
                            <?php echo $each['address_receiver'] ?><br>
                        </td>
                        <td>
                            <?php echo $each['name'] ?><br>
                            <?php echo $each['phone_number'] ?><br>
                            <?php echo $each['address'] ?><br>
                        </td>
                        <td>
                            <?php  
                                switch ($each['status']){
                                    case '0':
                                        echo "<span style='color:orange'>Mới đặt</span>";
                                    break;
                                    case '1':
                                        echo "<span style='color:green'>Hoàn thành</span>";
                                    break;
                                    case '2':
                                        echo "<span style='color:red'>Thất bại</span>";
                                    break;
                                }
                            ?>
                        </td>
                        <td><?php echo number_format($each['total_price'],0,"",".")?><sup>&#8363</sup></td>
                        <td>
                            <a href="detail.php?id=<?php echo $each['id']?>" class="orders_detail">
                                Xem
                            </a>

                            <a href="update.php?id=<?php echo $each['id']?>&status=1" class="orders_update">
                                Duyệt
                            </a>
                            
                            <a href="update.php?id=<?php echo $each['id']?>&status=2" class="orders_delete">
                                Hủy
                            </a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                    </table>               

                <?php if($number_page != 1) { ?>
                        <ul class="pagination">
                            <?php for($i = 1; $i <= $number_page; $i++ ){?>
                            <li class="pagination-item">
                            <?php if($i == $page){ ?>  
                                <a href="?page=<?php echo $i; ?>&find=<?php echo $find; ?>" class="pagination-item__link active">
                                    <?php echo $i ?>
                                </a>
                            <?php } else {?>
                                <a href="?page=<?php echo $i; ?>&find=<?php echo $find; ?>" class="pagination-item__link">
                                    <?php echo $i ?>
                                </a>
                            <?php }?>
                            </li>
                            <?php }?>
                        </ul>
                <?php } ?>  
            <?php } ?>            
            </div>
        </div>

 
</body>
</html>