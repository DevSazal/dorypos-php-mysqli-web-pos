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
	<link rel="stylesheet" type="text/css" href="assets/css/tools.css" media="all" />
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular&subset=Latin,Cyrillic"

	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />

			<!--sweetalert lib-->
			<script src="assets/js/sweetalert.min.js"></script>
			<link rel="stylesheet" href="assets/css/sweetalert.min.css">
			<!--angular-->
			<script src="assets/js/angular.min.js"></script>
			<!-- [if lt ie 9]> <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif] -->
			<script src="assets/js/jquery-3.2.0.min.js"></script> 

	<link href='http://fonts.googleapis.com/css?family=Lato:400,400italic,700' rel='stylesheet' type='text/css'>


	<!-- [if lt ie 9]> <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif] -->
</head>
<body>
	<div class="main">
		<div class="container" style="padding-top:3%;">
			<div class="row">
				<h1 style="text-align:center;color:#FFFFFF "><b>Welcome to DoryPOS<b></h1>
			</div>
		</div>
		<div class="container" style="margin-top:6%">
			<div class="row text-center">
					<div class="col-md-5 col-xm-5  col-sm-5 left-table">
						<form class="" action="" method="post">

								<h4 style="color: #333;" class="text-center">Add Brand</h4>
								<input class="email"  type="text" Placeholder="Add Brand" name="brand_" autocomplete="off"/>
								<!-- <div class="selectOpt">
									<select name="category_">
										<option value="NULL">Select Catagory</option>
										<?php
										$result = category_picker($db);
										if (mysqli_num_rows($result) > 0) {
											 while ($record = mysqli_fetch_assoc($result)) {
										?>
										<option value="<?php echo $record['category_id'] ?>"><?php echo $record['category_title'] ?></option>
										<?php
											 }
										}
										 ?>
									</select>
								</div> -->
								<button style="margin-top: 8px;" class="submit" type="submit" name="add_brand">Submit</button>

						</form>
					</div>

	<?php //add brand script

	if (isset($_POST['add_brand'])) {
		if (empty($_POST['brand_']))
			{
				 $error = "Please Type A Brand Name!";
				 ?> <script>swal("Opss...","<?php echo $error; ?>", "error");</script> <?php
			}else {
				// define $username and $password
				$brand=$_POST['brand_'];
				// to protect injection
				$brand = stripslashes($brand);
				$brand = mysqli_real_escape_string($db, $brand);

				

				$sql = "INSERT INTO dorypos_brand (brand_title, brand_category) VALUES ('$brand', NULL )";

						if (mysqli_query($db, $sql)) {
	                      ?> <script>swal("Done","Category added successfully", "success");</script> <?php
	              } else {
	                    ?> <script>swal("Opss...","Something Wrong!", "error");</script> <?php

	              }

			}
	}

					?>

					<div class="col-md-offset-2 col-xm-2  col-sm-2"></div>
					<div class="col-md-5 col-xm-5  col-sm-5 right-table ">
						  <div id="table-wrapper">
							  <div id="table-scroll">
							    <table class="table">
							        <thead>
							            <tr class="table-head">
							                <th><span class="text text-center">Brand</span></th>
							                <!-- <th><span class="text text-center">Catagory</span></th> -->
							            </tr>
							        </thead>
							        <tbody>

												<?php
												$result = brand_picker($db);
												if (mysqli_num_rows($result) > 0) {
													 while ($record = mysqli_fetch_assoc($result)) {
												?>
												<tr>
													<td style="text-align: left;"><?php echo $record['brand_title'] ?></td>
													<!-- <td><?php
													// $sql2 = "SELECT * FROM dorypos_category WHERE category_id = {$record['brand_category']} ";
													// $result2 = mysqli_query($db, $sql2);
													// $record2 =mysqli_fetch_assoc($result2);

													// echo $record2['category_title']
													?></td> -->
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
