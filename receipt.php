<?php
session_start();    // Starting Session
ob_start();
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
<?php

$error='';         // Variable To Store Error Message
$total_price=0;
$total_product=0;
$cash_back=NULL;
require 'function.php';

$db = connector_db();


if (!isset($_SESSION['dorypos_admin']) || !(isset($_COOKIE['user_log'])) ) {

header ("Location: index.php?app=".handler()."&token=".token());
exit();

}
?>
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
	.receipt-heading h2,h5{
		color: #333;
	}
	.container{
		/* width: 350px;
		border: 1px solid grey; */
	}
	.text-center {
    text-align: -webkit-center;
	}
	.font td{
		font-size: 12px;
    font-family: serif;

		border-bottom: 1px solid #ddd;
	}
	td{
		border-top: none !important;
	}
	.font1 td{
		border-bottom: none !important;

	}

	.container {
    padding-right: 0px;
    padding-left: 0px;
    margin-right: 0px;
    margin-left: 0px;
}
body {
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    font-size: 10px;
    line-height: .5;
    color: #333;
    
}
.font1 > thead > tr > th, .font1 > tbody > tr > th, .font1 > tfoot > tr > th, .font1 > thead > tr > td, .font1 > tbody > tr > td, .font1 > tfoot > tr > td {
    padding: 1px;
    line-height: .8;
}
h4, .h4, h5, .h5, h6, .h6 {
    margin-top: 5px;
    margin-bottom: 5px;
}
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    padding: 8px;
	line-height: 0.1;
    vertical-align: top;
    
}
</style>
<script>
	function PrintWindow(){ 
		window.print(); 
		CheckWindowState();
	}

function CheckWindowState(){ 
	if(document.readyState=="complete"){
		window.close(); 
	}else{ 
		setTimeout("CheckWindowState()", 2000)
	}
}	

PrintWindow();
</script>	
 <script>
    window.resizeTo(1024,1024);
  </script>
</head>
<body>
      <div class="container text-center">
      	<div class="receipt-heading">
      		<!-- <h2>|||||||||| ||||</h2> -->
      		<h5>Maliha Collection</h5>
			  <p>Faridpur, Dhaka</p>
			  <p>Phone: 017xxxxxx00</p>
			  <p>Invoice Number <label>#<?php if(isset($_SESSION['customer_id'])){echo $_SESSION['customer_id'];} ?></label></p>
      		<p><time datetime="2008-02-14 20:00"><label>Date: </label><?php echo date('Y/m/d'); ?></time></p>
      	</div>
      	<div class="product-list font">
      		<table class="table">
							<thead>
									<tr>
										<th>#Item</th>
										<th>Barcode</th>
										<th>Q</th>
										<th>Price</th>
									</tr>
								</thead>
			    <tbody>
						



					<!-- php script to create dynamic row -->
					<?php

					if (isset($_SESSION['cart'])) {
						end($_SESSION['cart']);         // move the internal pointer to the end of the array
						$key = key($_SESSION['cart']);  // fetches the key of the element pointed to by the internal pointer
						//echo "<script>alert(".$key.")</script>";
						if (count($_SESSION['cart'])>0) {
							# code...
							//echo "<script>alert(".$key.")</script>";

							for ($i=$key; $i >= 0  ; $i--) {
								//if (!isset($_SESSION['cart'][$i]) || empty($_SESSION['cart'][$i]))
								if (isset($_SESSION['cart'][$i]) && !empty($_SESSION['cart'][$i]))
									{
										$value = $_SESSION['cart'][$i];
											//your code here in case of not existing or being empty
									 ?>




															<?php
															$sql= "SELECT * FROM dorypos_product WHERE barcode= '{$value}' ";
															$result = mysqli_query($db,$sql);

																if(mysqli_num_rows($result) > 0){
																		$record = mysqli_fetch_assoc($result);

																		for ($p=0; $p < 1 ; $p++) {
																			# code...
																			//echo $record['name']; ?>
																			<tr>
														 		        
																		 <td><?php echo $record['name']; ?></td>
																		 <td><?php echo $record['barcode']; ?></td>
																		<td><?php
                                                    // $q for product quantity
                                              if(isset($_SESSION['quantity'][$i]) && $_SESSION['quantity'][$i] >1){
                                                $q = $_SESSION['quantity'][$i];
                                              }else {
																								$q = 1;
																								//DevSazal 18-07-2018 error solved
																								$_SESSION['quantity'][$i] = $q;
                                              }
                                               ?>
											<?php echo $q; ?>
														 		        </td>
														 		        <td>
                                          <?php
                                          $price= $q*$record['price'];
                                          echo $price." BDT";
                                          $total_price = $total_price + $price;
                                          $total_product = $total_product +1;
                                          ?>
										</td>
									</tr>
									<?php

																		}

																	}
																	// else {
																	// 	echo "unknown Product";
																	// }

															 ?>



										<?php
									}


							}
						}
					}

					 ?>			      
			    </tbody>
				</table>

				<table class="table font1" style='margin-bottom: 10px;'>
						<thead>
								
							</thead>
				<tbody>	
					<tr>
						<td><label>Total Product:</label> <?php echo $total_product; ?></td>
						<td><label>Total Price = </label> <?php echo $total_price." BDT"; ?></td>
					</tr>
					<tr>
						<td>VAT: <label>0%</label></td>
						
						<td><label>Net Price = </label> <?php
                      $net_price= $total_price+(($total_price/100)*0);
					  echo $net_price." BDT";
					  //
                      $_SESSION['net_price'] = $net_price;
                  ?></td>
					</tr>
					<tr>
						<td><label>Discount: </label> <?php
						 if ($_SESSION['discount'] > 0) {
							 echo $_SESSION['discount']."%";
							 }elseif($_SESSION['discount_round'] > 0){
								echo $_SESSION['discount_round']." BDT";	 
							 }else{
								echo $_SESSION['discount']."%"; 
							 } ?></td>
						<td><label>Net Payable = </label> <?php echo $_SESSION['end_price']." BDT"; ?></td>
					</tr>
					<tr>
						<td></td>
						<td><label>Cash Receive = </label> <?php echo $_SESSION['cash_received']." BDT"; ?></td>
					</tr>
					<tr>
						<td></td>
						<td><label>Cash Back = </label> <?php echo $_SESSION['cash_back']." BDT"; ?></td>
					</tr>
				</tbody>
				<?php
				unset($_SESSION['customer_id']);
				unset($_SESSION['cart']);
				unset($_SESSION['quantity']);
				$_SESSION['discount'] =0.00;
				?>
			</table>
      	</div>
      	<h5 style="font-size: 12px;">Thank You for shopping with us!<br>Please come again!!</h5>
		<h5 style='color: #333; font-size: 12px;'>*** DoryPOS - A Crony of Point Of Sale ***</h5>
		<p>.Developed by Sazal A.</p>
		<p>www.appsolic.io</p>
      </div>
</body>
</html>		