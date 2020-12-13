<!DOCTYPE HTML>
<html lang="en-US" ng-app>
<?php
	  session_start();    // Starting Session
	  ob_start(); 
			$error='';         // Variable To Store Error Message
			$shop_cash=0.00;
      require 'function.php';

      $db = connector_db();

      if (!isset($_SESSION['dorypos_admin']) || !(isset($_COOKIE['user_log'])) ) {

      header ("Location: index.php");
      exit();

    }
 ?>
<head>
	<meta charset="UTF-8">
	<title></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="keywords" content="hand watch, hand watch in bangladesh" />
	<meta name="description" content="we are selling the best quality products and we export all over bangladesh.. " />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	
	<title>DoryPOS - A Crony Of Point Of Sale</title>
	
	<!-- Stylesheets -->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" media="all" />
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-theme.css" media="all" />	
	<link rel="stylesheet" type="text/css" href="assets/css/normalize.css" media="all" />
	<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css" media="all" />
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular&subset=Latin,Cyrillic"
	
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
	
	<link href='http://fonts.googleapis.com/css?family=Lato:400,400italic,700' rel='stylesheet' type='text/css'>
	
	
	<!-- [if lt ie 9]> <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif] -->


						
<style type="text/css">
   h2, h4{
   	color: #333;
   }
  .total{
  	color: #8e44ad;
  	font-size: 22px;
  	text-align: left;
	
	font-weight: 700;
  }
  .add{
  	padding: 9px 50px;
    background: #e74c3c;
    color: #fff;
    border-color: #e74c3c;
    outline: none;
  }
  .add:hover{
  	background: #333;
    color: #fff;
    transition: .4s;
    outline: 0;
    border: 1px solid #333;
  }
  .depodit-tnput{
  	width: 70%;
  }
  .total-cash{
  	margin-top: 30px;
  }
  th{
  	text-align: center;
  	color: #e35b3b;
  }
  .table{
   	border: 1px solid grey;
   }

input:invalid + span:after {
    position: absolute;
    content: '✖';
    color: #f00;
    padding-left: 5px;
}

input:valid + span:after {
    position: absolute;
    content: '✓';
    color: #26b72b;
    padding-left: 5px;
}
.cash-table {
    font-weight: bolder;
    font-family: monospace;
}
h5, .h5 {
    font-size: 14px;
    color: #333;
    font-weight: bold;
    font-family: monospace;
	text-align: left;
}
</style>

</head>
<body>
	<div class="main"> 
		<div class="container text-center" style="padding-top:0%;">
		   <h2 style="margin-top: 10px; font-family: fantasy;">Customer Invoice</h2>
		   
		   <div class="total-cash">
			<div class="row">
				<div class="col-sm-6">
					<h4 class="total"><?php if(isset($_POST['select_']) && !empty($_POST['invoice'])  && intval($_POST['invoice']) > 0){
								$invoice=intval($_POST['invoice']);
								echo "Invoice Number #".$invoice;}
								else{
									echo dateinfo();
								} ?></h4>
				</div>
				<div class="col-md-6">
					<form method="post" class="form-inline" style="float: right;">
							<div class="form-group">
								
								<input type="text" id="start" class="form-control" name="invoice" placeholder="Enter An Invoice Number">
								<!-- <span class="validity"></span> -->
							</div>
						<button type="submit" class="btn btn-default add" style="font-size: 12px; font-weight: normal; line-height: 0.7; padding: 11px 12px;" name="select_">Check Invoice</button>
					</form>
				</div>
			</div>


			<div class="cash-table">
		   	<h4></h4>
		   	<table class="table table-striped" style="border: 1px solid #ddd;">
				    <thead>
				      <tr>
				        <th>#Item</th>
				        <th>Barcode</th>
				        <th>Sale Price</th>
						<th>Q</th>
						<th>Price</th>
				      </tr>
				    </thead>
				    <tbody>
						<?php
							$credit = 0.0;
							$debit =0.0;
							$total_price = 0.0;
							if(isset($_POST['select_']) && !empty($_POST['invoice']) && intval($_POST['invoice']) > 0){
								$invoice=intval($_POST['invoice']);
								$sql = "SELECT * FROM dorypos_order WHERE customer_id = $invoice ORDER BY order_id DESC";	
							
							
							$result = mysqli_query($db, $sql);
							if(mysqli_num_rows($result) > 0){
								while($record = mysqli_fetch_assoc($result)){
									$date = $record['date'];
									$query = "SELECT * FROM dorypos_product WHERE row_id={$record['product_id']} LIMIT 1";
									$result2 = mysqli_query($db, $query);
									$record2 = mysqli_fetch_assoc($result2);

								?>
				      <tr>
				        <td><?php echo $record2['name']; ?></td>
				        <td><?php echo $record2['barcode']; ?></td>
				        <td><?php echo sprintf('%.2f', $record2['price'])." BDT"; ?></td>
						<td><?php echo $record['quantity']; ?></td>
						<td><?php $t = $record2['price'] * $record['quantity']; 
						$total_price = $total_price + $t;
						echo sprintf('%.2f', $t)." BDT"; ?></td>
							</tr>
							
							<?php
							} ?> <tr style="
							background-color: #d2cffb;
							font-weight: 600;
							color: #1b4367;"><td>Date: <?php echo $date; ?></td><td></td><td></td><td></td><td><?php echo "".sprintf('%.2f', $total_price)." BDT"; ?></td></tr><?php
							} 
						}
							 ?>
				      
				    </tbody>
				 </table>
		   </div>

			<?php
			

			$extra_cash = $shop_cash;
			$net_sale =0.0;
			$card_payment =0.0;
			$cash_payment =0.0;
			$net_discount =0.0;
			if(isset($_POST['select_']) && !empty($_POST['invoice']) && intval($_POST['invoice']) > 0){
				$invoice=intval($_POST['invoice']);
				$sql = "SELECT * FROM dorypos_sale WHERE customer_id = $invoice ORDER BY sale_id DESC LIMIT 1";	
			
			$result = mysqli_query($db, $sql);
			
						  if(mysqli_num_rows($result) > 0){
							  while($record = mysqli_fetch_assoc($result)){
								

		 ?>

			<div class="row">
				<div class="col-sm-4">
				<h5>Total Price: <?php echo sprintf('%.2f', $record['total_price']); ?> BDT</h5>
				<h5>VAT: 0%</h5>
				<h5>Total Dicount: <?php echo sprintf('%.2f', $record['final_discount']); ?> BDT</h5>
				</div>
				<div class="col-sm-8">
					<h5 style="text-align: center; color: #d2079b; font-family: monospace; font-size: 16px;">Payment Method: <?php if($record['card']==TRUE){
						echo "Credit Card(VISA/MASTER/AMERICAN EXPRESS)";
					}else{
						echo "CASH ON DELIVERY";
					} ?> </h5>
				</div>
				<!-- <div class="col-sm-4">
					<h5 style="text-align: right; color: #d2079b; font-family: cursive;">Cash On Delivery: <?php echo sprintf('%.2f', $cash_payment); ?> BDT</h5>
				</div> -->
			</div>
			<div class="row">
				<div class="col-sm-12">
					<hr>
					<h5 style=" padding-bottom: 10px; ">Total: <?php echo sprintf('%.2f', $record['net_price']); ?> BDT</h5>	
					
				</div>
			</div>

		   </div>
		   <?php 	  }
			} 
		}
			 ?>

		   
		</div>
	 </div>
</body>
</html>