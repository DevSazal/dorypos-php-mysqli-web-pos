<?php
require 'function.php';
session_start();

//echo $_GET['cartcode'];

unset($_SESSION['cart'][$_GET['cartcode']]);


header ('Location: saleproduct.php?app='.handler().'&token='.token());
exit();
 ?>
