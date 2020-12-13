<!DOCTYPE HTML>
<html lang="en-US" ng-app>
<?php
	  session_start();    // Starting Session
	  ob_start(); 
      $error='';         // Variable To Store Error Message
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
	
	<!--sweetalert lib-->
	<script src="assets/js/sweetalert.min.js"></script>
	<link rel="stylesheet" href="assets/css/sweetalert.min.css">
					<!--angular-->
					<script src="assets/js/angular.min.js"></script>
	<!-- [if lt ie 9]> <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif] -->
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

<style type="text/css">
	body{	
	margin:0;
	background-color:#286090;
	background-repeat: no-repeat;
	background-attachment: fixed;
	font-family: Ubuntu;   
}

.email{
	padding:8px;
	border-bottom:2x solid black;
	background-color:transparent;
	margin-top: 50px;
	margin-bottom:5px;
	width:100%;
	border:none;
	border-bottom:2px solid #bdc3c7;
	margin-bottom:10px;
	text-align:center;
	font-size:16px;
	color: grey;
	outline: 0;

}

.submit{
	margin-top: 20px;
	padding:12px  18px;
	border-radius:20px;
	background-color:#e74c3c;
	color:#ffffff;
	width:100%;
	border:none;
	text-align:center;
	font-size:16px;
	outline: 0;
}
.submit:hover{
	transition: .3s;
	background-color:#2c3e50;
	box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
}


#scanpdt{
	background: #ecf0f1;
	height: 200px;
	width: 500px;
	border-radius: 10px;
}
</style>	
</head>
<body>
	<div class="main"> 
		<div class="container" style="padding-top:3%;">
			<div class="row"> 
				<h1 style="text-align:center;color:#FFFFFF "><b>Return a Product<b></h1>
			</div>
		</div>
		<div id="scanpdt" class="container text-center" style="margin-top:6%">
			<div class="row">
				<div class="col-md-12">
					<form action="" method="post">
						<input class="email"  type="text" Placeholder="UPC / Barcode" id="focus" name="barcode_" autocomplete="off"/>
					    <button class="submit" name="entry">Submit</button>
					</form>
				</div>
			</div>
			<?php 
				if (isset($_POST['entry'])) {
					if (!empty($_POST['barcode_'])) {

						if(mysqli_num_rows($result = product_checker($db,$_POST['barcode_'])) > 0){
						$record = mysqli_fetch_assoc($result);

						$barcode00 = $record['barcode'];
						$quantity00 = $record['quantity']+1;
										 $sql00= "UPDATE dorypos_product SET quantity={$quantity00} WHERE barcode='{$barcode00}'";
						 $result00 = mysqli_query($db,$sql00);
						 
						?><script>swal("<?php echo $record['price'].' BDT'; ?>", "RETURNED_ITEM# <?php echo $record['name']; ?>","success")</script><?php
						
							$reason = "RETURNED_ITEM#{$record['barcode']}";
							$amount=$record['price'];
								
								$date=onlydate();
								$sql5 ="INSERT INTO dorypos_ex (reason,amount,status,date) VALUES('$reason', $amount, TRUE, '$date')";
								mysqli_query($db,$sql5);
							
							$product_id = $record['row_id'];
							$sql6= "INSERT INTO dorypos_order (product_id, quantity, customer_id, date) VALUES ({$product_id}, -1, NULL, '{$date}')";
							$result6 = mysqli_query($db,$sql6);

						}else {
						// header ("Location: addproduct.php?app=".handler()."&token=".token()."&entry=true&barcode_=".$_POST['barcode_']);
						// exit();
						?><script>swal("Sorry...", "The product is not exists!","error")</script><?php
						}

			
					}
				}

			?>
		</div>
	<!--</div>-->
	</div>



</body>
</html>