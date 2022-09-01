<?php
 require '../check_admin_login.php' ;
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add banner</title>
    <link rel="icon" href="../../img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../Css/form.css">
</head>
<body>
<?php  
    include '../menu.php' ;
?>
    <div class="right">
        <div class="wrapper">
            <h1>Thêm ảnh quảng cáo</h1>
            <form action="process_insert.php" autocomplete="off" method="POST" class="form" id="register-form" style="border-radius: 8px" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="avatar" class="form-label">Ảnh</label>
                    <div class="avatar-wrapper">
                        <input id="avatar" name="photo" hidden type="file" class="form-control" onchange="chooseFile(this)" >
                        <label for="avatar" class="input-label">
                            <i class="fas fa-cloud-upload-alt icon-upload"></i>
                        </label>
                    </div>
                </div>     

                <div class="form-group">
                    <img src=""  heigh='30' id="image">     
                </div>  

                <button class="form-submit">
                    Thêm ảnh bìa
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