<?php 
$id = $_GET['id'];

require '../admin/connect.php';
$orders = "delete from orders 
where id = '$id'";
$order_product = "delete from order_product
where order_id = '$id'";
mysqli_query($connect,$order_product);
mysqli_query($connect,$orders);
mysqli_close($connect);
session_start();
$_SESSION['success']= "Hủy đơn hàng thành công";
header('location:../order_history.php?id='.$id);