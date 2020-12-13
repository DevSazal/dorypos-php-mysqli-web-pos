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
	
	
	<!-- [if lt ie 9]> <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif] -->
<style type="text/css">
   .container{
   	width: 95%;
   }
   .selectpicker{
   	padding: 12px 82px;
    border-radius: 5px;
   }
   .search-input{
   	padding: 19px 13px;
   }
   .searchbtn{
   	padding: 9px 50px;
   	background: #e74c3c;
   	color: #fff;
   	border-color: #e74c3c;
   	outline: none;
   }
   .delete-heading h2{
   	color: #333;
   	margin-top: 20px;
   	margin-bottom: 30px;
   }
   .list-heading h4{
   	color: #333;
   	margin-top: 20px;
   }
   th{
   	text-align: center;
   }
   .table{
   	border: 1px solid grey;
   }
   .searchbtn{
	padding: 10px 80px; 
    background: #e74c3c;
    outline: 0;
   }
   .searchbtn:hover{
   	background: #333;
   	color: #fff;
   	transition: .4s;
   	outline: 0;
   	border: 1px solid #333;
   }
   .form-control {
    height: 43px;
	}
	label {
    padding-right: 12px;
    font-size: 20px;
	}
   #table-scroll {
    height: 310px;
    overflow: auto;
    margin-top: 40px;
}
h1, .h1, h2, .h2, h3, .h3 {
    margin-top: 0px;
    margin-bottom: 10px;
}
</style>	
</head>
<body>
      <div class="container text-center">
      	 <div class="delete-heading">
      	 	<h2>Stock Status</h2>
      	 </div>
						<div class="search">
							<form action="" method="post" class="form-inline">
							<div class="form-group">
								<label for="email">Filter:</label>
								<select name="category_" class="selectpicker form-control >
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
							</div>
							<button type="submit" class="btn btn-default searchbtn" name="category">Select Category</button>
							</form>
						</div>
      	 <div class="product-list">
      	 	<!-- <div class="list-heading">
      	 		<h4>Showing For All</h4>
      	 	</div>  -->
      	 	<div class="product-table">
			   <div id="table-scroll">
      	 		<table class="table table-striped">
				    <thead>
				      <tr>
					  	<th>SN</th>
				        <th>#Item</th>
				        <th>Barcode</th>
				        <th>Catagory</th>
						<th>Brand</th>
						<th>Cost</th>
				        <th>Price</th>
				        <th>Quantity</th>
				        <th>Entry Date</th>
				      </tr>
				    </thead>
				    <tbody>
					<?php
					$total_quantity=0;
					$count=0;
					$total_cost=0;
					if(isset($_POST['category']) && isset($_POST['category_']) && $_POST['category_'] != NULL){
						$id =intval($_POST['category_']);
						$sql = "SELECT * FROM dorypos_product WHERE category_id={$id} ORDER BY row_id DESC";
					}else{
						$sql = "SELECT * FROM dorypos_product ORDER BY row_id DESC";
					}
							// $sql = "SELECT * FROM dorypos_product ORDER BY row_id DESC";
							$result = mysqli_query($db, $sql);
							if(mysqli_num_rows($result) > 0){
								while($record = mysqli_fetch_assoc($result)){
									if($record['quantity'] > 0){

									
								?>
				      <tr>
					  	<td><?php echo $record['row_id']; ?></td>
				        <td><?php echo $record['name']; ?></td>
				        <td><?php echo $record['barcode']; ?></td>
				        <td><?php echo category_name($db,$record['category_id']); ?></td>
				        <td><?php echo brand_name($db,$record['brand_id']); ?></td>
				        <td><?php echo $record['cost']." BDT"; ?></td>
						<td><?php echo $record['price']." BDT"; ?></td>
						<td>
						<?php
						 echo $record['quantity'];

						 $count = $count +1;
						 $total_cost=$total_cost+ ($record['cost']*$record['quantity']);
						 $total_quantity = $total_quantity + $record['quantity'];
						 
						 ?>
						 </td>
				        <td><?php echo $record['created_date']; ?></td>
					  </tr>
					  <?php
					  				}
							}
							}
							 ?>
				      
				    </tbody>

				 </table>
			   </div>

			   <table class="table">
				    <thead>
				      <tr>
				        <th>Total Item : <?php echo $count.""; ?></th>
				        <th>Total Product Cost : <?php echo $total_cost." BDT"; ?></th>
						<th>Total Quantity : <?php echo $total_quantity." pieces"; ?></th>
								<!-- <th>Total Profit = <?php echo $total_profit." BDT"; ?> </th> -->
				      </tr>
				    </thead>
				</table>


			   </div>
      	 </div>
      </div>
      
<div class="main text-center"> 
		<div class="container">
		<?php echo $iap; ?>
		</div>
</div>


<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js" ></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" ></script>
</body>
</html>		