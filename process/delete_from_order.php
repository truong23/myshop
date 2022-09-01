<?php 
$id = $_GET['id'];

require '../admin/connect.php';
$sql = "select * from order_product
inner join products on products.id = order_product.product_id
where order_id = '$id'";
$result = mysqli_query($connect,$sql);
foreach($result as $each ) {
    $product_id = $each['id'];
    $quantity = $each['quantity'];
    $inventory = $each['inventory'];
    $new_inventory = $inventory + $quantity ;

    $update = "update products set inventory = '$new_inventory' where id = '$product_id'";
    mysqli_query($connect,$update);
}

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