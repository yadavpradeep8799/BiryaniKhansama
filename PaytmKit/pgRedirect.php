<?php
session_start();
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");
$order_time=$_POST["order_time"];
$_SESSION["order_time"]=$order_time;
if($order_time=="Later"){
	$later_time=$_POST["later_time"];
	$later_date=$_POST["later_date"];
	$_SESSION["order_time"]=$later_date." ".$later_time;

}
$_SESSION["name"]="";
$checkSum = "";$fullname="";
$paramList = array();
$cust_id="";
$phn_no=$_SESSION["user_id"];
$_SESSION["phone_no"]=$phn_no;
if(!empty($_SESSION["loggedin"])){
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "vishal_restaurant";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT cust_id,full_name FROM customer where ph_no='$phn_no'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		              $cust_id=$row["cust_id"];
						$fullname=$row["full_name"];
		
}}
$name=$fullname;
$_SESSION["name"]=$name;

}
else{
	$cust_id=$_SESSION["user_id"];
	$phn_no= $_POST["phno"];
	$_SESSION["phone_no"]=$phn_no;
}





$TXN_AMOUNT="";
$ORDER_ID = "OrderID".rand();
$_SESSION["order_id"]=$ORDER_ID;
$_SESSION["address"]=$_POST["al1"]." ".$_POST["al2"];
$CUST_ID = $cust_id;
$_SESSION["customer_id"]=$CUST_ID;
$INDUSTRY_TYPE_ID ="Retail";
$CHANNEL_ID = "WEB";
if(isset($_SESSION["final_price_fn"])){
	$TXN_AMOUNT=$_SESSION["final_price_fn"];
}
else{
$TXN_AMOUNT = $_SESSION["final_price"];
}

// Create an array having all required parameters for creating checksum.
$paramList["MID"] = PAYTM_MERCHANT_MID;
$paramList["ORDER_ID"] = $ORDER_ID;
$paramList["CUST_ID"] = $CUST_ID;
$paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
$paramList["CHANNEL_ID"] = $CHANNEL_ID;
$paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
$paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;


$paramList["CALLBACK_URL"] = "http://localhost:8080/myPHP/BiryaniKhansama/PaytmKit/pgResponse.php"; 
$paramList["MSISDN"] =$phn_no; //Mobile number of customer
/*
$paramList["EMAIL"] = $EMAIL; //Email ID of customer
$paramList["VERIFIED_BY"] = "EMAIL"; //
$paramList["IS_USER_VERIFIED"] = "YES"; //

*/

//Here checksum string will return by getChecksumFromArray() function.
$checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);

?>
<html>
<head>
<title>Merchant Check Out Page</title>
</head>
<body>
	<center><h1>Please do not refresh this page...</h1></center>
		<form method="post" action="<?php echo PAYTM_TXN_URL ?>" name="f1">
		<table border="1">
			<tbody>
			<?php
			foreach($paramList as $name => $value) {
				echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
			}
			?>
			<input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">
			</tbody>
		</table>
		<script type="text/javascript">
			document.f1.submit();
		</script>
	</form>
</body>
</html>