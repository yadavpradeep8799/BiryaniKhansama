<?php
if(isset($_POST['submit'])){ 
//------------------------------------Image Upload------------	
	
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

	$image=$_FILES["fileToUpload"]["name"];
	
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $msg="The file has been uploaded";
    } else {
        $msg="Sorry, there was an error uploading your file.";
    }
}	
	
	
	
//------------------image upload-----------------------	
	
	
	
$link = mysqli_connect("localhost", "root_restaurant", "root1234", "yadav_restaurant");
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Prepare an insert statement
$sql = "INSERT INTO item(category_id,item_name,price,image) VALUES (?,?, ?, ?)";
 
if($stmt = mysqli_prepare($link, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "ssss", $c_id,$item_name, $price, $image);
    
    // Set parameters
	$c_id=$_POST["cid"];
    $item_name = $_POST["iname"];
    $price = $_POST["price"];
    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
       
    } else{
        echo "ERROR: Could not execute query: $sql. " . mysqli_error($link);
    }
} 
 
// Close statement
mysqli_stmt_close($stmt);

 
// Close connection
mysqli_close($link);
}


?>



<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add Product</title>
</head>
<body>
<h1 align="center" style="background-color:#F2BC50;">Product Add</h1>

<table>
 
  <form name="f1" action="" method="post" enctype="multipart/form-data">
  
 <tr><td>Category Name</td><td>
   <select name="cid">
  
<?php
   
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

$sql = "SELECT cat_name,cat_id FROM category";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
						$cat_id=$row["cat_id"];
		              $cat_name=$row["cat_name"];
		echo "<option value='".$cat_id."'>".$cat_name." </option>";
		              
}}
	  	  
	  ?>
    
  </select></td></tr>
  
  
    <tr><td>Item Name</td><td>
    <input type="text" name="iname" placeholder="item name ..." required></td></tr>

    <tr><td>Price</td><td>
    <input type="text" name="price" placeholder="price..." required></td></tr>
 
    <tr><td>Image</td><td>
    <input type="file" name="fileToUpload" id="fileToUpload"></td></tr>

    <tr><td>
    <input type="submit" value="submit" name="submit"></td></tr>
  </form>
</div>
</body>
</html>