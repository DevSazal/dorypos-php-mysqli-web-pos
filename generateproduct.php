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

  <script>
    window.resizeTo(936,1024);
  </script>

	<!-- Stylesheets -->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" media="all" />
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-theme.css" media="all" />
	<link rel="stylesheet" type="text/css" href="assets/css/normalize.css" media="all" />
	<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css" media="all" />
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
	width: 500px;
	border-radius: 10px;
}
select{
       padding:8px 75px;
       margin-bottom: 10px;
       background: #ecf0f1;
       border-radius: 20px;
       outline: 0;
}
#selectId{
	padding:8px 85px;
       margin-bottom: 10px;
       background: #ecf0f1;
       border-radius: 20px;
       outline: 0;
}
#productinfo{
	padding: 30px;
}
.addproduct{
	margin-top: 20px;
  padding: 12px 50px;
  font-family: monospace;
}
</style>
</head>
<body>
	<div class="main">
		<div class="container" style="padding-top:3%;">
			<div class="row">
				<h1 style="text-align:center;color:#FFFFFF; font-family: monospace; font-size: 1.6em;"><b>Add New Product & Print BarCode<b></h1>
			</div>
		</div>
		<div id="scanpdt" class="container text-center" style="margin-top:1%">
			<div id="productinfo" class="row">
        <!--- Form Start -->

				<form class="" action="" method="post">

          <div class="form-group">
            <label class="sr-only" for="exampleInputAmount">Name</label>
            <div class="input-group">
              <div class="input-group-addon">Name</div>
              <input type="text" name="name_" class="form-control" id="exampleInputAmount" placeholder="Product Name">
            </div>
          </div>
          <div class="form-group">
            <label class="sr-only" for="exampleInputAmount">Barcode</label>
            <div class="input-group">
             

              <?php $barcode = makeBarcode(); ?>
              <div class="input-group-addon">|||| ||</div>
              <input type="text" name="barcode_" onmouseover="this.focus();" class="form-control" id="exampleInputAmount" placeholder="<?php echo $barcode; ?>" value="<?php echo $barcode; ?>" disabled>
          


            </div>
          </div>
          <div class="form-group">
            <label class="sr-only" for="exampleInputAmount">Cost Price</label>
            <div class="input-group">
              <div class="input-group-addon">BDT</div>
              <input type="text" name="cost_price_" class="form-control" id="exampleInputAmount" placeholder="Cost Price">
            </div>
          </div>
          <div class="form-group">
            <label class="sr-only" for="exampleInputAmount">Sale Price</label>
            <div class="input-group">
              <div class="input-group-addon">BDT</div>
              <input type="text" name="sale_price_" class="form-control" id="exampleInputAmount" placeholder="Sale Price">
            </div>
          </div>
          <div class="form-group">
            <label class="sr-only" for="exampleInputAmount">Quantity</label>
            <div class="input-group">
              <div class="input-group-addon">Quantity</div>
              <input type="text" name="quantity_" class="form-control" id="exampleInputAmount" placeholder="Quantity">
            </div>
          </div>
          <div class="form-group">
            <label class="sr-only" for="exampleInputAmount">Catagory</label>
            <div class="input-group">
             <div class="selectOpt">
              <select name="category_">
                <option value="">Select Catagory</option>
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
            </div>
            </div>
          </div>
          <div class="form-group">
            <label class="sr-only" for="exampleInputAmount">Brand</label>
            <div class="input-group">
             <div class="selectOpt">
              <select name="brand_" id="selectId">
                <option value="">Select Brand</option>
                <?php
                $result2 = brand_picker($db);
                if (mysqli_num_rows($result2) > 0) {
                   while ($record2 = mysqli_fetch_assoc($result2)) {
                ?>
                <option value="<?php echo $record2['brand_id'] ?>"><?php echo $record2['brand_title'] ?></option>
                <?php
                   }
                }
                 ?>
              </select>
            </div>
            </div>
          </div>
          <textarea name="comment_" class="form-control" rows="3" placeholder="Comment (Optional)"></textarea>

          <button type="submit" name="add_product2" class="btn btn-primary addproduct">Save & Print BarCode</button>

				</form>

        <!-- Form End -->
<?php

if (isset($_POST['add_product2'])) {


  $cost_price= floatval($_POST['cost_price_']);
  $sale_price= floatval($_POST['sale_price_']);
    $quantity= intval($_POST['quantity_']);
  if(!is_float($cost_price)  || empty($_POST['cost_price_']) ){
    ?> <script> swal("Opss..","Invalid Cost Price!","error") </script> <?php

  }
  elseif(!is_float($sale_price)  || empty($_POST['sale_price_'])  ){
    ?> <script> swal("Opss..","Invalid Sale Price!","error") </script> <?php

  }

  elseif(!is_int($quantity)  || $quantity==0  || empty($_POST['quantity_']) ){
    ?> <script> swal("Opss..","Invalid Quantity!","error") </script> <?php

  }
  elseif(empty($_POST['name_']) ||  empty($barcode)  || $_POST['category_']==NULL  || $_POST['brand_']==NULL )
    {
       $error = "Invalid Information!";
       ?> <script>swal("Opss...","<?php echo $error; ?>", "error");</script> <?php
    }else {
      // define $username and $password
      $name=$_POST['name_'];
      // to protect injection
      $name = stripslashes($name);
      $name = mysqli_real_escape_string($db, $name);
      // define $barcode
     
        


      // to protect injection
      $barcode = stripslashes($barcode);
      $barcode = mysqli_real_escape_string($db, $barcode);



      // define $username and $password
      $brand=$_POST['brand_'];
      // to protect injection
      $brand = stripslashes($brand);
      $brand = mysqli_real_escape_string($db, $brand);

      // define $username and $password
      $category=$_POST['category_'];
      // to protect injection
      $category = stripslashes($category);
      $category = mysqli_real_escape_string($db, $category);

      // define $username and $password
      $comment=$_POST['comment_'];
      // to protect injection
      $comment = stripslashes($comment);
      $comment = mysqli_real_escape_string($db, $comment);

      $date = dateinfo();
      $sql = "INSERT INTO dorypos_product (name, barcode, cost, price, in_quantity, quantity, category_id, brand_id, comment, created_date) VALUES ('$name', '$barcode', {$cost_price}, {$sale_price}, {$quantity}, {$quantity}, {$category}, {$brand}, '$comment', '{$date}')";

          if (mysqli_query($db, $sql)) {
                      $_SESSION['makeBarcode'] = $barcode; 
                      ?> <script>swal("Done","Product added successfully", "success");</script> <?php
                      //unset($_GET['barcode_']);

                      //echo "<script>window.close();</script>";
                      //location.reload();
                      header("Location: iprint.php?app=".handler()."&token=".token()."&code=".$_SESSION['makeBarcode']);
                      exit();

                      //$_GET['barcode_']=NULL;

              } else {
                    ?> <script>swal("Opss...","Something Wrong!", "error");</script> <?php

              }

    }
}

?>


			</div>
		</div>
</body>
</html>
