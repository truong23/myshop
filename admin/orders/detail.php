<?php
 require '../check_super_admin_login.php' ;
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    <link rel="icon" href="../../img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="../Css/form.css">
    <style>
        table{
            width: 100%;   
            text-align: center;
            text-transform: capitalize;
            border-collapse: collapse;
        }
        table,tr,td,th{
            background-color:#fff;
            color: #2A2B3D;
        }

        th{
            padding: 10px 0;
            text-transform: capitalize;
            font-size: 1.5rem;
        }

        td{
            font-size: 1.3rem;
            padding: 5px 0;
            font-weight: 500;
        }
        img{
            margin:auto;
        }
    </style>
</head>
<body>
    <?php 
    $order_id = $_GET['id'];
    require '../menu.php';
    require '../connect.php';

    $sql ="select
    order_code
    from orders
    join order_product on order_product.order_id = orders.id
    where order_id = '$order_id' ";
    $codes = mysqli_query($connect , $sql);
    $code = mysqli_fetch_array($codes);
    
    $sql ="select
    *
    from order_product
    join products on products.id = order_product.product_id 
    where order_id = '$order_id' ";
    $result = mysqli_query($connect , $sql);
    $sum = 0;
    ?>
    <div class="right">  
        <div class="wrapper">
            <h1>Chi tiết đơn hàng</h1>
            <table border="1" width="100%" >
                <tr>
                    <th>mã đơn hàng</th>
                    <th>ảnh</th>
                    <th>tên sản phẩm</th>
                    <th>giá</th>
                    <th>số lượng </th>
                    <th>tổng tiền</th>    
                </tr>

                <?php foreach ($result as  $each):  ?>
                <tr>
                    <td><?php echo $code['order_code']; ?></td>
                    <td><img height='100' src="../products/photos/<?php echo $each['photo'] ?>"> </td>
                    <td><?php echo $each['name']?></td>
                    <td><?php echo number_format($each['price'],0,"",".")?><sup>&#8363</sup></td>
                    <td><?php echo $each['quantity']?></td>
                    <td>
                        <?php
                            $result = $each['price'] * $each['quantity'];
                            echo number_format($result,0,"",".");
                            $sum += $result;
                        ?>
                        <sup>&#8363</sup>
                    </td>
                </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>
</body>
</html>