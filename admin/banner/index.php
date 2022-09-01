<?php
 require '../check_admin_login.php' ;
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banner</title>
    <link rel="icon" href="../../img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="../Css/banner.css">
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

          $sql_number_banner = "select count(*) from banner where id like '%$find%'";

          $arr_number_banner = mysqli_query($connect, $sql_number_banner);
          $result_number_banner = mysqli_fetch_array($arr_number_banner);
          $number_banners = $result_number_banner['count(*)'];

          $number_in_page = 5;
          $number_page = ceil($number_banners / $number_in_page);
          $skip = $number_in_page * ($page - 1);

          $sql = " select * from banner
          where id like '%$find%'
          limit $number_in_page offset $skip";
          $result = mysqli_query($connect, $sql);
     ?>

     <div class="right">
          <div class="banners">
               <h1>Danh sách ảnh quảng cáo </h1>
               <div class="banners_wrap">
                    <a href="form_insert.php">
                         <i class="material-symbols-outlined">
                         add_circle
                         </i>
                         <span>Thêm ảnh </span> 
                    </a>
                    <form class="banners__search">
                         <input type="text" class="input-search" placeholder="Mời nhập id ảnh..."  name="find" autocomplete="off" maxlength="100">
                         <button type="submit" class="search-btn">
                         <i class="material-symbols-outlined material-icons">
                              search
                         </i>
                         </button>
                    </form>
               </div>
          <?php if($number_banners == 0 ) { ?>
               <p class="banners--empty">
                    Không tìm thấy ảnh  cho id: <strong><?php echo $_GET['find']?></strong>
               </p>
          <?php } 
          else { ?>
               <table border=1 width=100%> 
                    <tr>
                    <th>mã</th>
                    <th>ảnh</th>
                    <th>Hành động</th>
                    </tr>
                    
                    <?php foreach($result as $each): ?>
                    <tr>
                         <td><?php echo $each['id']?></td>
                         <td><img  height = '30' src="images/<?php echo $each["photo"]?>" alt=""></td>
                         <td><a href="delete.php?id=<?php echo $each['id'] ?>" class="banners_delete">xóa</a></td>
                    </tr>
                    <?php endforeach?>
               </table>

               <?php if($number_page != 1) { ?>
                    <ul class="pagination">
                         <?php for($i = 1; $i <= $number_page; $i++ ){?>
                         <li class="pagination-item">
                         <?php if($i == $page){ ?>  
                              <a href="?page=<?php echo $i; ?>&find=<?php echo $find; ?>&#banners" class="pagination-item__link active">
                                   <?php echo $i ?>
                              </a>
                         <?php } else {?>
                              <a href="?page=<?php echo $i; ?>&find=<?php echo $find; ?>&#banners" class="pagination-item__link">
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