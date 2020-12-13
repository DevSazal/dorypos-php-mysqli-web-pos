<?php
session_start();    // Starting Session
ob_start();
require 'function.php';
// $_GET['cart']
// $_SESSION[]

 $before= intval($_GET['before']);

//$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();



if(!isset($_SESSION['quantity'])){
  $_SESSION['quantity'] =array();
}

if($before > 1){
  $_SESSION['quantity'][$_GET['cart']]=$before-1;
}


$_SESSION['discount']=0.0;
$_SESSION['discount_round']=0.0;
$_SESSION['final_discount'] = 0.0;
header ('Location: saleproduct2.php?app='.handler().'&token='.token());
exit();


?>
<script>//alert('<?php echo $_SESSION['quantity'][$_GET['cart']];  ?>')</script>
