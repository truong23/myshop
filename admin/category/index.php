<?php
 require '../check_admin_login.php' ;
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>category</title>
    <link rel="icon" href="../../img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="../Css/category.css">
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

          $sql_number_category = "select count(*) from category where name like '%$find%'";

          $arr_number_categories = mysqli_query($connect, $sql_number_category);
          $result_number_category = mysqli_fetch_array($arr_number_categories);
          $number_categories = $result_number_category['count(*)'];

          $number_in_page = 5;
          $number_page = ceil($number_categories / $number_in_page);
          $skip = $number_in_page * ($page - 1);

          $sql = " select * from category
          where name like '%$find%'
          limit $number_in_page offset $skip";
          $result = mysqli_query($connect, $sql);
     ?>

     <div class="right">
          <div class="categories">
               <h1>Danh sách danh mục </h1>
               <div class="categories_wrap">
                    <a href="form_insert.php">
                         <i class="material-symbols-outlined">
                         add_circle
                         </i>
                         <span>Thêm danh mục</span> 
                    </a>
                    <form class="categories__search">
                         <input type="text" class="input-search" placeholder="Nhập tên chuyên mục..."  name="find" autocomplete="off" maxlength="100">
                         <button type="submit" class="search-btn">
                         <i class="material-symbols-outlined material-icons">
                              search
                         </i>
                         </button>
                    </form>
               </div>
          <?php if($number_categories == 0 ) { ?>
               <p class="categories--empty">
                    Không tìm thấy nhà cung cấp cho từ khoá '<strong><?php echo $_GET['find']?></strong>'
               </p>
          <?php } 
           else { ?>
               <table border="1" id="categories">
                    <tr>
                         <th>mã</th>
                         <th>tên danh mục</th>
                         <th>Ảnh</th>
                         <th>Hành động</th>                  
                    </tr>
                    <?php foreach($result as $each): ?>
                    <tr>
                         <td><?php echo $each['id']?></td>
                         <td><?php echo $each['name']?></td>
                         <td>
                              <img width='200' src="<?php echo $each["photo"]?>">
                         </td>
                         <td>
                              <a href="form_update.php?id=<?php echo $each['id']?>" class="categories_update">Sửa</a>
                              <a href="delete.php?id=<?php echo $each['id']?> " class="categories_delete">xóa</a>
                         </td>
                    </tr>
                    <?php endforeach?>
               </table>

               <?php if($number_page != 1) { ?>
                    <ul class="pagination">
                         <?php for($i = 1; $i <= $number_page; $i++ ){?>
                         <li class="pagination-item">
                         <?php if($i == $page){ ?>  
                              <a href="?page=<?php echo $i; ?>&find=<?php echo $find; ?>&#categories" class="pagination-item__link active">
                                   <?php echo $i ?>
                              </a>
                         <?php } else {?>
                              <a href="?page=<?php echo $i; ?>&find=<?php echo $find; ?>&#categories" class="pagination-item__link">
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