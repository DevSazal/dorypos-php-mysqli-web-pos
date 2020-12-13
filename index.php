<?php     session_start();    // Starting Session
ob_start(); ?>
<!DOCTYPE html>
<html lang="en-US" ng-app>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="keywords" content="DoryPOS, Appsolic Lab, DevSazal, Sazal Ahamed, Sajal Efran, appsolic.io , DoryPOS - A Crony of Point Of Sale" />
	<meta name="description" content="we are selling the best quality products and we export all over bangladesh.. " />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<title>DoryPOS - A Crony of Point Of Sale</title>

	<!-- Stylesheets -->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" media="all" />
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-theme.css" media="all" />
	<link rel="stylesheet" type="text/css" href="assets/css/normalize.css" media="all" />
	<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css" media="all" />
	<link rel="stylesheet" type="text/css" href="assets/css/style.css" media="all" />

	<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />
	
	<!--sweetalert lib-->
	<script src="assets/js/sweetalert.min.js"></script>
	<link rel="stylesheet" href="assets/css/sweetalert.min.css">
	<!--angular-->
	<script src="assets/js/angular.min.js"></script>
	<!-- [if lt ie 9]> <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif] -->
	<script src="assets/js/jquery-3.2.0.min.js"></script> 

	<link href='http://fonts.googleapis.com/css?family=Lato:400,400italic,700' rel='stylesheet' type='text/css'>

	<!-- [if lt ie 9]> <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif] -->
<style>
.about_us {
    padding-top: 12%;
    padding-right: 5%;
}
.login {
    padding-top: 27%; 
}
</style>
</head>
<body>
	<div class="main">
		<div class="container">
			<div class="row">
				<div class="whole_sytem col-xm-12  col-sm-12  col-md-12">
					<div class="about_us col-xm-6  col-sm-6  col-md-6">
						<div class="row">
							<h2 style="color:#fff;">DoryPOS</h2>
							<span style="color:#2c3e50;">A Crony Of Ponit of sales</span><br><br>
							<p style="text-align: justify;text-justify: inter-word; font-size:14px;color:#2c3e50;"><b>DoryPOS makes it easy to sell to your customers, whether you use our responsive web-based POS on Mac or PC, or our Vend Register iPad app. <br><a style="color: #314352;" href="tel:+8801758148788">Phone: +88 01758148788</a><br><a style="color: #0d2233;" href="https://www.freelancer.com/u/DevSazal">Developed by Sazal Ahamed || Email: sazal836@diu.edu.bd || skype: sajal.efran</a></b></p>
						
		
						</div> 
						<div class="row appsoliclab" style="margin-top: 35%;">
							<img class="img-responsive" src="assets/images/AppsolicLab.png" alt="" />
						</div>
					</div>
					<div class="login col-xm-6  col-sm-6  col-md-6 container">
						<div class="row">
							<form action="index.php" method="post">
									<input class="email col-xm-6  col-sm-6  col-md-6 " aria-hidden="true" type="text" Placeholder="Email" name="email_" value="admin" autocomplete="off"/>
									<input class="password col-xm-6  col-sm-6  col-md-6 " aria-hidden="true" type="password" Placeholder="Password"  name="pass_" value="admin" autocomplete="off"/>
									<input class="submit col-xm-6  col-sm-6  col-md-6" type="submit" name="login_submit"  value="Sign In"/>
							</form>
						</div>
						<div class="row forger-password">
							<a href="#">Forget Password? Call Us.</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- php login -->
	    <?php
		

	    $error='';         // Variable To Store Error Message
		require 'function.php';

		$db = connector_db();
		// echo encryptHash('admin');

	    if (isset($_SESSION['dorypos_admin']) && isset($_COOKIE['user_log'])  ) {

	    header('Location: dashboard.php?app='.handler().'&token='.token());
	    exit();

	    }

	    if (isset($_POST['login_submit']))
	     {
	        if (empty($_POST['email_']) || empty($_POST['pass_']))
	          {
	             $error = "Invalid email or password!2";
	             ?> <script>swal("Opss...","<?php echo $error; ?>", "error");</script> <?php
	          }
	        else
	          {
	              // define $username and $password
	              $email=$_POST['email_'];
	              $password=$_POST['pass_'];

	              // to protect injection
	              $email = stripslashes($email);
	              $password = stripslashes($password);
	              $email = mysqli_real_escape_string($db, $email);
	              $password = mysqli_real_escape_string($db, $password);
	              //$password = encryptHash($password);




	              $query_result = mysqli_query($db, "SELECT * FROM `admin` WHERE `email` = '$email'");

	              if (mysqli_num_rows($query_result) == 1)
	                {
	                  $record = mysqli_fetch_assoc ($query_result);
	                  $encrypted_hashedPassword = $record["password"];

	                  if(verify($password ,$encrypted_hashedPassword)){

	                    //$error = "*** Log ok";
							$_SESSION['dorypos_admin'] = $record["id"];   // initializing Session
							$_SESSION['dorypos_admin_name'] = $record["name"];
							$_SESSION['dorypos_root'] = $record["root"];
													//cookie save program
	                        $id = $record['id'];
	                        $encrypt_id = md5($id);
							$cookie_name = "user_log";
							if($_SESSION['dorypos_root']==FALSE){
								setcookie($cookie_name, $encrypt_id, time() + ((86400 / 24)*14), "/");
							}else{
	                        	setcookie($cookie_name, $encrypt_id, time() + (((86400 / 24)/60)*1200), "/");
							}
	                        header('Location: dashboard.php?app='.handler().'&token='.token());
	                        exit();

	                  }
	                  else {
	                     ?> <script>swal("Opss...","Invalid email or password!", "error");</script> <?php
	                  }
	                  //echo "login xx";
	                  //$error = "*** Log ok";
	                    //  $_SESSION['login_user'] = $email;   // initializing Session

	                }
	              else
	                {
	                    $error = "Invalid email or password!";
	                   ?> <script>swal("Opss...","<?php echo $error; ?>", "error");</script> <?php
	                }

	              mysqli_close($db);
	          }
	      }func();

	      ?>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="assets/js/scripts.js"></script>

</body>
</html>
