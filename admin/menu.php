<?php
    $idad = $_SESSION['id_ad'];
    include '../show_notify.php';
    require 'connect.php';
    $sql = "select * from admin
    where id = $idad";
    $result = mysqli_query($connect,$sql);
    $each = mysqli_fetch_array($result);
?>
<style>
    <?php include '../Css/menu.css' ?>
</style>
    <div class="left">
        <div class="info">
            <img src="<?php echo $each['img']; ?>">
            <p> 
                <span class="info_name">
                    <?php echo $each['name']; ?>
                </span>
                <br>
                <a href="../log_out.php">
                    Log out                
                </a>
            </p>
        </div>
        <ul class="nav">
            <li onclick="ChangeColor()">
                <a href="../root">
                    <i class="material-symbols-outlined material-icons">
                        home
                    </i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="../products">
                    <i class="material-symbols-outlined material-icons">
                        event_available
                    </i>
                    <span>Products</span>
                </a>
            </li>
            <li>
                <a href="../category">
                    <i class="material-symbols-outlined material-icons">
                        category
                    </i>
                    <span>Category</span>
                </a>
            </li>
            <li>
                <a href="../orders">
                    <i class="material-symbols-outlined material-icons">
                        local_mall
                    </i>
                    <span>Orders</span>
                </a>
            </li>
            <li>
                <a href="../banner">
                    <i class="material-symbols-outlined material-icons">
                        photo_camera_back
                    </i>
                    <span>Banner</span>
                </a>
            </li>
            <li>
                <a href="../user">
                    <i class="material-symbols-outlined material-icons">
                        person
                    </i>
                    <span>User</span>
                </a>
            </li>
        </ul>
    </div>
</body>
</html>