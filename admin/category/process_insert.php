<?php
 require '../check_admin_login.php' ;

if(($_POST['name']) || empty($_POST['photo'])){
    header('location:form_insert.php?error=phải điền đầy đủ thông tin');
}
$name = $_POST['name'];
$photo = $_POST['photo'];

require '../connect.php';

$sql = " insert into category(name,photo)
 Values('$name','$photo')";
 session_start();
 $_SESSION['success'] = "Thêm thành công";
 mysqli_query($connect, $sql);

 mysqli_close($connect);
 header('location:index.php');




