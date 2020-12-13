<!DOCTYPE html>
<html lang="en">
<?php session_start();    // Starting Session
      ob_start(); 
      $error='';         // Variable To Store Error Message
      require 'function.php';

      $db = connector_db();
      $barcode = $_SESSION['makeBarcode'];
        $query = "SELECT * FROM dorypos_product WHERE barcode='{$barcode}' LIMIT 1";
        $result = mysqli_query($db, $query);
        $record = mysqli_fetch_assoc($result);
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Barcode</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" media="all" />
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-theme.css" media="all" />
    
</head>
<script>
	function PrintWindow(){ 
		window.print(); 
		// CheckWindowState();
	}

function CheckWindowState(){ 
	if(document.readyState=="complete"){
		window.close(); 
	}else{ 
		setTimeout("CheckWindowState()", 2000)
	}
}	

PrintWindow();
////

</script>
<style>

</style>	
<body>
<div class="text-center" id="printArea">

 
    <?php
    for($i=1 ; $i <= $record['quantity'] ; $i++){
     echo "<span style='padding-right:4%; font-size: 12px;font-family: monospace;'>S: ".$record['row_id']."</span><span style='padding-left:3%; font-size: 12px;font-family: monospace;'>Price: ".sprintf('%.2f', $record['price'])."</span> <br>";
     echo "<img alt='barcode'  style='padding-bottom:3px' src='barcode.php?codetype=Code128&size=25&text=".$barcode."&print=true'/><br>"; 
    }
    ?>
    
    
</div>
</body>
</html>