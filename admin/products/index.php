<?php
 require '../check_admin_login.php' ;
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="icon" href="../../img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="../Css/products.css">
</head>
<body>
    <?php   
        include '../menu.php';
        require '../connect.php';
        $page = 1;
        $find = '';
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        if(isset($_GET['find'])){
            $find = $_GET['find'];
        }

        $sql_number_product = "select count(*) from products where name like '%$find%'";
        $arr_number_product = mysqli_query($connect, $sql_number_product);
        $result_number_product = mysqli_fetch_array($arr_number_product);
        $number_products = $result_number_product['count(*)'];

        $number_in_page = 4;
        $number_page = ceil($number_products / $number_in_page);
        $skip = $number_in_page * ($page - 1);

        $sql = "select * from products
        where name like '%$find%'
        limit $number_in_page offset $skip";
        $result = mysqli_query($connect, $sql);
    ?>

    <div class="right">
        <div class="products">
            <h1>Danh sách sản phẩm </h1>
            <div class="products_wrap">
                <a href="form_insert.php">
                    <i class="material-symbols-outlined">
                        add_circle
                    </i>
                    <span>Thêm sản phẩm</span> 
                </a>
                <form class="products__search">
                    <input type="text" class="input-search" placeholder="Mời nhập sản phẩm ..."  name="find" autocomplete="off" maxlength="100">
                    <button type="submit" class="search-btn">
                        <i class="material-symbols-outlined material-icons">
                            search
                        </i>
                    </button>
                </form>
            </div>
        <?php if($number_products == 0 ) { ?>
            <p class="product--empty">
                Không tìm thấy sản phẩm cho từ khoá '<strong><?php echo $_GET['find']?></strong>'
            </p>
        <?php } 
        else { ?>
            <table border="1" cellspacing="0" cellpadding="0" id="products"> 
                <tr>
                <th>mã</th>
                <th>tên </th>
                <th>ảnh </th>
                <th>kích cỡ</th>
                <th>Độ phân giải</th>
                <th>giá </th>
                <th>giá cũ</th>
                <th>Tồn kho</th>
                <th>hành động</th>
                </tr>
                <?php foreach($result as $each): ?>
                <tr>
                    <td><?php echo $each['id']?></td>
                    <td><?php echo $each['name']?></td>
                    <td><img  height="100" src="photos/<?php echo $each["photo"]?>" alt=""></td>
                    <td><?php echo $each['screen_size']?>''</td>
                    <td><?php echo $each['screen_quality']?></td>
                    <td><?php echo number_format($each['price'],0,"",".")?><sup>&#8363</sup></td>
                    <td><?php echo number_format($each['price_old'],0,"",".")?><sup>&#8363</sup></td>
                    <td><?php echo $each['inventory']?></td>
                    <td>
                        <a href="form_update.php?id=<?php echo $each['id'] ?>" class="products_update">Sửa</a>
                        <a href="delete.php?id=<?php echo $each['id'] ?>" class="products_delete">Xóa</a>
                    </td>
                </tr>
                <?php endforeach?>
            </table>
            <?php if($number_page != 1) { ?>
                <ul class="pagination">
                    <?php for($i = 1; $i <= $number_page; $i++ ){?>
                        <li class="pagination-item">
                        <?php if($i == $page){ ?>  
                            <a href="?page=<?php echo $i; ?>&find=<?php echo $find;?>&#products" class="pagination-item__link active">
                                <?php echo $i ?>
                            </a>
                        <?php } else {?>
                            <a href="?page=<?php echo $i; ?>&find=<?php echo $find; ?>&#products" class="pagination-item__link">
                                <?php echo $i ?>
                            </a>
                        <?php }?>
                        </li>
                    <?php }?>
                </ul>
            <?php } ?>  
         <?php } ?>          
        </div>
    </div>
    
        
</body>
</html>