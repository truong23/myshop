<?php
 require '../check_super_admin_login.php' ;
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="icon" href="../../img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="../Css/user.css">
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

        $sql_number_customer = "select count(*) from customers where name like '%$find%'";
        $arr_number_customer = mysqli_query($connect, $sql_number_customer);
        $result_number_customer = mysqli_fetch_array($arr_number_customer);
        $number_customers = $result_number_customer['count(*)'];

        $number_in_page = 10;
        $number_page = ceil($number_customers / $number_in_page);
        $skip = $number_in_page * ($page - 1);

        $sql = " select * from customers
        where name like '%$find%'
        limit $number_in_page offset $skip";
        $result = mysqli_query($connect, $sql);
    ?>

    <div class="right">
        <div class="customers">
            <h1>Danh sách người dùng </h1>
            <form class="customers__search">
                <input type="text" class="input-search" placeholder="Tên người dùng..."  name="find" autocomplete="off" maxlength="100">
                <button type="submit" class="search-btn">
                    <i class="material-symbols-outlined material-icons">
                        search
                    </i>
                </button>
            </form>
        <?php if($number_customers == 0 ) { ?>
            <p class="customer--empty">
                Không tìm thấy người dùng cho từ khoá '<strong><?php echo $_GET['find']?></strong>'
            </p>
        <?php } 
        else { ?>
            <table border="1" cellspacing="0" cellpadding="0" id="customers"> 
                <tr>
                    <th>mã</th>
                    <th>tên</th>
                    <th>Giới tính</th>
                    <th>Ngày sinh</th>
                    <th>email</th>
                    <th>Số điện thoại</th>
                    <th>Mật khẩu</th>
                    <th>Địa chỉ</th>
                </tr>
                <?php foreach($result as $each): ?>
                <tr>
                    <td><?php echo $each['id']?></td>
                    <td><?php echo $each['name']?></td>
                    <td><?php echo $each['gender']?></td>
                    <td><?php echo date_format(date_create($each['birth_day']),"d/m/Y")?></td>
                    <td><?php echo $each['email']?></td>
                    <td><?php echo $each['phone_number']?></td>
                    <td><?php echo $each['password']?></td>
                    <td><?php echo $each['address']?></td>                  
                </tr>
                <?php endforeach?>
            </table>
            <?php if($number_page != 1) { ?>
                <ul class="pagination">
                    <?php for($i = 1; $i <= $number_page; $i++ ){?>
                        <li class="pagination-item">
                        <?php if($i == $page){ ?>  
                            <a href="?page=<?php echo $i; ?>&find=<?php echo $find;?>&#customers" class="pagination-item__link active">
                                <?php echo $i ?>
                            </a>
                        <?php } else {?>
                            <a href="?page=<?php echo $i; ?>&find=<?php echo $find; ?>&#customers" class="pagination-item__link">
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