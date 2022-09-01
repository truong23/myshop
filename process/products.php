<?php 
require 'admin/connect.php';
$page = 1;

$find = '';

if(isset($_GET['page'])){
    $page = $_GET['page'];
}

if(isset($_GET['find'])){
    $find = $_GET['find'];
}

$sql_number_product = "select count(*) from products where name like '%$find%'";
if(isset($_GET['product'])){
    $product_sort = $_GET['product'];
    $sql_number_product = " select count(*) from products 
    where category_id = $product_sort
    ";
  }

$arr_number_product = mysqli_query($connect, $sql_number_product);
$result_number_product = mysqli_fetch_array($arr_number_product);
$number_products = $result_number_product['count(*)'];

$number_in_page = 20;
$number_page = ceil($number_products / $number_in_page);
$skip = $number_in_page * ($page - 1);

$sql = " select * from products
where name like '%$find%'
limit $number_in_page offset $skip";

if(isset($_GET['product'])){
  $product_sort = $_GET['product'];
  $sql = " select * from products 
  where category_id = $product_sort
  limit $number_in_page offset $skip
  ";
}
$result = mysqli_query($connect, $sql);
?>
<style>
    <?php include './Css/products.css';?>
</style>


<div class="product" id="product">
    <?php if($number_products == 0 ) { ?>
        <p class="product--empty">
            Không tìm thấy sản phẩm cho từ khoá '<strong><?php echo $_GET['find']?></strong>'
        </p>
    <?php } 
    else { ?>
    <?php foreach ($result as $each): ?>
    <div class="product__item" id="">
        <a href="product.php?id=<?php echo $each['id'] ?>" class="product__link" >
            <img src="admin/products/photos/<?php echo $each['photo'] ?>" class="product__img">
            <p class="product__name">
                <?php echo $each['name']?>
            </p> 
        </a>
        <span class="product_size">
            <?php echo $each['screen_size']?>''
        </span>
        <span class="product_quality">
            <?php echo $each['screen_quality']?>
        </span>
        <?php if($each['inventory'] > 0) { ?>

        <?php if($each['price_old'] != $each['price']){  ?>
                <p class="wrap_p">
                    <span class="product__price-old"><?php echo number_format($each['price_old'],0,"",".")?>&#8363</span>
                    <span class= "sale_off">
                        <?php echo (round(($each['price'] / $each['price_old'])*100) - 100) ?>%
                    </span>
                </p>
        <?php }?>
        <span class="product__price"><?php echo number_format($each['price'],0,"",".")?>&#8363</span>

        <?php } else { ?>
            <span class="product__sold-out">Tạm hết hàng</span>
        <?php } ?>
    </div>
    <?php endforeach ?>
    <?php } ?>
</div>


<?php if($number_page != 1) { ?>
<ul class="pagination">
    <?php for($i = 1; $i <= $number_page; $i++ ){?>
        <li class="pagination-item">
        <?php if($i == $page){ ?>  
            <a href="?page=<?php echo $i; ?>&find=<?php echo $find; ?>&#category" class="pagination-item__link active">
                <?php echo $i ?>
            </a>
        <?php } else {?>
            <a href="?page=<?php echo $i; ?>&find=<?php echo $find; ?>&#category" class="pagination-item__link">
                <?php echo $i ?>
            </a>
        <?php }?>
        </li>
    <?php }?>
</ul>
<?php } ?>
