<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop - Điện thoại chính hãng</title>
    <link rel="icon" href="./img/logo.png" type="image/x-icon" />
</head>
<style>
    /* html{
        scroll-behavior: smooth;
    } */
    body{
        user-select: none !important;
        -moz-user-select: none !important;
        -webkit-touch-callout: none!important;
        -webkit-user-select: none!important;
        -khtml-user-select: none!important;
        -moz-user-select: none!important;
        -ms-user-select: none!important
    }
    .container{
        width: 100%;
    }
</style>
<body>
    <div class="container">
        <?php include './process/header.php' ?>
        <?php include './process/banner.php' ?>  
        <?php include './process/breadcrumb_index.php' ?>     
        <?php include './process/category.php' ?>
        <?php include './process/products.php' ?>
        <?php include './process/footer.php' ?>
        <?php include './process/scroll_top.php' ?>
    </div>
</body>
</html>