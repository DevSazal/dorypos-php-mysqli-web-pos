<!DOCTYPE HTML>
<html lang="en-US" ng-app>
<?php
      session_start();    // Starting Session
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


	<!-- [if lt ie 9]> <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif] -->

<style type="text/css">
	body{
	margin:0;
	background-color:#286090;
	background-repeat: no-repeat;
	background-attachment: fixed;
	font-family: Ubuntu;
}


.right-table  {
    -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
    box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
    border-radius: 4px;
	background-color:#ecf0f1;
	height:300px;
}

.left-table{
	-webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
    box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
    border-radius: 4px;
	background-color:#ecf0f1;
	height:300px;
	background-attachment:fixed;
	margin-right: 16.65%;
}
.email{
	padding:8px;
	border-bottom:2x solid black;
	background-color:transparent;
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
select{
       padding:10px 85px;
       margin-top: 10px;
       margin-bottom: 10px;
       background: #ecf0f1;
       border-radius: 20px;
       outline: 0;
}
#table-wrapper h4{
	color: #333;
}
#table-wrapper {
  position:relative;
}
#table-scroll {
  height:230px;
  overflow:auto;
  margin-top:40px;
}
#table-wrapper table {
  width:100%;

}
#table-wrapper table * {
  background:transparent;
  color:black;
}
#table-wrapper table thead th .text {
  position:absolute;
  top:-20px;
  z-index:2;
  height:40px;
  width:35%;
}

</style>
</head>
<body>
	<div class="main">
		<div class="container" style="padding-top:3%;">
			<div class="row">
				<h1 style="text-align:center;color:#FFFFFF "><b>Welcome to DoryPOS<b></h1>
			</div>
		</div>
		<div class="container" style="margin-top:6%">
			<div class="row">
					<div class="col-md-5 col-xm-5  col-sm-5 left-table">
					   <h4 style="color: #333;" class="text-center">Add Supplier</h4>
					   <form action="" method="post">
						<input class="email"  type="text" Placeholder="Name" name="name_" autocomplete="off"/>
						<input class="email"  type="text" Placeholder="Contact Number" name="phone_" autocomplete="off"/>
						<input class="email"  type="text" Placeholder="Address" name="address_" autocomplete="off"/>
						<div class="selectOpt">
							<select name="brand_">
							  <option value="NULL">Select Brand</option>
							  <?php
										$result = brand_picker($db);
										if (mysqli_num_rows($result) > 0) {
											 while ($record = mysqli_fetch_assoc($result)) {
										?>
										<option value="<?php echo $record['brand_id'] ?>"><?php echo $record['brand_title'] ?></option>
										<?php
											 }
										}
										 ?>
							</select>
						</div>
						<button class="submit" name="vendor">Submit</button>
						</form>
<?php //add brand script

	if (isset($_POST['vendor'])) {
		if (empty($_POST['brand_']) || empty($_POST['name_']) || empty($_POST['phone_']) || empty($_POST['address_']) )
			{
				 $error = "Invalid brand or category!";
				 ?> <script>swal("Opss...","<?php echo $error; ?>", "error");</script> <?php
			}else {
				// define $username and $password
				$brand=$_POST['brand_'];
				// to protect injection
				$brand = stripslashes($brand);
				$brand = mysqli_real_escape_string($db, $brand);

				// define $username and $password
				$name=$_POST['name_'];
				// to protect injection
				$name = stripslashes($name);
				$name = mysqli_real_escape_string($db, $name);

				$phone=$_POST['phone_'];
				// to protect injection
				$phone = stripslashes($phone);
				$phone = mysqli_real_escape_string($db, $phone);

				$address=$_POST['address_'];
				// to protect injection
				$address = stripslashes($address);
				$address = mysqli_real_escape_string($db, $address);

				$sql = "INSERT INTO dorypos_vendor (vendor_name, vendor_phone, vendor_address, vendor_brand) VALUES ('$name', '$phone', '$address', {$brand} )";

						if (mysqli_query($db, $sql)) {
	                      ?> <script>swal("Done","Supplier added successfully", "success");</script> <?php
	              } else {
	                    ?> <script>swal("Opss...","Something Wrong!", "error");</script> <?php

	              }

			}
	}

					?>
					</div>

					<div class="col-md-offset-2 col-xm-2  col-sm-2"></div>
					<div class="col-md-5 col-xm-5  col-sm-5 right-table ">
						<div id="table-wrapper">
							  <div id="table-scroll">
							    <table class="table">
							        <thead>
							            <tr class="table-head">
							                <th><span class="text">Name</span></th>
							                <th><span class="text">Brand</span></th>
							                <th><span class="text">Contact</span></th>
							                <th><span class="text">Address</span></th>

							            </tr>
							        </thead>
							        <tbody>
									<?php
												$result3 = vendor_picker($db);
												if (mysqli_num_rows($result3) > 0) {
													 while ($record3 = mysqli_fetch_assoc($result3)) {
												?>									  
							          <tr>
										  <td><?php echo $record3['vendor_name']; ?></td>
										  <td><?php
										  $sql4 = "SELECT * FROM dorypos_brand WHERE brand_id = {$record3['vendor_brand']} ";
										  $result4 = mysqli_query($db, $sql4);
										  $record4 =mysqli_fetch_assoc($result4);

										  echo $record4['brand_title'];
										 ?></td>
										  <td><?php echo $record3['vendor_phone']; ?></td>
										  <td><?php echo $record3['vendor_address']; ?></td> 
									  </tr>
									  <?php
													 }
												}
												 ?>

							        </tbody>
							    </table>
							  </div>
							</div>
					</div>
				<!--</div>-->
			</div>
		</div>
</body>
</html>
