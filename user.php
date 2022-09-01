<?php  
session_start();
if(empty($_SESSION['id'])){
    header('location:signin.php?error=Đăng nhập đi bạn');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./Css/user.css">
    <script src="./Javacript/validator.js"></script>
</head>
<body>
    <?php 
    include './process/header.php' ;
    require 'admin/connect.php';
    $id = $_SESSION['id'];
    $sql = "select * from customers
    where id = $id";
    $result = mysqli_query($connect,$sql);
    $each = mysqli_fetch_array($result);
    $date = '';
    if(isset($each['birth_day'])){
        $getDate = date_create($each['birth_day']);
        $date = date_format($getDate,"d / m / Y");
    }
    ?>
    <div class="user">
        <div class="user_left">
            <ul class="user_nav">
                <li>
                    <i class="material-symbols-outlined material-icons" >
                        account_circle
                    </i>
                    <span>Thông tin cá nhân</span>
                </li>
                <li>
                    <i class="material-symbols-outlined material-icons" >
                        medical_information
                    </i>
                    <span>Cập nhật tài khoản</span>
                </li>
                <li>
                    <i class="material-symbols-outlined material-icons" >
                        lock
                    </i>
                    <span>Đổi mật khẩu</span>
                </li>
                <li>
                    <a href="signout.php">
                        <i class="material-symbols-outlined material-icons" >
                            logout
                        </i>
                        <span>Đăng xuất</span>
                    </a>
                </li>
            </ul>
            <ul class="user_footer">
                <li><a href="#">Quyền riêng tư</a></li>
                <li><a href="#">Điều khoản</a></li>
                <li><a href="#">Trợ giúp</a></li>
                <li><a href="#">Giới thiệu</a></li>
            </ul>
        </div>
        <div class="user_right">
            <div class="user_info">
                <h1>Thông tin cá nhân</h1>
                <p>Thông tin về bạn và các lựa chọn ưu tiên của bạn trên các dịch vụ của chúng tôi </p>
                <div class="info_item">
                    <h2>Thông tin cơ bản</h2>
                    <p>Một số thông tin có thể hiển thị cho những người khác đang sử dụng dịch vụ của chúng tôi</p>
                    <div class="info_wrap other_text">
                        <h3>Ảnh</h3>
                        <p>Một bức ảnh giúp cá nhân hóa tài khoản của bạn</p>
                        <img onerror="this.src='./img/avatar_null.jpg'"  src="img/<?php echo $each['avatar'] ?>" class="avatar">                 
                    </div>
                    <div class="info_wrap">
                        <h3>Tên</h3>
                        <p><?php echo $each['name'] ?></p>
                    </div>
                    <div class="info_wrap">
                        <h3>Ngày sinh</h3>
                        <p><?php echo $date ; ?></p>
                    </div>
                    <div class="info_wrap">
                        <h3>Giới tính</h3>
                        <p><?php echo $each['gender'] ?></p>
                    </div>
                </div>
                <div class="info_item">
                    <h2>Thông tin liên hệ</h2>
                    <div class="info_wrap">
                        <h3>Email</h3>
                        <p><?php echo $each['email'] ?></p>
                    </div>
                    <div class="info_wrap">
                        <h3>Điện thoại</h3>
                        <p>0<?php echo number_format($each['phone_number'],0,""," ") ?></p>
                    </div>
                    <div class="info_wrap">
                        <h3>Điạ chỉ</h3>
                        <p><?php echo $each['address'] ?></p>
                    </div>
                </div>
            </div>
            <ul class="user_footer--tablet">
                <li><a href="#">Quyền riêng tư</a></li>
                <li><a href="#">Điều khoản</a></li>
                <li><a href="#">Trợ giúp</a></li>
                <li><a href="#">Giới thiệu</a></li>
            </ul>
            <?php include './process/scroll_top.php' ?>
        </div>
        <div class="user_right">
            <div class="update_info">
                <h1>Thay đổi thông tin cá nhân</h1>
                <p>Thay đổi thông tin về bạn trên dịch vụ của chúng tôi </p>
                <div class="update_item">
                    <h2>Cập nhật thông tin</h2>
                    <form action="./process/process_update_user.php" autocomplete="off" method="POST" class="form" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $each['id'] ?>">

                        <label for="avatar" class="form-group">
                            <h3 class="form-label">Ảnh</h3>
                            <p>Một bức ảnh giúp cá nhân hóa tài khoản của bạn</p>
                            <div class="avatar-wrapper" >
                                <img onerror="this.src='./img/avatar_null.jpg'" src="img/<?php echo $each['avatar'] ?>" class="avatar" id="image"> 
                                <div class="add-avatar">
                                    <input id="avatar" name="avatar_new" hidden type="file" class="form-control" onchange="chooseFile(this)">
                                    <label for="avatar" class="input-label">
                                        <!-- <i class="fas fa-cloud-upload-alt icon-upload"></i> -->
                                        <i class="fa-solid fa-camera icon-upload"></i>
                                    </label>
                                </div>
                                <input type="hidden" name="avatar_old" value="<?php echo $each['avatar'] ?>">
                            </div>                
                        </label>

                        <label class="form-group valid" for="name">
                            <h3  class="form-label">Tên</h3>
                            <input id="name" name="name" type="text" class="form-control" value="<?php echo $each['name'] ?>" required>
                        </label>

                        <label class="form-group valid" for="email">
                            <h3  class="form-label">Email</h3>
                            <input id="email" name="email" type="email" class="form-control" value="<?php echo $each['email'] ?>" required>
                        </label>

                        <label class="form-group valid" for="phone_number">
                            <h3  class="form-label">Điện thoại</h3>
                            <input id="phone_number" name="phone_number" type="text" class="form-control" value="<?php echo $each['phone_number'] ?>" required>
                        </label>

                        <label class="form-group valid" for="address">
                            <h3  class="form-label">Địa chỉ</h3>
                            <input id="address" name="address" type="text" class="form-control" value="<?php echo $each['address'] ?>" required>
                        </label>

                        <div class="form-group valid">
                            <label for="gender" class="form-label">Giới tính</label>
                            <div class="sex">
                                <div class="sex-group male-wrapper">
                                    <input name="gender" id="male" type="radio" value="Nam" hidden class="form-control" 
                                    <?php if ($each['gender'] == 'Nam') { ?>checked<?php } ?>>
                                    <label for="male" class="gender gender-male">
                                        <i class="fa-solid fa-circle"></i>
                                    </label>
                                    <label for="male" class="sex-text">Nam</label>
                                </div>
                                <div class="sex-group female-wrapper">
                                    <input name="gender" rules="required" id="female" type="radio" value="Nữ" hidden class="form-control"
                                    <?php if ($each['gender'] =='Nữ') {?>checked<?php }?>>
                                    <label for="female" class="gender gender-female">
                                        <i class="fa-solid fa-circle"></i>
                                    </label>
                                    <label for="female" class="sex-text">Nữ</label>
                                </div>
                            </div>
                        </div>

                        <label class="form-group valid" for="birth_day">
                            <h3  class="form-label">Ngày sinh</h3>
                            <input id="birth_day" name="birth_day" type="date" class="form-control" value="<?php echo $each['birth_day']; ?>" required>
                        </label>

                        <button class="form-submit">
                            Cập nhật thông tin
                        </button>

                    </form>
                </div>
            </div> 
            <ul class="user_footer--tablet">
                <li><a href="#">Quyền riêng tư</a></li>
                <li><a href="#">Điều khoản</a></li>
                <li><a href="#">Trợ giúp</a></li>
                <li><a href="#">Giới thiệu</a></li>
            </ul>
            <?php include './process/scroll_top.php' ?>           
        </div>
        <div class="user_right">
            <div class="update_info">
                <h1>Thay đổi mật khẩu </h1>
                <p>Thay đổi mật khẩu của bạn trên dịch vụ của chúng tôi </p>
                <div class="update_item">
                    <h2>Đổi mật khẩu</h2>
                    <p class="error">
                        <?php if(isset($_SESSION['errorpw'])){
                        echo $_SESSION['errorpw'];
                        unset($_SESSION['errorpw']); //
                        } ?>
                    </p>
                    <form action="./process/change_password_user.php" autocomplete="off" method="POST" class="form" id="register-form">
                        <input type="hidden" name="id" value="<?php echo $each['id'] ?>">

                        <label class="form-group valid" for="current_password">
                            <h3  class="form-label">Mật khẩu hiện tại</h3>
                            <input id="current_password" name="current_password" type="password" class="form-control" rules="required|min:6">
                            <span class="form-message"></span>
                        </label>

                        <label class="form-group valid" for="password">
                            <h3  class="form-label">Mật khẩu mới</h3>
                            <input id="password" name="new_password" type="password" class="form-control" rules="required|min:6|match">
                            <span class="form-message"></span>
                        </label>

                        <label class="form-group valid" for="password-confirmation">
                            <h3  class="form-label">Nhập lại mật khẩu mới</h3>
                            <input  name="password-confirm" type="password" id="password-confirmation" class="form-control" rules="required|confirm">
                            <span class="form-message"></span>
                        </label>                    

                        <button class="form-submit">
                            Đổi mật khẩu
                        </button>

                    </form>
                </div>
            </div>     
            <ul class="user_footer--tablet">
                <li><a href="#">Quyền riêng tư</a></li>
                <li><a href="#">Điều khoản</a></li>
                <li><a href="#">Trợ giúp</a></li>
                <li><a href="#">Giới thiệu</a></li>
            </ul>
        </div>
    </div>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="./Javacript/handleClick.js" ></script>
    <script>
        // window.addEventListener("load", function(){
            const registerForm =  new Validator("#register-form");      
        // })
        let menuHeight = document.querySelector('.wrapper').offsetHeight;
        let navBarHeight = document.querySelector('.user_left')
        navBarHeight.style.top = menuHeight + 'px';
        window.onresize = function() { 
            menuHeight = document.querySelector('.wrapper').offsetHeight;
            navBarHeight.style.top = menuHeight + 'px';
        }
    </script>
</body>
</html>