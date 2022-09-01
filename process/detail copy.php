<?php 
$id =$_GET['id'];
require 'admin/connect.php';
$sql = " select * from products where id = $id";
$result = mysqli_query($connect, $sql);
$each = mysqli_fetch_array($result)
?>
<style>
<?php include './Css/detail.css'?>
</style>

<div class="detail" >
    <div class="detail_img">
        <img src="admin/products/photos/<?php echo $each['photo']?>">
    </div>
    <div class="detail_item">
        <h1 class="detail_name">Điện thoại <?php echo $each['name'] ?></h1>
        <?php if($each['inventory'] > 0) { ?>
            <span class="detail_price"><?php echo number_format($each['price'],0,"",".")?><sup>&#8363</sup></span>
            <?php if($each['price_old'] != $each['price']){  ?>
                <span class="detail__price-old" ><?php echo number_format($each['price_old'],0,"",".")?><sup>&#8363</sup></span>
            <?php }?>
        <?php } else { ?>
            <span class="product__sold-out">Sản phẩm tạm thời hết</span>
        <?php } ?>
        <p class="detail_description"><?php echo $each['description']?></p>   
        <?php if($each['inventory'] > 0) { ?>
        <div class="detail_buy">
            <a href="
                <?php if(empty($_SESSION['id'])) { ?>
                        signin.php
                <?php   }  
                else { ?>
                       ./process/buy_product.php?id=<?php echo $each['id'] ?>
                <?php } ?>">
                <strong>Mua ngay</strong> <br>
                <span>(Giao tận nơi hoặc lấy tại cửa hàng)</span>
            </a>
            <a href="
                <?php if(empty($_SESSION['id'])) { ?>
                        signin.php
                <?php   }  
                else { ?>
                       ./process/add_to_cart.php?id=<?php echo $each['id'] ?>
                <?php } ?>
            ">
                <i class="material-icons material-symbols-outlined">
                    add_shopping_cart
                </i> 
                <span>Thêm vào giỏ</span>                
            </a>
        </div>
        <?php } ?>
    </div>  
</div>