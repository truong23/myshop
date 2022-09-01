<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .container {width:100%; height:auto; }
    body{
        -moz-user-select: none !important;
        -webkit-touch-callout: none!important;
        -webkit-user-select: none!important;
        -khtml-user-select: none!important;
        -moz-user-select: none!important;
        -ms-user-select: none!important
    }
    </style>
</head>
<body>
    <div class="container">
    <?php include './process/header.php' ?>
    <?php include './process/breadcrumb_product.php' ?>
    <?php include './process/detail.php' ?>
    <?php include './process/footer.php' ?>
    </div>
</body>
</html>