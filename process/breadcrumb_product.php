<style>
ul.breadcrumb {
  padding: 10px 50px;
  list-style: none;
  background-color: #fff;
  box-shadow: 0 2px 12px rgb(0 0 0 / 12%)
}
ul.breadcrumb li {
  display: inline;
  font-size: 14px;
  color: #333;
}

ul.breadcrumb li+li:before {
  padding: 8px;
  color: #666;
  content: "/\00a0"
}
ul.breadcrumb li a {
  color: #0275d8;
  text-decoration: none;
}
@media screen and (max-width:460px){
  ul.breadcrumb{
    padding: 10px;
  }
  ul.breadcrumb li{
    font-size: 10px;
    overflow: hidden;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 1;
  }
}
</style>
<?php 
     $id = $_GET['id'];
     require 'admin/connect.php';
     $sql = "select * from products
     join category on category.id = category_id 
     where products.id = '$id'";
     $result = mysqli_query($connect, $sql);
     $each = mysqli_fetch_array($result);

     $sql1 = "select * from products where id = $id";
     $products = mysqli_query($connect,$sql1);
     $product = mysqli_fetch_array($products);
     
?>
<ul class="breadcrumb">
  <li>
    <a href="index.php">
      Trang chủ 
    </a>
  </li>
  <li>
    <a href="index.php?product=<?php echo $each['id']; ?>&#breadcrumb">Điện thoại <?php echo $each['name']; ?></a>
  </li>
  <li>
    <?php echo $product['name']; ?>
  </li>
</ul>