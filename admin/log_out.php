<?php

session_start();
unset($_SESSION['id_ad']);
unset($_SESSION['name_ad']);
unset($_SESSION['level']);
header('location:index.php');