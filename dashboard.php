<?php     session_start();    // Starting Session
ob_start(); ?>
<!DOCTYPE HTML>
<html lang="en-US" ng-app>
<?php
      //session_start();    // Starting Session
      $error='';         // Variable To Store Error Message
      require 'function.php';

      $db = connector_db();

      if (!isset($_SESSION['dorypos_admin']) || !(isset($_COOKIE['user_log'])) ) {

      header ('Location: index.php?app='.handler().'&token='.token());
      exit();

    }else {
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

	<title>DoryPOS - A Crony of Point Of Sale</title>

	<!-- Stylesheets -->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" media="all" />
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-theme.css" media="all" />
	<link rel="stylesheet" type="text/css" href="assets/css/normalize.css" media="all" />
	<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css" media="all" />
	<link rel="stylesheet" type="text/css" href="assets/css/style.css" media="all" />
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular&subset=Latin,Cyrillic">
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />

			<!--sweetalert lib-->
			<script src="assets/js/sweetalert.min.js"></script>
			<link rel="stylesheet" href="assets/css/sweetalert.min.css">
			<!--angular-->
			<script src="assets/js/angular.min.js"></script>
			<!-- [if lt ie 9]> <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif] -->
			<script src="assets/js/jquery-3.2.0.min.js"></script> 

	<link href='http://fonts.googleapis.com/css?family=Lato:400,400italic,700' rel='stylesheet' type='text/css'>

	<!-- Script for Popup with fixed size in center-->
		<script>
				function popupCenter(url, title, w, h) {
				  var left = (screen.width/2)-(w/2);
				  var top = (screen.height/2)-(h/2);
				  return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
				}
		</script>
		<style>
		.none{
		display:none;
		}</style>
		<script src="assets/js/jquery-3.2.0.min.js"></script> 
	<script>
	var txt = "";
	function selectBarcode() {
		if (txt != $("#focus").val()) {
			setTimeout('use_rfid()', 1000);
			txt = $("#focus").val();
		}
		$("#focus").select();
		setTimeout('selectBarcode()', 1000);
	}

	$(document).ready(function () {
		setTimeout(selectBarcode(),1000);       
	});
	</script>

	<!-- [if lt ie 9]> <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif] -->
