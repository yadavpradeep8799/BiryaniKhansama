<?php
session_start();
$cust_id="";$phn_no="";$fullname="";$name="";
$status="Order Received";
$fp=$_SESSION["final_price"];
$offer_used="False";
$address=$_SESSION["address"];
$order_time=$_SESSION["order_time"];

function send_message($ph_no,$order_id,$name){
	$username = "yadavpradeep8799@gmail.com";
	$hash = "ab359348d28c2b8e639325ef6c4c02af4027c40ac3842af102cdc017f58b7800";

	// Config variables. Consult http://api.textlocal.in/docs for more info.
	$test = "0";

	// Data for text message. This is the text message data.
	$sender = "TXTLCL"; // This is who the message appears to be from.
	$numbers = $ph_no; // A single number or a comma-seperated list of numbers
	$message = "Thank You ".$name." for Ordering from Biryani Khansama your Order Id is ".$order_id;
	// 612 chars or less
	// A single number or a comma-seperated list of numbers
	$message = urlencode($message);
	$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
	$ch = curl_init('http://api.textlocal.in/send/?');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch); // This is the result from the API
	curl_close($ch);}

function send_message1($ph_no,$name,$order_id,$order,$address){
	$username = "yadavpradeep8799@gmail.com";
	$hash = "ab359348d28c2b8e639325ef6c4c02af4027c40ac3842af102cdc017f58b7800";

	// Config variables. Consult http://api.textlocal.in/docs for more info.
	$test = "0";

	// Data for text message. This is the text message data.
	$sender = "TXTLCL"; // This is who the message appears to be from.
	$numbers =918799785822; // A single number or a comma-seperated list of numbers
	$t=date("H:i:s");
	$d=date("Y/m/d");
	$order_date=$t." ".$d;
	$message = "New Order has been placed Order ID: ".$order_id." Name: ".$name." Address: ".$address." Time: ".$order_date."
	 Order: ".$order;
	// 612 chars or less
	// A single number or a comma-seperated list of numbers
	$message = urlencode($message);
	$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
	$ch = curl_init('http://api.textlocal.in/send/?');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch); // This is the result from the API
	curl_close($ch);
		}



    $phn_no=$_SESSION["phone_no"];
    $cust_id=$_SESSION["customer_id"];

$name=$_SESSION["name"];





	$order_item=$_SESSION["cart_item"];
	
	$string="";
foreach ($order_item as $key => $subArr) {
    unset($subArr['image']);
    $order_item[$key] = $subArr;  
}
	
foreach ($order_item as $key => $subArr) {
    unset($subArr['code']);
    $order_item[$key] = $subArr;  
}	

$keys = array_keys($order_item);
for($i = 0; $i < count($order_item); $i++) {
    foreach($order_item[$keys[$i]] as $key => $value) {
		$string=$string.nl2br("\n".$key.": ".$value);
    }
}	
	
	
	
	
	
	
	
	
	
	$link = mysqli_connect("localhost", "root_restaurant", "root1234", "yadav_restaurant");
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Prepare an insert statement
$sql = "INSERT INTO orders (cust_id,name,order_id,item_id,item_qty,ordered_item,amount,phone_no,transaction_id,order_date,order_late,delivery_address,payment,offer_used,status) VALUES (?,?, ?, ?,?,?,?,?,?,?,?,?,?,?,?)";
 
if($stmt = mysqli_prepare($link, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "sssssssssssssss",$cust_id,$name,$order_id,$item_id,$item_qty,$order_item,$fp,$phn_no,$rd,$order_date,$order_time,$address,$payment,$offer_used,$status);
    
    // Set parameters
	$address=$_SESSION["address"];
	if(isset($_SESSION["final_price_fn"])){
		$fp=$_SESSION["final_price_fn"];	
	}
	$rd="TrId".rand();
	$order_id=$_SESSION["order_id"];
	date_default_timezone_set("Asia/Calcutta");
	$t=date("H:i:s");
	$d=date("Y/m/d");
	$order_date=$t." ".$d;
	$payment="PAYTM";
	$item_id=$_SESSION["item_ids"];
	$item_qty=$_SESSION["item_qty"];
    $order_item=$string;
    
	if(isset($_SESSION["offer_used"])){
		$offer_used="True";		
	}
	
	
	
	
    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
		
        send_message($phn_no,$order_id,$name);
		send_message1($phn_no,$name,$order_id,$string,$address);
    } else{
        echo "ERROR: Could not execute query: $sql. " . mysqli_error($link);
    }
} else{
    echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
}
 
// Close statement
mysqli_stmt_close($stmt);

 
// Close connection
mysqli_close($link);


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<title>Thank You</title>
</head>

<body>
<?php
unset($_SESSION["cart_item"]);
	unset($product_array);
	unset($_SESSION["final_price"]);
	unset($_SESSION["final_price_fn"]);
	unset($_SESSION["offer_used"]);
	?>
	<div class="alert alert-success text-center">
  <strong>Thank You For Ordering Food .......</strong>
</div>
<script>
        var timer = setTimeout(function() {
            window.location='your_order.php';
        }, 3000);
    </script>
</body>
</html>
