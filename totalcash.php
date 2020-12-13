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
		   <h2 style="margin-top: 10px; font-family: fantasy;">Welcome To Account Section</h2>
		   <div class="total-cash">
			<div class="row">
				<div class="col-sm-6">
					<h4 class="total">Total Cash: <?php echo sprintf('%.2f', cash($db) ); ?> BDT</h4>
				</div>
				<div class="col-md-6">
					<form method="post" class="form-inline" style="float: right;">
							<div class="form-group">
								
								<input type="month" id="start" class="form-control" name="short_month"
									min="2017-01" value="<?php echo date('Y-m'); ?>" />
								<!-- <span class="validity"></span> -->
							</div>
						<button type="submit" class="btn btn-default add" style="font-size: 12px; font-weight: normal; line-height: 0.7; padding: 11px 12px;" name="select_">SELECT</button>
					</form>
				</div>
			</div>

			<?php
			if(isset($_POST['select_']) && !empty($_POST['short_month'])){
				$month=$_POST['short_month'];
				$sql3 = "SELECT * FROM dorypos_ex WHERE date LIKE '$month%' ORDER BY id DESC";	
			}else{
				$sql3 = "SELECT * FROM dorypos_ex ORDER BY id DESC";

			}
			$result3 = mysqli_query($db, $sql3);
			$shop_cash = 0.00;
						  if(mysqli_num_rows($result3) > 0){
							  while($record3 = mysqli_fetch_assoc($result3)){
				if($record3['status']==FALSE){
				  //echo "(+) ";
				  $shop_cash = $shop_cash + floatval($record3['amount']);
				}else{
				  //echo "(-) ";
				  $shop_cash = $shop_cash - floatval($record3['amount']);
				}

			  }
			}

			$extra_cash = $shop_cash;
			$net_sale =0.0;
			$card_payment =0.0;
			$cash_payment =0.0;
			$net_discount =0.0;
			if(isset($_POST['select_']) && !empty($_POST['short_month'])){
				$month=$_POST['short_month'];
				$sql = "SELECT * FROM dorypos_sale WHERE date LIKE '$month%' ORDER BY sale_id DESC";	
			}else{
				$sql = "SELECT * FROM dorypos_sale ORDER BY sale_id DESC";

			}
			$result = mysqli_query($db, $sql);
			
						  if(mysqli_num_rows($result) > 0){
							  while($record = mysqli_fetch_assoc($result)){
				

				  $shop_cash = $shop_cash + floatval($record['net_price']);
				  $net_sale = $net_sale + floatval($record['net_price']);
				  if($record['card']==1){
					  $card_payment= $card_payment + floatval($record['net_price']);
				  }else{
					  $cash_payment= $cash_payment + floatval($record['net_price']);
				  }
				  $net_discount = $net_discount + floatval($record['final_discount']);
				

			  }
			} 
			 ?>

			<div class="row">
				<div class="col-sm-4">
				<h5>Net Product Sales Cash: <?php echo sprintf('%.2f', $net_sale); ?> BDT</h5>
				</div>
				<div class="col-sm-4">
					<h5 style="text-align: center; color: #d2079b; font-family: cursive;">Credit Card: <?php echo sprintf('%.2f', $card_payment); ?> BDT</h5>
				</div>
				<div class="col-sm-4">
					<h5 style="text-align: right; color: #d2079b; font-family: cursive;">Cash On Delivery: <?php echo sprintf('%.2f', $cash_payment); ?> BDT</h5>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<!-- <h5>Total Discount For Sale: <?php echo $net_discount; ?> BDT</h5> -->
					<h5>Management Cash Report: <?php echo sprintf('%.2f', $extra_cash); ?> BDT</h5>	
					<hr>
					<h5 style="/* padding-bottom: 10px; */">Total: <?php echo sprintf('%.2f', $shop_cash); ?> BDT</h5>	
					<h5>Total Discount For Sale: <?php echo sprintf('%.2f', $net_discount); ?> BDT</h5>
				</div>
			</div>
		   	<!-- <h4 class="total">Total Cash: <?php // echo cash($db); ?> BDT</h4> -->
		   </div>
		   <div class="with-depo">
		   	<table class="table" style="border: 1px solid #ddd;">
		   		<tr>
		   			<td>
						 <form method="post">
								<div class="form-group">
									<input type="text" class="form-control" id="email" placeholder="WHY?" name="reason_">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" id="email" placeholder="Deposit (+) BDT" name="amount_">
								</div>
								<button type="submit" class="btn btn-default add" name="credit"><i class="fa fa-plus"></i> Deposit</button>
							</form>
							<?php
						if(isset($_POST['credit'])){
							if(!empty($_POST['reason_']) && !empty($_POST['amount_'])){

								$reason=$_POST['reason_'];
								// to protect injection
								$reason = stripslashes($reason);
								$reason = mysqli_real_escape_string($db, $reason);

								$amount=$_POST['amount_'];
								// to protect injection
								$amount = stripslashes($amount);
								$amount = mysqli_real_escape_string($db, $amount);

								$date=onlydate();
								$sql ="INSERT INTO dorypos_ex (reason,amount,status,date) VALUES('$reason', $amount, FALSE, '$date')";
								mysqli_query($db,$sql);
								echo '<meta http-equiv=Refresh content="0;url=?reload=1">';
								?> <script></script> <?php
							}
						}
						 ?>
		   			</td>
		   			<td>
		   				<form method="post">
								<div class="form-group">
									<input type="text" class="form-control" id="email" placeholder="WHY?" name="reason_">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" id="email" placeholder="Withdraw (-) BDT" name="amount_">
								</div>
								<button type="submit" class="btn btn-default add" name="debit"><i class="fa fa-minus"></i> Withdraw</button>
							</form>
						<?php
						if(isset($_POST['debit'])){
							if(!empty($_POST['reason_']) && !empty($_POST['amount_'])){

								$reason=$_POST['reason_'];
								// to protect injection
								$reason = stripslashes($reason);
								$reason = mysqli_real_escape_string($db, $reason);

								$amount=$_POST['amount_'];
								// to protect injection
								$amount = stripslashes($amount);
								$amount = mysqli_real_escape_string($db, $amount);

								$date=onlydate();
								$sql ="INSERT INTO dorypos_ex (reason,amount,status,date) VALUES('$reason', $amount, TRUE, '$date')";
								mysqli_query($db,$sql);
								echo '<meta http-equiv=Refresh content="0;url=?reload=1">';
								?> <script>//location.reload();</script> <?php
							}
						}
						 ?>
		   			</td>
		   		</tr>
		   	</table>
		   </div>
		   <div class="cash-table">
		   	<h4>Management Report</h4>
		   	<table class="table table-striped">
				    <thead>
				      <tr>
				        <th>#Cause</th>
				        <th>Date</th>
				        <th>Credit/Debit(+/-)</th>
				      </tr>
				    </thead>
				    <tbody>
						<?php
							$credit = 0.0;
							$debit =0.0;
							if(isset($_POST['select_']) && !empty($_POST['short_month'])){
								$month=$_POST['short_month'];
								$sql3 = "SELECT * FROM dorypos_ex WHERE date LIKE '$month%' ORDER BY id DESC";	
							}else{
								$sql3 = "SELECT * FROM dorypos_ex ORDER BY id DESC";

							}
							
							$result3 = mysqli_query($db, $sql3);
							if(mysqli_num_rows($result3) > 0){
								while($record3 = mysqli_fetch_assoc($result3)){
								?>
				      <tr>
				        <td><?php echo $record3['reason']; ?></td>
				        <td><?php echo $record3['date']; ?></td>
				        <td><?php if($record3['status']==FALSE){
									echo "(+) ";
									$shop_cash = $shop_cash + floatval($record3['amount']);
									$credit = $credit + floatval($record3['amount']);
								}else{
									echo "(-) ";
									$shop_cash = $shop_cash - floatval($record3['amount']);
									$debit = $debit + floatval($record3['amount']);
								} echo $record3['amount']." BDT"; ?></td>
							</tr>
							<?php
							} ?> <tr style="
							background-color: #d2cffb;
							font-weight: 600;
							color: #1b4367;"><td>Total</td><td><?php echo "Credit: (+) ".$credit." BDT"; ?></td><td><?php echo "Debit: (-) ".$debit." BDT"; ?></td></tr><?php
							}
							 ?>
				      
				    </tbody>
				 </table>
		   </div>
		</div>
	 </div>
</body>
</html>