</head>
<body>
	<?php if($_SESSION['dorypos_root']==FALSE){ ?>
	<div class="main">
		<div class="container">
			<div class="row">
				<div class="header">
					<div class="header-left col-xm-6  col-sm-6  col-md-6" >
						<p>
							<button type="button" class="btn btn-primary btn-lg"><i style="padding-right:6px" class="fa fa-tachometer" aria-hidden="true"></i>Dashboard</button>
							<button type="button" class="btn btn-primary btn-lg" onclick="popupCenter('checkprice.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',936,500);" href="javascript:void(0);"><i style="padding-right:4px" class="fa fa-search" aria-hidden="true"></i>    Check</button>
							<button type="button" class="btn btn-primary btn-lg" onclick="popupCenter('saleproduct.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',1100,500);" href="javascript:void(0);"><i style="padding-right:7px" class="fa fa-paper-plane" aria-hidden="true"></i>New Sale</button>
						</p>
					</div>
					<div class="header-right col-xm-6  col-sm-6  col-md-6">
						<p>
							<!-- <button type="button" class="btn btn-primary btn-lg"><span style="padding-right:4px" class="glyphicon glyphicon-user"></span></i> Welcome Admin</button> -->
							<button type="button" class="btn btn-primary btn-lg"><span style="padding-right:4px" class="glyphicon glyphicon-user"></span></i> <?php echo $_SESSION['dorypos_admin_name']; ?></button>
							<button type="button" class="btn btn-primary btn-lg" onclick="popupCenter('shortsale.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',1100,600);" href="javascript:void(0);"><i style="padding-right:4px" class="fa fa-database" aria-hidden="true"></i> Sales Report</button>
							<button type="button" class="btn btn-primary btn-lg" onClick="parent.location='logout.php'"><i style="padding-right:4px" class="fa fa-sign-out" aria-hidden="true"></i> Sign Out</button>
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="container" style="padding-top:3%;">
			<div class="row">
				<h1 style="text-align:center;color:#FFFFFF "><b>Welcome to DoryPOS<b></h1>
			</div>
		</div>
		<div class="container" style="margin-top:6%">
			<div class="row">
				<div class="col-md-4 col-xm-4  col-sm-4">
					<div class="panel">
						<div class="panel-heading">
						<h4 align="center"><i class="fa fa-cog" style="padding-right:6px;" aria-hidden="true"></i>Entry</h4></div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-4 col-xm-4  col-sm-4 option" align="center">
									<a onclick="popupCenter('category.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',936,500);" href="javascript:void(0);">
										<i style="color:#ffffff;text-decoration:none" class="fa fa-plus-square fa-5x"" aria-hidden="true"> </i>
										<br> Category
									</a>
								</div>
								<div class="col-md-4 col-xm-4  col-sm-4 option" align="center">
									<a onclick="popupCenter('brand.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',936,500);" href="javascript:void(0);">
										<i style="color:#ffffff;text-decoration:none" class="fa fa-bold fa-5x" aria-hidden="true"> </i>
										<br> Brand
									</a>
								</div>
								<div class="col-md-4 col-xm-4  col-sm-4 option" align="center">
									<a onclick="popupCenter('entry.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',936,370);" href="javascript:void(0);">
										<i style="color:#ffffff;text-decoration:none" class="fa fa-cart-plus fa-5x" aria-hidden="true"> </i>
										<br> Add Product
									</a>
								</div>
							</div>
						<!--<hr> -->
							<div class="row">
								<div class="col-md-4 col-xm-4  col-sm-4 option" align="center">
									<a onclick="popupCenter('vendor.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',936,500);" href="javascript:void(0);">
										<i style="color:#ffffff;text-decoration:none" class="fa fa-user fa-5x" aria-hidden="true"> </i>
										<br> Add New Spplier
									</a>
								</div>
								<!-- <div class="col-md-4 col-xm-4  col-sm-4 option" align="center">
										<a onclick="popupCenter('updateproduct.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',936,500);" href="javascript:void(0);">
											<i style="color:#ffffff;text-decoration:none" class="fa fa-refresh fa-5x" aria-hidden="true"> </i>
											<br> Update Product
										</a>
								</div> -->


								<div class="col-md-4 col-xm-4  col-sm-4 option" align="center">
									 <a onclick="popupCenter('generateproduct.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',936,370);" href="javascript:void(0);">
										<i style="color:#ffffff;text-decoration:none" class="fa fa-barcode fa-5x" aria-hidden="true"> </i>
										<br> Add BarCode & Product
									</a>
									<!-- <a>
										<i style="color:#ffffff;text-decoration:none" class="fa fa-trash fa-5x" aria-hidden="true"> </i>
										<br> Delete Product
									</a>  --> 
								</div>


							</div>
						</div>
						<div class="panel-footer"> </div>
					</div>
				</div>
				<div class="col-md-4 col-xm-4  col-sm-4">
					<div class="panel">
						<div class="panel-heading">
						<h4 align="center"><i class="fa fa-cog" style="padding-right:6px;" aria-hidden="true"></i>Sale</h4></div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-4 col-xm-4  col-sm-4 option" align="center">
									<a onclick="popupCenter('saleproduct.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',1100,500);" href="javascript:void(0);">
										<i style="color:#ffffff;text-decoration:none; padding: 3.5px 0px;" class="fa fa-shopping-bag fa-5-1x" aria-hidden="true"> </i>
										<br> New Sale
									</a>
								</div>
								<div class="col-md-4  col-xm-4  col-sm-4 option " align="center">
									<a onclick="popupCenter('return.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',936,500);" href="javascript:void(0);"><i style="color:#ffffff;text-decoration:none" class="fa fa-history fa-5x" aria-hidden="true"> </i>
										<br> Return
									</a>
								</div>
								<div class="col-md-4 col-xm-4  col-sm-4 option" align="center">
									<a onclick="popupCenter('checkprice.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',936,500);" href="javascript:void(0);">
										<i style="color:#ffffff;text-decoration:none" class="fa fa-check-square-o fa-5x" aria-hidden="true"> </i>
										<br> Check Price
									</a>
								</div>
							</div>
						<!--<hr> -->
							<div class="row">
								<!-- <div class="col-md-4 col-xm-4  col-sm-4 option" align="center">
									<a onclick="popupCenter('totalcash.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',936,600);" href="javascript:void(0);">
										<i style="color:#ffffff;text-decoration:none" class="fa fa-money fa-5x" aria-hidden="true"> </i>
										<br> Account Saction
									</a>
								</div> -->
								<!-- Manual -->
								<div class="col-md-4 col-xm-4  col-sm-4 option" align="center">
									<a onclick="popupCenter('manuallysale.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',1100,500);" href="javascript:void(0);">
										<i style="color:#ffffff;text-decoration:none" class="fa fa-bug fa-5x" aria-hidden="true"> </i>
										<br> Manually New Sale
									</a>
								</div>
								<!-- Manual -->
							</div>
					  </div>
					  <div class="panel-footer"> </div>
					</div>
				</div>
				<div class="col-md-4 col-xm-4  col-sm-4">
					<div class="panel">
						<div class="panel-heading">
						<h4 align="center"><i class="fa fa-cog" style="padding-right:6px;"aria-hidden="true"></i>Report</h4></div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-4 col-xm-4  col-sm-4 option" align="center">
									<a onclick="popupCenter('stock.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',1100,600);" href="javascript:void(0);">
										<i style="color:#ffffff;text-decoration:none" class="fa fa-stack-exchange fa-5x" aria-hidden="true"> </i>
										<br> Stock Status
									</a>
								</div>
								<div class="col-md-4 col-xm-4  col-sm-4 option" align="center">
									<a onclick="popupCenter('dailysale.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',1100,600);" href="javascript:void(0);"> <i style="color:#ffffff;text-decoration:none" class="fa fa-weibo fa-5x" aria-hidden="true"> </i>
										<br> Taday Sale
									</a>
								</div>
								<div class="col-md-4 col-xm-4  col-sm-4 option" align="center">
									<a onclick="popupCenter('weeklysale.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',1100,600);" href="javascript:void(0);">
										<i style="color:#ffffff;text-decoration:none" class="fa fa-print fa-5x" aria-hidden="true"> </i>
										<br> Weekly Sale
									</a>
								</div>
							</div>
						<!--<hr> -->
							<div class="row">
								<div class="col-md-4 col-xm-4  col-sm-4 option" align="center">
									<a onclick="popupCenter('shortsale.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',1100,600);" href="javascript:void(0);">
										<i style="color:#ffffff;text-decoration:none" class="fa fa-cloud fa-5x" aria-hidden="true"> </i>
										<br> Short Sale Report
									</a>
								</div>

								<!-- Customer Invoice -->
								<div class="col-md-4 col-xm-4  col-sm-4 option" align="center">
									<a onclick="popupCenter('checkInvoice.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',1220,601);" href="javascript:void(0);">
										<i style="color:#ffffff;text-decoration:none" class="fa fa-eye fa-5x" aria-hidden="true"> </i>
										<br> Customer Invoice
									</a>
								</div>
								<!-- Customer Invoice -->
								
							</div>
						</div>
						<div class="panel-footer"> </div>
					</div>
				</div>
			</div>
			<div style="text-align: center;"> <a href="http://appsolic.io" style="color: #0e1d3e;">DoryPOS SoftWare</a> © 2018 All Rights Reserved | Developed by <a style="color: #0e1d3e;" href="https://www.freelancer.com/u/DevSazal">Sazal Ahamed | Appsolic Lab</a></div>
		</div>
		
	</div>

	<!-- <form class="none" action="saleproduct.php" method="post">
								 <h4 style="color: #333;" class="text-center">Scan Product</h4>
								 <input   class="email" id="focus" type="text" Placeholder="UPC / Barcode" name="barcode_" autocomplete="off" autofocus/>
								 <button type="submit" name="scan_product"  class="submit">Submit</button>
						</form> -->
	<?php }else{ ?>
		<div class="main">
		<div class="container">
			<div class="row">
				<div class="header">
					<div class="header-left col-xm-6  col-sm-6  col-md-6" >
						<p>
							<button type="button" class="btn btn-primary btn-lg"><i style="padding-right:6px" class="fa fa-tachometer" aria-hidden="true"></i>Dashboard</button>
							<button type="button" class="btn btn-primary btn-lg" onclick="popupCenter('checkprice.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',936,500);" href="javascript:void(0);"><i style="padding-right:4px" class="fa fa-search" aria-hidden="true"></i>    Check</button>
							<button type="button" class="btn btn-primary btn-lg" onclick="popupCenter('saleproduct.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',1100,500);" href="javascript:void(0);"><i style="padding-right:7px" class="fa fa-paper-plane" aria-hidden="true"></i>New Sale</button>
						</p>
					</div>
					<div class="header-right col-xm-6  col-sm-6  col-md-6">
						<p>
							<!-- <button type="button" class="btn btn-primary btn-lg"><span style="padding-right:4px" class="glyphicon glyphicon-user"></span></i> Welcome Admin</button> -->
							<button type="button" class="btn btn-primary btn-lg"><span style="padding-right:4px" class="glyphicon glyphicon-user"></span></i> <?php echo $_SESSION['dorypos_admin_name']; ?></button>
							<button type="button" class="btn btn-primary btn-lg" onclick="popupCenter('shortsale.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',1100,600);" href="javascript:void(0);"><i style="padding-right:4px" class="fa fa-database" aria-hidden="true"></i> Sales Report</button>
							<button type="button" class="btn btn-primary btn-lg" onClick="parent.location='logout.php'"><i style="padding-right:4px" class="fa fa-sign-out" aria-hidden="true"></i> Sign Out</button>
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="container" style="padding-top:3%;">
			<div class="row">
				<h1 style="text-align:center;color:#FFFFFF "><b>Welcome to DoryPOS<b></h1>
			</div>
		</div>
		<div class="container" style="margin-top:6%">
			<div class="row">
				<div class="col-md-4 col-xm-4  col-sm-4">
					<div class="panel">
						<div class="panel-heading">
						<h4 align="center"><i class="fa fa-cog" style="padding-right:6px;" aria-hidden="true"></i>Entry</h4></div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-4 col-xm-4  col-sm-4 option" align="center">
									<a onclick="popupCenter('category.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',936,500);" href="javascript:void(0);">
										<i style="color:#ffffff;text-decoration:none" class="fa fa-plus-square fa-5x"" aria-hidden="true"> </i>
										<br> Category
									</a>
								</div>
								<div class="col-md-4 col-xm-4  col-sm-4 option" align="center">
									<a onclick="popupCenter('brand.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',936,500);" href="javascript:void(0);">
										<i style="color:#ffffff;text-decoration:none" class="fa fa-bold fa-5x" aria-hidden="true"> </i>
										<br> Brand
									</a>
								</div>
								<div class="col-md-4 col-xm-4  col-sm-4 option" align="center">
									<a onclick="popupCenter('entry.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',936,370);" href="javascript:void(0);">
										<i style="color:#ffffff;text-decoration:none" class="fa fa-cart-plus fa-5x" aria-hidden="true"> </i>
										<br> Add Product
									</a>
								</div>
							</div>
						<!--<hr> -->
							<div class="row">
								<div class="col-md-4 col-xm-4  col-sm-4 option" align="center">
									<a onclick="popupCenter('vendor.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',936,500);" href="javascript:void(0);">
										<i style="color:#ffffff;text-decoration:none" class="fa fa-user fa-5x" aria-hidden="true"> </i>
										<br> Add New Spplier
									</a>
								</div>
								<div class="col-md-4 col-xm-4  col-sm-4 option" align="center">
										<a onclick="popupCenter('updateproduct.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',936,500);" href="javascript:void(0);">
											<i style="color:#ffffff;text-decoration:none" class="fa fa-refresh fa-5x" aria-hidden="true"> </i>
											<br> Update Product
										</a>
								</div>
								<div class="col-md-4 col-xm-4  col-sm-4 option" align="center">
									 <a onclick="popupCenter('generateproduct.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',936,370);" href="javascript:void(0);">
										<i style="color:#ffffff;text-decoration:none" class="fa fa-barcode fa-5x" aria-hidden="true"> </i>
										<br> Add BarCode & Product
									</a>
									<!-- <a>
										<i style="color:#ffffff;text-decoration:none" class="fa fa-trash fa-5x" aria-hidden="true"> </i>
										<br> Delete Product
									</a>  --> 
								</div>
							</div>
						</div>
						<div class="panel-footer"> </div>
					</div>
				</div>
				<div class="col-md-4 col-xm-4  col-sm-4">
					<div class="panel">
						<div class="panel-heading">
						<h4 align="center"><i class="fa fa-cog" style="padding-right:6px;" aria-hidden="true"></i>Sale</h4></div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-4 col-xm-4  col-sm-4 option" align="center">
									<a onclick="popupCenter('saleproduct.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',1100,500);" href="javascript:void(0);">
										<i style="color:#ffffff;text-decoration:none; padding: 3.5px 0px;" class="fa fa-shopping-bag fa-5-1x" aria-hidden="true"> </i>
										<br> New Sale
									</a>
								</div>
								<div class="col-md-4  col-xm-4  col-sm-4 option " align="center">
									<a onclick="popupCenter('return.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',936,500);" href="javascript:void(0);"><i style="color:#ffffff;text-decoration:none" class="fa fa-history fa-5x" aria-hidden="true"> </i>
										<br> Return
									</a>
								</div>
								<div class="col-md-4 col-xm-4  col-sm-4 option" align="center">
									<a onclick="popupCenter('checkprice.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',936,500);" href="javascript:void(0);">
										<i style="color:#ffffff;text-decoration:none" class="fa fa-check-square-o fa-5x" aria-hidden="true"> </i>
										<br> Check Price
									</a>
								</div>
							</div>
						<!--<hr> -->
							<div class="row">
								<div class="col-md-4 col-xm-4  col-sm-4 option" align="center">
									<a onclick="popupCenter('totalcash.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',1220,601);" href="javascript:void(0);">
										<i style="color:#ffffff;text-decoration:none" class="fa fa-money fa-5x" aria-hidden="true"> </i>
										<br> Account Saction
									</a>
								</div>
								<!-- Manual -->
								<div class="col-md-4 col-xm-4  col-sm-4 option" align="center">
									<a onclick="popupCenter('manuallysale.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',1100,500);" href="javascript:void(0);">
										<i style="color:#ffffff;text-decoration:none" class="fa fa-bug fa-5x" aria-hidden="true"> </i>
										<br> Manually New Sale
									</a>
								</div>
								<!-- Manual -->
							</div>
					  </div>
					  <div class="panel-footer"> </div>
					</div>
				</div>
				<div class="col-md-4 col-xm-4  col-sm-4">
					<div class="panel">
						<div class="panel-heading">
						<h4 align="center"><i class="fa fa-cog" style="padding-right:6px;"aria-hidden="true"></i>Report</h4></div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-4 col-xm-4  col-sm-4 option" align="center">
									<a onclick="popupCenter('stock.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',1100,600);" href="javascript:void(0);">
										<i style="color:#ffffff;text-decoration:none" class="fa fa-stack-exchange fa-5x" aria-hidden="true"> </i>
										<br> Stock Status
									</a>
								</div>
								<div class="col-md-4 col-xm-4  col-sm-4 option" align="center">
									<a onclick="popupCenter('dailysale.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',1100,600);" href="javascript:void(0);"> <i style="color:#ffffff;text-decoration:none" class="fa fa-weibo fa-5x" aria-hidden="true"> </i>
										<br> Taday Sale
									</a>
								</div>
								<div class="col-md-4 col-xm-4  col-sm-4 option" align="center">
									<a onclick="popupCenter('weeklysale.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',1100,600);" href="javascript:void(0);">
										<i style="color:#ffffff;text-decoration:none" class="fa fa-print fa-5x" aria-hidden="true"> </i>
										<br> Weekly Sale
									</a>
								</div>
							</div>
						<!--<hr> -->
							<div class="row">
								<div class="col-md-4 col-xm-4  col-sm-4 option" align="center">
									<a onclick="popupCenter('shortsale.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',1100,600);" href="javascript:void(0);">
										<i style="color:#ffffff;text-decoration:none" class="fa fa-cloud fa-5x" aria-hidden="true"> </i>
										<br> Short Sale Report
									</a>
								</div>

								<!-- Customer Invoice -->
								<div class="col-md-4 col-xm-4  col-sm-4 option" align="center">
									<a onclick="popupCenter('checkInvoice.php?app=<?php echo handler(); ?>&token=<?php echo token(); ?>', 'myPop1',1220,601);" href="javascript:void(0);">
										<i style="color:#ffffff;text-decoration:none" class="fa fa-eye fa-5x" aria-hidden="true"> </i>
										<br> Customer Invoice
									</a>
								</div>
								<!-- Customer Invoice -->

							</div>
						</div>
						<div class="panel-footer"> </div>
					</div>
				</div>
			</div>
			<div style="text-align: center;"> <a href="http://appsolic.io" style="color: #0e1d3e;">DoryPOS SoftWare</a> © 2018 All Rights Reserved | Developed by <a style="color: #0e1d3e;" href="https://www.freelancer.com/u/DevSazal">Sazal Ahamed | Appsolic Lab</a> </div>
		</div>
		
	</div>

	<!-- <form class="none" action="saleproduct.php" method="post">
								 <h4 style="color: #333;" class="text-center">Scan Product</h4>
								 <input   class="email" id="focus" type="text" Placeholder="UPC / Barcode" name="barcode_" autocomplete="off" autofocus/>
								 <button type="submit" name="scan_product"  class="submit">Submit</button>
						</form> -->
	<?php } ?>
</body>
<?php } ?>
</html>
