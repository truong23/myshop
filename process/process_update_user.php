<?php
$id = $_POST['id'];
$name = $_POST['name'];

$avatar_new = $_FILES['avatar_new'];
$avatar_old = $_POST['avatar_old'];
if($avatar_new['size'] > 0){
    $folder ='../img/';
    $file_extension = explode('.', $avatar_new['name'])[1];
    $file_name = time() . '.' . $file_extension;
    $path_file = $folder . $file_name;
    
    move_uploaded_file($avatar_new["tmp_name"], $path_file);
    unlink("../img/$avatar_old");
}
else{
    $file_name = $avatar_old;
} 
$email = $_POST['email'];
$phone_number = $_POST['phone_number'];
$address = $_POST['address'];
$gender = $_POST['gender'];
$birth_day = $_POST['birth_day'];
require '../admin/connect.php';
$sql = "update customers
set
name = '$name',
avatar = '$file_name',
email = '$email',
phone_number = '$phone_number',
gender = '$gender',
birth_day = '$birth_day',
address = '$address'  
where id = '$id'";
mysqli_query($connect, $sql);
mysqli_close($connect);
session_start();
$_SESSION['success'] = 'Cập nhật thông tin thành công';
header('location:../user.php');

