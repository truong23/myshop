<?php 

$name_receiver = $_POST['name_receiver'];
$phone_receiver = $_POST['phone_receiver'];
$address_receiver = $_POST['address_receiver'];

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

$order_code = generate_string($permitted_chars, 10);
require '../admin/connect.php';
session_start();

$cart = $_SESSION['cart'];

$total_price = 0;
foreach($cart as $each){
	$total_price += $each['quantity'] * $each['price'];
}
$customer_id = $_SESSION['id'];
$status = 0; //mới đặt

$sql = "insert into orders(customer_id,order_code, name_receiver, phone_receiver, address_receiver, status, total_price)
values ('$customer_id', '$order_code','$name_receiver', '$phone_receiver', '$address_receiver', '$status', '$total_price')";
mysqli_query($connect,$sql);

$sql = "select max(id) from orders where customer_id = '$customer_id'";
$result = mysqli_query($connect,$sql);
$order_id = mysqli_fetch_array($result)['max(id)'];

foreach($cart as $product_id => $each){
	$quantity = $each['quantity'];
	$sql = "insert into order_product(order_id ,product_id, quantity)
	values('$order_id', '$product_id', '$quantity')";
	mysqli_query($connect,$sql);

    $sql_inventory = "select inventory from products where id = '$product_id'";
    $rows = mysqli_query($connect,$sql_inventory);
    $row = mysqli_fetch_array($rows);
    $inventory = $row['inventory'];
    $new_inventory = $inventory - $quantity;
    $update = "update products set inventory = '$new_inventory' where id = '$product_id'";
    mysqli_query($connect,$update);
}

mysqli_close($connect);
unset($_SESSION['cart']);
$_SESSION['success'] = "Đặt hàng thành công";
header('location:../index.php');