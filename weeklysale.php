<!DOCTYPE HTML>
<html lang="en-US" ng-app>
<?php
	  session_start();    // Starting Session
	  ob_start(); 
			$error='';         // Variable To Store Error Message
			//$shop_cash=0.00;
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
		h3,h4{
			color: #333;
			margin-top: 20px;
		}
		.datetimepicker{
			padding: 10px 40px;
			border: 1px solid grey;
			border-radius: 5px;
		}
		span{
			font-size: 15px;
			font-weight: bold;
		}
    .submitbtn{
    padding: 12px 100px; 
    background: #e74c3c;
    outline: 0;
    color: #fff;
   }
   .submitbtn:hover{
   	background: #333;
   	color: #fff;
   	transition: .4s;
   	outline: 0;
   	border: 1px solid #333;
   }
   th{
   	text-align: center;
   }
	 .table{
   	border: 1px solid grey;
   }
	 #table-scroll {
	/* height: 230px; */
	height: 310px;
    overflow: auto;
    margin-top: 40px;
}
	</style>	
</head>
<body>
	<div class="container text-center">
		<div class="product-table">
			
		        <h4>Last 7 Days Sales Report</h4>
			 <h4>From:<b><?php echo $today=onlydate(); ?></b> To:<b><?php echo date('Y-m-d', strtotime('today - 7 days')); ?></b></h4>
					<div id="table-scroll">
      	 		<table class="table table-striped">
				    <thead>
				      <tr>
				        <th>#Item</th>
				        <th>Brand</th>
				        <th>Cost</th>
				        <!-- <th>Discount</th> -->
				        <th>Sale Price</th>
				        <th>Quantity</th>
								<th>Profit</th>
								<th>Date</th>
				      </tr>
				    </thead>
				    <tbody>
							<?php 
							$total_cost=0.00;
							$total_sale=0.00;
							$total_quantity=0;
							$total_profit=0.00;
						
							$startDate=date('Y-m-d', strtotime('today - 7 days'));
							$endDate=$today;

									$sql = "SELECT * FROM dorypos_order WHERE date BETWEEN '$startDate' AND '$endDate' ORDER BY date DESC";
								
							
							//SELECT * FROM dorypos_order WHERE date BETWEEN '2018-07-22' AND '2018-07-26' ORDER BY date
							//SELECT * FROM dorypos_order WHERE date BETWEEN STR_TO_DATE('2017-04-04', '%m/%d/%Y') AND STR_TO_DATE('2018-07-18', '%m/%d/%Y')
							// SELECT STR_TO_DATE(date, '%m/%d/%Y') FROM dorypos_order // worked
							//$sql = "SELECT * FROM dorypos_order WHERE CAST(date AS DATE) BETWEEN (07/24/2018 and 07/25/2018)";
							//$sql = "SELECT * FROM dorypos_order WHERE date BETWEEN format('07/24/2018','mm/dd/yyyy') AND format('07/25/2018','mm/dd/yyyy') ORDER BY order_id DESC";
							$result = mysqli_query($db, $sql);
							if(mysqli_num_rows($result) > 0){
								while($record = mysqli_fetch_assoc($result)){
									$product = $record['product_id'];

											$sql2 = "SELECT * FROM dorypos_product WHERE row_id=$product";
											$result2 = mysqli_query($db, $sql2);
											if(mysqli_num_rows($result2) > 0){
												while($record2 = mysqli_fetch_assoc($result2)){ 
											?>
				      <tr>
				        <td><?php echo $record2['name']; ?></td>
				        <td><?php echo brand_name($db,$record2['brand_id']); ?></td>
								<td>
									<?php echo $record2['cost']." BDT"; 
												$total_cost=$total_cost+ ($record2['cost']*$record['quantity']);
									?>
								</td>
				        <!-- <td>10%</td> -->
				        <td>
									<?php echo $record2['price']." BDT"; 
												$total_sale = $total_sale + ($record2['price']*$record['quantity']);
									?>
								</td>
						<td>
						<?php 
							echo $record['quantity'];
							$total_quantity=$total_quantity+$record['quantity'];
						 ?>
						</td>
								<td>
									<?php $profit = ($record2['price']*$record['quantity'])-($record2['cost']*$record['quantity']);
												 echo $profit; 
												 $total_profit = $total_profit + $profit;
								 ?></td>
								 <td><?php echo $record['date']; ?></td>
							</tr>
							<?php
														}
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
				        <th>Total Cost = <?php echo $total_cost." BDT"; ?></th>
				        <th>Total Sale = <?php echo $total_sale." BDT"; ?></th>
						<th>Total Quantity = <?php echo $total_quantity.""; ?></th>
								<th>Total Profit = <?php echo $total_profit." BDT"; ?> </th>
				      </tr>
				    </thead>
					</table>
      </div>
</div>

<div class="main text-center"> 
		<div class="container">
		<?php echo $iap; ?>
		</div>
</div>


<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js" ></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" ></script>
</script>
</body>
</html>