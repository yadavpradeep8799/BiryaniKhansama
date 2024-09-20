<?php
session_start();
?>
<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=ZCOOL+XiaoWei" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>

<body>
<?php
ob_clean();
require_once("dbcontroller.php");
$db_handle = new DBController();

if(!empty($_POST["action"])) {
switch($_POST["action"]) {
	case "add":

		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM item WHERE item_id='" . $_POST["item_id"] . "'");

			$itemArray = array($productByCode[0]["item_id"]=>array('name'=>$productByCode[0]["item_name"], 'item_id'=>$productByCode[0]["item_id"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"]));


			if(!empty($_SESSION["cart_item"])) {
				$array_item=$_SESSION["cart_item"];
				$x=array_column($array_item,'item_id');
				if(in_array($productByCode[0]["item_id"],$x)) {
					foreach($_SESSION["cart_item"] as $k => $v) {

							if($productByCode[0]["item_id"] == $v["item_id"]) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);

				}
			}



			else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {


					if($_POST["item_id"] == $v["item_id"])
					{

				  unset($_SESSION["cart_item"][$k]); //error is here

					}
					if(empty($_SESSION["cart_item"]))
					{
						unset($_SESSION["cart_item"]);

}
			}

		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;

}
}
?>

<table class="content-table" cellpadding="6">
<?php
				if(empty($_SESSION["cart_item"])){
					?>
					<div style="padding-top:40%;color:grey;">
						<span style="font-size:124px;"><i class="fas fa-shopping-basket"></i></span></br>
						<label style="font-family: sans-serif;letter-spacing: 2px;color: black;">Your cart is currently empty.</label>
					</div>
					<?php
				}
				?>
<form action="checkout.php" method="post">

<?php
if(isset($_SESSION["cart_item"])){
    $item_total = 0;
?>

<thead>
	<tr>
	<th><strong>Name</strong></th>
	<th><strong>Quantity</strong></th>
	<th><strong>Price</strong></th>
	<th></th>
	</tr>
</thead>

<tbody>
<?php
    foreach ($_SESSION["cart_item"] as $item){
		?>
				<tr>
				<td>
					<h6><strong><?php echo $item["name"]; ?></strong></h6>
				</td>
				<td>
					<?php echo $item["quantity"]; ?>
				</td>
				<td>
					<?php echo "Rs ".$item["price"]*$item["quantity"]; ?>
				</td>
				<td>
					<a onClick="cartAction('remove','<?php echo $item["item_id"]; ?>')" class="btnRemoveAction cart-action"><i class="fas fa-times"></i></a>
				</td>
			</tr>

				<?php
        	$item_total += ($item["price"]*$item["quantity"]);
					$_SESSION["final_price"]=$item_total;
			
					}
					?>

					<tr>
						<td>
							<a onclick="cartAction('empty')"><i class="fas fa-trash-alt"></i></a>
						</td>
						<td>
							<button onclick="function1()" class="btn btn-success">Checkout</button>
						</td>
						<td>
							<strong>Total:</strong> <?php echo "Rs ".$item_total; ?>
						</td>
						<td>
						</td>
						</tr>

</tbody>
</form>
</table>


    <?php
				}
		?>
<script>
function function1(){
window.location.href = "checkout.php";
}
</script>

</body>
</html>
