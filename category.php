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
			<div class="row">
					<div class="col-md-5 col-xm-5  col-sm-5 left-table"  style="margin-right: 16.65%;">
						<form class="" action="" method="post">
									<h4 style="color: #34495e;" class="text-center">Add Catagory</h4>
								 	<input class="email"  type="text" Placeholder="Category" name="category_" autocomplete="off"/>
								 	<button class="submit" type="submit" name="add_category">Submit</button>
						</form>
					</div>

<?php
if (isset($_POST['add_category'])) {
	// if (empty($_POST['category_']) || !preg_match("/^[\w]+$/", $_POST['category_']) )
	if (empty($_POST['category_']) )
		{
			 $error = "Invalid category name!";
			 ?> <script>swal("Opss...","<?php echo $error; ?>", "error");</script> <?php
		}else {
			// define $username and $password
			$category=$_POST['category_'];
			// to protect injection
			$category = stripslashes($category);
			$category = mysqli_real_escape_string($db, $category);

			$sql = "INSERT INTO dorypos_category (category_title) VALUES ('$category')";

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
						      <h4 class="text-center">Catagory</h4>
							  <div id="table-scroll">
							    <table class="table">
							        <tbody>
								<?php
				  				  $result = category_picker($db);
				  				  if (mysqli_num_rows($result) > 0) {
				  				      // output data of each row
				  				  while ($record = mysqli_fetch_assoc($result)){
		            ?>
							          <tr> <td><?php echo $record['category_title']; ?></td> </tr>

								<?php   } } ?>

							        </tbody>
							    </table>
							  </div>
							</div>
					</div>
				<!--</div>-->
			</div>
		</div>
