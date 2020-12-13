<?php
require 'function.php';
session_start();

//echo $_GET['cartcode'];

unset($_SESSION['cart'][$_GET['cartcode']]);

if(isset($_SESSION['quantity']) && isset($_SESSION['quantity'][$_GET['cartcode']])){
  unset($_SESSION['quantity'][$_GET['cartcode']]);
}


header ('Location: saleproduct2.php?app='.handler().'&token='.token());
exit();
 ?>
