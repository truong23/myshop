<?php  
    require 'admin/connect.php';
    include 'process/show_notify.php';
    $sql = "select * from banner";
    $result = mysqli_query($connect,$sql);
    $each = mysqli_fetch_array($result);
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
        $sql1 = "select avatar,name,address from customers
        where id = $id";
        $information = mysqli_query($connect,$sql1);
        $info = mysqli_fetch_array($information);
    }

?>
<style>
    <?php include './Css/header.css'; ?>
</style>

    <div class="wrapper">
        <!-- Start of slideshow -->
        <div class="slideshow">
            <?php foreach($result as $each): ?>
            <div class="mySlides">
                <a href="">
                    <img src="./admin/banner/images/<?php echo $each["photo"]?>" alt=""></td>
                </a>           
            </div>
            <?php endforeach?>        
            <a class="prev" onclick="plusSlides(-1)">
                <i class="material-icons material-symbols-outlined">
                    arrow_back_ios
                </i>
            </a>
            <a class="next" onclick="plusSlides(1)">
                <i class="material-icons material-symbols-outlined">
                    arrow_forward_ios
                </i>
            </a>           
        </div>
        <!-- End of Slides -->
        <!-- Start of header -->
        <div class="header">
            <div class="header__logo">
                <a href="index.php" class="header__link">
                    <img src="./img/myshop.png" alt="">
                </a>
            </div>

            <div class="header__address" style = "cursor:auto">
                <p>Xem giá, tồn kho tại: <br>
                <span class="address_user">
                    <?php if(isset($_SESSION['id'])){ 
                    echo $info['address']; } else{?>
                    Hồ Chí Minh
                    <?php }?>
                </span>
                </p>
            </div>
            <form class="header__search" action="index.php?#breadcrumb">
                <input type="text" class="input-search" placeholder="Bạn tìm gì..."  name="find" autocomplete="off" maxlength="100">
                <button type="submit" class="search-btn">
                    <i class="material-icons">
                        search
                    </i>
                </button>
            </form>

            <a class="name-order header__order" href="
            <?php if(empty($_SESSION['id'])) { ?>
                    signin.php
                <?php   }  
                else { ?>
                    order_history.php?id=<?php echo $_SESSION['id']; ?>
                <?php } ?>"
            >
                Lịch sử đơn hàng
            </a>

            <a class="header__cart" href="
                <?php if(empty($_SESSION['id'])) { ?>
                    signin.php
                <?php   }  
                else { ?>
                    view_cart.php
                <?php } ?>"
            >
                <i class="material-icons material-symbols-outlined">
                    shopping_cart
                </i>
                <span>Giỏ hàng</span>
            </a>

            <?php if(empty($_SESSION['id'])) { ?>
            <ol class="header__item header__item--unlogin">
                <li>
                    <a href="signin.php">Đăng nhập</a>
                </li>
                <li>
                    <a href="signup.php">Đăng ký</a>
                </li>
            <?php   }  
            else { ?>
            <ol class="header__item header__item--login">
                <a href="user.php">
                    <li class="header__navbar-user">
                        <img onerror="this.src='img/avatar_null.jpg'"  src="img/<?php echo $info['avatar'] ?>" class="header__navbar-user-img">
                        <span class="header__navbar-user-name"><?php echo $info['name'] ?></span>

                        <ul class="header__navbar-user-menu">
                            <li class="header__navbar-user-item">
                                <a href="user.php">Tài khoản của tôi</a>
                            </li>
                            <li class="header__navbar-user-item">
                                <a href="">Hỗ trợ</a>
                            </li>
                            <li class="header__navbar-user-item">
                                <a href="">Góp ý - phản hồi</a>
                            </li>
                            <li class="header__navbar-user-item header__navbar-user-item--separate ">
                                <a href="signout.php">Đăng xuất</a>
                            </li>
                        </ul>
                    </li>
                </a>
            <?php } ?>
            </ol>  
        </div> 
        <!-- End Header -->
           
        <div class="header--mobile">
            <div class="header__logo--mobile">
                <a href="index.php" class="header__link--mobile">
                    <img src="./img/myshop_mobile.png" alt="">
                </a>
            </div>
            <div class="header__address--mobile">
                <i class="material-icons">
                    location_on
                </i>
                <span class="address_user"class="address_user">
                    <?php if(isset($_SESSION['id'])){ 
                    echo $info['address']; } else{?>
                    Hồ Chí Minh
                    <?php }?>
                </span>
            </div>
            <a class="name-order header__order--mobile" href="
            <?php if(empty($_SESSION['id'])) { ?>
                    signin.php
                <?php   }  
                else { ?>
                    order_history.php?id=<?php echo $_SESSION['id']; ?>
                <?php } ?>"
            >
                Lịch sử đơn hàng
            </a>
            <a class="header__cart--mobile" href="
                <?php if(empty($_SESSION['id'])) { ?>
                    signin.php
                <?php   }  
                else { ?>
                    view_cart.php
                <?php } ?>"
            >
            <i class="material-icons material-symbols-outlined">
                shopping_cart
            </i>
            <span>Giỏ hàng</span>
            </a>
            
            <?php if(empty($_SESSION['id'])) { ?>
            <ol class="header__item header__item--unlogin">
                <li>
                    <a href="signin.php">Đăng nhập</a>
                </li>
                <li>
                    <a href="signup.php">Đăng ký</a>
                </li>
            <?php   }  
            else { ?>
            <ol class="header__item header__item--login">
                <a href="user.php">
                    <li class="header__navbar-user">
                        <img onerror="this.src='img/avatar_null.jpg'"  src="img/<?php echo $info['avatar'] ?>" class="header__navbar-user-img">
                        <span class="header__navbar-user-name"><?php echo $info['name'] ?></span>

                        <ul class="header__navbar-user-menu">
                            <li class="header__navbar-user-item">
                                <a href="user.php">Tài khoản của tôi</a>
                            </li>
                            <li class="header__navbar-user-item">
                                <a href="">Hỗ trợ</a>
                            </li>
                            <li class="header__navbar-user-item">
                                <a href="">Góp ý - phản hồi</a>
                            </li>
                            <li id="logout" class="header__navbar-user-item header__navbar-user-item--separate ">
                                <a href="signout.php">Đăng xuất</a>
                            </li>
                        </ul>
                    </li>
                </a>
            <?php } ?>
            </ol>  
        </div>
        <div class="find--mobile">
            <form class="header__search--mobile" action="index.php?#breadcrumb">
                <input type="text" class="input-search" placeholder="Bạn tìm gì..."  name="find" autocomplete="off" maxlength="100">
                <button type="submit" class="search-btn--mobile">
                    <i class="material-icons">
                        search
                    </i>
                </button>
            </form>
        </div>
    </div>
    <script src="./Javacript/showSlides.js"></script>
    <?php if(isset($_SESSION['id'])) { ?>
    <script>
        document.querySelector('.header__navbar-user-menu li:last-child').onclick = function(){
        localStorage.removeItem('tab')
        }
    </script>
    <?php } ?>