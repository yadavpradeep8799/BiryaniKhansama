<?php
session_start();

$cust_id="";$phn_no="";
echo "First".$_SESSION["user_id"]."<br>";
if(!empty($_SESSION["loggedin"])){
	$phn_no=$_SESSION["user_id"];
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

$sql = "SELECT cust_id FROM customer where ph_no='$phn_no'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		              $cust_id=$row["cust_id"];
		
}}
echo $cust_id."<br>";
}

else{
    $cust_id=$_SESSION["user_id"];
    echo $_SESSION["user_id"]."<br>";
	$phn_no= $_POST["phno"];
	
}







$ORDER_ID ="OrderID".rand();
$CUST_ID = $cust_id;
$INDUSTRY_TYPE_ID ="";
$CHANNEL_ID = "";
$TXN_AMOUNT = $_SESSION["final_price"];

echo"sssssssssssssssssssssssssss";
echo "$ORDER_ID";
echo "<br>";
echo "$CUST_ID";
echo "<br>";
echo $_SESSION["final_price"];
echo $phn_no;
// Create an array having all required parameters for creating checksum.
?>
