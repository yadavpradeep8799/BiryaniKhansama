<?php
session_start();
$servername = "localhost";
$username = "root_restaurant";
$password = "root1234";
$dbname = "yadav_restaurant";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$ph_no = $_POST['ph_no'];
      $password =$_POST['password']; 
	  $sql1 = "SELECT * FROM login where ph_no='$ph_no' and password='$password'";
$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) {
    // output data of each row
    while($row = $result1->fetch_assoc()) {

	$_SESSION["loggedin"]="T";
		$_SESSION["user_id"]="$ph_no";
		$_SESSION["name"]=$full_name;
        header("Location: index.php");
    }
} else {
    $_SESSION["login_check"]="F";
	header("Location: index.php");
}




$conn->close();
?>