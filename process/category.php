<?php 
require 'admin/connect.php';
$sql = " select * from category";
$result = mysqli_query($connect, $sql);
?>
<style>
    <?php include './Css/category.css' ?>
</style>
<div class="category" id="category">
   <?php foreach ($result as $each): ?>
        <a href="?product= <?php echo $each['id'] ?>&#breadcrumb">
            <img src="<?php echo $each['photo'] ?>">
        </a> 
    <?php endforeach ?>
</div>