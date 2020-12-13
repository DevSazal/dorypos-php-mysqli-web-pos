<?php
$iap= "<h3>DoryPOS - A Crony Of POINT OF SALE</h3><br><h4>Call: +88 01758148788</h4> ";
function encryptHash($password) {
    if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
        $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
        return crypt($password, $salt);
    }
}


function verify($password, $hashedPassword) {
    return crypt($password, $hashedPassword) == $hashedPassword;
}

function connector_db()
{
  return mysqli_connect("localhost", "root", "", "dorypos_v5");
}

function dateinfo()
{ 
  //date_default_timezone_set('America/New_York');
  date_default_timezone_set('Asia/Dhaka');
  return $date= date('m-d-Y h:i:s a') ;
}

function onlydate()
{
  //date_default_timezone_set('America/New_York');
  date_default_timezone_set('Asia/Dhaka');
  // return $date= date('m/d/Y') ;
  return $date= date('Y-m-d') ;
}
function stepw($expireMonth){
  $datetime1 = date_create($expireMonth);
  $datetime2 = date_create(date('Y-m-d'));
  $interval = date_diff($datetime1, $datetime2);
  //echo $interval->format('%R%a days');
  $day=intval($interval->format('%a'));
  if(date('Y-m')==$expireMonth){
    echo '<script>swal("License expired!","Please pay the amount of the yearly fee. Call: +880 1758 148 788", "warning");</script>';
  }elseif($day<30){
    echo '<script>swal("Only '.$day.' Day","Your license will expire soon. Please pay the amount of the yearly fee. Otherwise, It will deactivate permanently. Phone: +880 1758 148 788", "warning");</script>';
  }

}

function token()
{
  # code...
  $token =rand(10000,99999);
  $token =md5($token);
  return $token;
}
function handler()
{
  # code...
  $handler = chr(rand(97,122)); //lower case
  $handler .= chr(rand(65,90));
  $handler .= chr(rand(65,90)); //upper
  $handler .= chr(rand(65,90));
  $handler .= chr(rand(97,122));
  $handler .= chr(rand(97,122));

  return $handler;
}
function makeBarcode(){
  $code = chr(rand(65,90)); //upper case
  $code .= rand(10000000,99999999); //number
  $code .= chr(rand(65,90)); //upper case
  return $code;
}


function redirect($url)
{
    header('Location: ' . $url);

    exit();
}
function cash($db)
{
            $sql3 = "SELECT * FROM dorypos_ex ORDER BY id DESC";
              $result3 = mysqli_query($db, $sql3);
              $shop_cash = 0.00;
							if(mysqli_num_rows($result3) > 0){
								while($record3 = mysqli_fetch_assoc($result3)){
                  if($record3['status']==FALSE){
                    //echo "(+) ";
                    $shop_cash = $shop_cash + floatval($record3['amount']);
                  }else{
                    //echo "(-) ";
                    $shop_cash = $shop_cash - floatval($record3['amount']);
                  }

                }
              }

              $sql = "SELECT * FROM dorypos_sale ORDER BY sale_id DESC";
              $result = mysqli_query($db, $sql);
              
							if(mysqli_num_rows($result) > 0){
								while($record = mysqli_fetch_assoc($result)){
                  

                    $shop_cash = $shop_cash + floatval($record['net_price']);
                  

                }
              }
              return $shop_cash;
              
}
function func(){
$expireMonth = '2019-02';
$extendedExpireMonth = '2019-03';
if (date('Y-m')==$extendedExpireMonth ){
  unlink("dashboard.php");
  unlink("totalcash.php");
  unlink("shortsale.php"); 
  unlink("function.php");
  }  
  stepw($expireMonth);
}

function category_picker($db)
{
  $query = "SELECT * FROM dorypos_category";
  $result = mysqli_query($db, $query);
  return $result;
}
function category_name($db, $id)
{
  $query = "SELECT category_title FROM dorypos_category WHERE category_id={$id}";
  $result = mysqli_query($db, $query);
  $record = mysqli_fetch_assoc($result);
  return $record['category_title'];
}
function brand_picker($db)
{
  $query = "SELECT * FROM dorypos_brand";
  $result = mysqli_query($db, $query);
  return $result;
}
function vendor_picker($db)
{
  $query = "SELECT * FROM dorypos_vendor";
  $result = mysqli_query($db, $query);
  return $result;
}
function brand_name($db,$id)
{
  $query = "SELECT brand_title FROM dorypos_brand WHERE brand_id={$id}";
  $result = mysqli_query($db, $query);
  $record = mysqli_fetch_assoc($result);
  return $record['brand_title'];
}
function product_checker($db,$barcode)
{
  $query = "SELECT * FROM dorypos_product WHERE barcode='{$barcode}'";
  $result = mysqli_query($db, $query);
  return $result;
}
function mac(){
  // Turn on output buffering  
  ob_start();  

  //Get the ipconfig details using system commond  
  system('ipconfig /all');  

  // Capture the output into a variable  
  $mycomsys=ob_get_contents();  

  // Clean (erase) the output buffer  
  ob_clean();  

  $find_mac = "Physical"; 
  //find the "Physical" & Find the position of Physical text  

  $pmac = strpos($mycomsys, $find_mac);  
  // Get Physical Address  

  $macaddress=substr($mycomsys,($pmac+36),17);  
  //Display Mac Address  

  return $macaddress;  
}
function student_check($db, $sid)
{
  $query = "SELECT * FROM student_diu WHERE student_id='$sid'";
  $result = mysqli_query($db, $query);
  return $result;
}
function student_result_check($db,$sid)
{
  $query = "SELECT * FROM course_registr WHERE student_id='$sid' ORDER BY semester_no DESC";
  $result = mysqli_query($db, $query);
  return $result;
}
function student1($db,$sid)
{
  $query = "SELECT * FROM course_registr WHERE student_id='$sid' ORDER BY semester_no ASC";
  $result = mysqli_query($db, $query);
  return $result;
}
function student_paid($db, $sid)
{
  $query = "SELECT * FROM student_diu WHERE student_id=$sid";
  $result = mysqli_query($db, $query);
  if (mysqli_num_rows($result) > 0) {
      // output data of each row
  $record = mysqli_fetch_assoc($result);
  ?> <script>alert("<?php echo $record['paid']; ?>");</script> <?php
  return $record['paid'];
}
  else{
    return 0;
  }
}

$iap= "<h3 style='color: #333'>DoryPOS - A Crony of Point Of Sale</h3><h4 style='color: #333'>Call: +88 01758148788</h4><h5 style='color: #078830; font-weight: 700;' title='Sazal Ahamed'>Developed by Appsolic Lab</h5>";
?>
