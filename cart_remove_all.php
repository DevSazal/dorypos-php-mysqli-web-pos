<?php
require 'function.php';
session_start();

//echo $_GET['cartcode'];

if( isset($_SESSION['cart']) ){
  unset($_SESSION['cart']);
}

if( isset($_SESSION['quantity']) ){
  unset($_SESSION['quantity']);
}


header ('Location: saleproduct.php?app='.handler().'&token='.token());
exit();
 ?>
