<?php
session_start();
$id = $_GET['id'];

$status = $_GET['status'];

$permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
function generate_string($input, $strength = 10) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[random_int(0, $input_length - 1)];
        $random_string .= $random_character;
    }
    return $random_string;
}
$shipping_code = 'SPXVN'.generate_string($permitted_chars, 10);
date_default_timezone_set("Asia/Ho_Chi_Minh");
$time_success = date("y-m-d H:i:s");



require '../connect.php';
$sql = "select status from orders 
where id = '$id'";
$rows = mysqli_query($connect ,$sql);
$row =  mysqli_fetch_array($rows);
$current_status = $row['status'];

$sql = "select * from orders 
join customers on customers.id = orders.customer_id
where orders.id = '$id'";
$result = mysqli_query($connect, $sql);
$each = mysqli_fetch_array($result);
$to = $each['email'] ;
$order_code = $each['order_code'] ;
require '../../mail.php';

if($current_status == 0){
    if($status == 1){
        $_SESSION['success'] = "Duyệt đơn hàng thành công";
        $subject = "Đơn hàng $order_code đã đặt hàng thành công";
        $body = "Cảm ơn bạn đã mua hàng. Đơn hàng của bạn sẽ được vận chuyển đến sớm thôi";
        sendmail($to,$subject,$body);
        
        $sql = "update orders 
        set 
        status = $status,
        shipping_code = '$shipping_code',
        time_success = '$time_success'
        where id = '$id'";
        } else {
        $_SESSION['success'] = "HỦy đơn hàng thành công";    
        $subject = "Đơn hàng $order_code đã bị hủy";
        $body = "Đơn hàng của bạn đã bị rơi xuống biển,xin lỗi vì sự bất tiện này";
        sendmail($to,$subject,$body);

        $sql = "update orders 
        set 
        status = $status
        where id = '$id'";
        }
        mysqli_query($connect, $sql);

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

        header('location:index.php');
} else{
    $_SESSION['error'] = "Không thể thao tác lại";
    header('location:index.php');
}




