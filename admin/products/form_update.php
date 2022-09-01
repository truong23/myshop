<?php
 require '../check_admin_login.php' ;
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update product</title>
    <link rel="icon" href="../../img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../Css/form.css">
</head>
<body>
<?php 
	$id = $_GET['id'];
	require '../menu.php';
	require '../connect.php';
	$sql = "select * from products where id = '$id'";
	$result = mysqli_query($connect,$sql);
	$each = mysqli_fetch_array($result);

	$sql = "select * from category";
	$categories = mysqli_query($connect,$sql);
?>
     <div class="right">
          <div class="wrapper">
               <h1>Sửa sản phẩm</h1>
               <form action="process_update.php" autocomplete="off" method="post" class="form" id="register-form" style="border-radius: 8px" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $each['id'] ?>">

                    <div class="form-group valid">
                         <label for="name" class="form-label">Tên sản phẩm</label>
                         <input id="name" name="name" type="text" class="form-control" value="<?php echo $each['name'] ?>" required>
                    </div>

                    <div class="form-group">
                         <label for="photo_new" class="form-label">Đổi ảnh</label>
                         <div class="avatar-wrapper">
                              <input id="photo_new" name="photo_new" hidden type="file" class="form-control" onchange="chooseFile(this)" >
                              <label for="photo_new" class="input-label">
                                   <i class="fas fa-cloud-upload-alt icon-upload"></i>
                              </label>                    
                         </div>
                    </div>  
                    
                    <div class="form-group">
                         <img src="photos/<?php echo $each['photo'] ?>" width='100' id="image">
                         <input type="hidden" name="photo_old" value="<?php echo $each['photo'] ?>">
                    </div>                   

                    <div class="form-group valid">
                         <label for="price" class="form-label">Giá sản phẩm giảm giá</label>
                         <input id="price" name="price" type="number" class="form-control" required value="<?php echo $each['price'] ?>">
                    </div>

                    <div class="form-group valid">
                         <label for="price_old" class="form-label">Giá gốc</label>
                         <input id="price_old" name="price_old" type="number" class="form-control" required value="<?php echo $each['price_old'] ?>">
                    </div>

                    <div class="form-group valid">
                         <label for="screen_size" class="form-label">Kích cỡ màn hình</label>
                         <input id="screen_size" name="screen_size" type="text" class="form-control" required value="<?php echo $each['screen_size'] ?>">
                    </div>

                    <div class="form-group valid">
                         <label for="screen_quality" class="form-label">Độ phân giải màn hình</label>
                         <input id="screen_quality" name="screen_quality" type="text" class="form-control" required value="<?php echo $each['screen_quality'] ?>">
                    </div>

                    <div class="form-group valid">
                         <label for="inventory" class="form-label">Tồn kho</label>
                         <input id="inventory" name="inventory" type="number" class="form-control" required value="<?php echo $each['inventory'] ?>">
                    </div>


                    <div class="form-group">
                    <label for="category_id" class="form-label">Tên danh mục</label>
                    <select id="category_id" name="category_id" class="form-control">
                         <?php foreach($categories as $category):?>
                              <option value="<?php echo $category['id']?>"
                              <?php if($each['category_id'] == $category['id']){ ?>
                                   selected 
                              <?php } ?>
                              >
                              <?php echo $category['name']?>
                              </option>
                         <?php endforeach?>
                    </select>
                    </div>

                    <div class="form-group valid">
                         <label for="description" class="form-label">Mô tả</label>
                         <textarea name="description" id="description" rows="7"><?php echo $each['description'] ?></textarea>
                    </div>

                    <button class="form-submit">
                         Sửa sản phẩm
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