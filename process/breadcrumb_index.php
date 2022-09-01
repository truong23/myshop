<style>
ul.breadcrumb {
  padding: 10px 50px;
  list-style: none;
  transform: translateY(-50px)
}
ul.breadcrumb li {
  display: inline;
  font-size: 20px;
  color: #333;
}

ul.breadcrumb li+li:before {
  padding: 8px;
  color: #666;
  content: "/\00a0";
}
ul.breadcrumb li a {
  color: #0275d8;
  text-decoration: none;
}
@media screen and (max-width:768px) {
  ul.breadcrumb{
  transform: translateY(0px);
  padding: 20px 20px 0;
  }
  ul.breadcrumb li{
    font-size: 16px;
  }
}
@media screen and (max-width:460px){
  ul.breadcrumb{
  transform: translateY(0px);
  padding: 10px 10px 0;
  }
  ul.breadcrumb li{
    font-size: 13px;
  }
}
</style>

<?php if(isset($_GET['product'])) {
  $id =$_GET['product'];
  require 'admin/connect.php';
  $sql = " select name from category where id = $id";
  $result = mysqli_query($connect, $sql);
  $each = mysqli_fetch_array($result)
?>
<ul class="breadcrumb" id="breadcrumb">
  <li>
    <a href="index.php?#category">
      Điện thoại
    </a>
  </li>
  <li>
      Điện thoại <?php echo $each['name'] ?>
  </li>
</ul>
<?php } elseif(isset($_GET['find']) && $_GET['find'] !=""){?>
  <ul class="breadcrumb" id="breadcrumb">
  <li>
    <a href="index.php?#category">
      Điện thoại
    </a>
  </li>
  <li>
      Kết quả tìm kiếm cho: "<?php echo $_GET['find'] ?>"
  </li>
</ul>
<?php } ?>
