
<?php 
session_start();
if(isset($_POST['submit'])){
$link = mysqli_connect("localhost", "root_restaurant", "root1234", "yadav_restaurant");
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Prepare an insert statement
$sql = "INSERT INTO offer (offer_code, offer_desc, offer_percent,date_created, date_expired) VALUES (?,?, ?, ?,?)";
 
if($stmt = mysqli_prepare($link, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "sssss",$offer_code, $offer_desc,$offer_percent, $date_created, $date_expired);
    
    // Set parameters
	date_default_timezone_set("Asia/Calcutta");
	
$d1=date("Y-m-d");
$d2=$_POST["date"];

    $offer_code= $_POST["code"];
    $offer_desc = $_POST["desc"];
	$offer_percent = $_POST["per"];
    $date_created=$d1; 
     $date_expired=$d2;
	
    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        header("Location: offer.php");
    } else{
        echo "ERROR: Could not execute query: $sql. " . mysqli_error($link);
    }
} else{
    echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
}
 
// Close statement
mysqli_stmt_close($stmt);

 
// Close connection
mysqli_close($link);}




?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<h1 align="center">Offer Create</h1>
 <table class="table  table-hover" align="center" cellpadding="5px">
  <form name="f1" action="" method="post">
 <tr><td>
  <label for="offercode"><b>Offer Code *</b></label></td>
    <td><input type="text" id="code" name="code" placeholder="Offer Code.." required></td></tr>
	
	 <tr><td>
    <label for="offerdesc"><b>Offer Description *</b></label></td>
   <td> <input type="text" id="desc" name="desc" placeholder="Offer Description.." required></td></tr>

   <tr><td>
     <label for="Price"><b>Discount Price Percentage*</b></label></td><td>
    <input type="text" id="per" name="per" placeholder="Discount Percentage.." required></td></tr>
    
     
    <tr><td>
     <label for="dateexpired"><b>Code Expiry Date*</b></label></td><td>
    <input type="date" id="date" name="date"  required></td></tr>

   <tr><td> <input type="submit" value="Submit" name="submit"></td></tr>
  </form>

</body>
</html>