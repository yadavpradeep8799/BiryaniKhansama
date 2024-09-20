<?php
session_start();
date_default_timezone_set("Asia/Calcutta");
$servername = "localhost";
$username = "root_restaurant";
$password = "root1234";
$dbname = "yadav_restaurant";

extract($_POST);
// Create connection
if(!empty($_POST["promo"])){
    $promo=$_POST["promo"];
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

     $sql = "SELECT * FROM offer where offer_code='$promo'";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $per=$row["offer_percent"];
                    $exp=$row["date_expired"];
                    $disc=$row["offer_percent"];
                        $d=date("Y/m/d");
                        $date1=date_create("$d");
                        $date2=date_create("$exp");
                        $diff=date_diff($date1,$date2);
                        $diff1=$diff->format("%R%a");
                        $diff2=(int)$diff1;
                    if($diff2>=1){
                        $discount=($disc/100)*$_SESSION["final_price"];
                         $_SESSION["final_price_fn"]=$_SESSION["final_price"]-$discount;
                         $_SESSION["offer_used"]="True";
                         echo "1".",".$_SESSION["final_price_fn"]; 
                    }
                  else{
                      echo "0";
                  }
                }
            } else {
                echo "0";
            }
            $conn->close();
        }
?>