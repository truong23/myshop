<?php
 require '../check_admin_login.php' ;
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add product</title>
    <link rel="icon" href="../../img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../Css/form.css">
</head>
<body>
<?php  require '../menu.php' ;
        require '../connect.php';
    $sql = "select * from category ";
    $result = mysqli_query($connect,$sql);
?>
    <div class="right">
        <div class="wrapper">
            <h1>Thêm sản phẩm</h1>
            <form action="process_insert.php" autocomplete="off" method="POST" class="form" id="register-form" style="border-radius: 8px" enctype="multipart/form-data">
                <div class="form-group valid">
                    <label for="name" class="form-label">Tên sản phẩm</label>
                    <input id="name" name="name" type="text" placeholder="Mời nhập tên sản phẩm" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="avatar" class="form-label">Ảnh</label>
                    <div class="avatar-wrapper" >
                        <input id="avatar" name="photo" hidden type="file" class="form-control" onchange="chooseFile(this)" >
                        <label for="avatar" class="input-label">
                            <i class="fas fa-cloud-upload-alt icon-upload"></i>
                        </label>                    
                    </div>
                </div>   
                
                <div class="form-group">
                    <img src="" width='100' id="image">     
                </div>  

                <div class="form-group valid">
                    <label for="price" class="form-label">Giá sản phẩm</label>
                    <input id="price" name="price" placeholder="Mời nhập giá sản phẩm" type="number" class="form-control" required>
                </div>

                <div class="form-group valid">
                    <label for="price_old" class="form-label" >Giá sản phẩm chưa khuyến mãi</label>
                    <input id="price_old" name="price_old" placeholder="Mời nhập giá sản phẩm cũ (Có thể bỏ qua)" type="number" class="form-control">
                </div>

                <div class="form-group valid">
                    <label for="screen_size" class="form-label" required>Kích cỡ màn hình</label>
                    <input id="screen_size" name="screen_size" placeholder="Mời nhập kích cỡ màn hình" type="text" class="form-control" required>
                </div>

                <div class="form-group valid">
                    <label for="screen_quality" class="form-label" >Độ phân giải màn hình</label>
                    <input id="screen_quality" name="screen_quality" placeholder="Mời nhập độ phân giải màn hình" type="text" class="form-control" required>
                </div>

                <div class="form-group valid">
                    <label for="inventory" class="form-label" >Số lượng sản phẩm trong kho</label>
                    <input id="inventory" name="inventory" placeholder="Mời nhập số lượng trong kho" type="number" class="form-control" required>
                </div>

                <div class="form-group">
                <label for="category_id" class="form-label">Nhà sản xuất</label>
                <select id="category_id" name="category_id" class="form-control">
                    <?php foreach($result as $each):?>
                        <option value="<?php echo $each['id']?>">
                            <?php echo $each['name']?>
                        </option>
                    <?php endforeach?>
                </select>
                </div>

                <div class="form-group valid">
                    <label for="description" class="form-label">Mô tả</label>
                    <textarea name="description" id="description" rows="7"></textarea>
                </div>


                <button class="form-submit" name="create">
                    Thêm sản phẩm
                </button>
            </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function chooseFile(fileInput){
            if(fileInput.files && fileInput.files[0]){
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#image').attr('src', e.target.result);
                }
                reader.readAsDataURL(fileInput.files[0]);   
            }
        }
    </script>
</body>
</html>