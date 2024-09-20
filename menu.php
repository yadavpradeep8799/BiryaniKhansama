<?php
session_start();
if(empty($_SESSION["loggedin"])){
$x="random_user_".rand(1,100000);
$_SESSION["user_id"]=$x;
	$phn_no=$_SESSION["user_id"];
	$_SESSION["ph_no"]=$phn_no;
}
else{
$name=$_SESSION["name"];
}
require_once("dbcontroller.php");
$db_handle = new DBController();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Biryani Khansama | Menu</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	<script src="ajax_signup.js"></script>
	<link href="css/menu_upd.css" rel="stylesheet" />
	<style type="text/css">
	.stickyCart-item {position: relative; top: 0; right: 0; left: 0;}
	.content-table {border-collapse: collapse;font-size: 0.9em; min-width: 100%; padding-bottom: 5px;}
	.content-table thead tr {background-color: #E8C652; text-align: center; padding-top: 5px; font-family: 'ZCOOL XiaoWei', serif; font-size: 18px;}
	.fa-times {color: red;}
	.fa-times:hover {cursor: pointer;}
	.fa-trash-alt {font-size: 23px; cursor: pointer;}
	.fa-trash-alt:hover {font-size: 23px; cursor: pointer; color: #7E7E7E;}
	</style>
	<script>
	function showEditBox(editobj,id) {
		$('#frmAdd').hide();
		$(editobj).prop('disabled','true');
		var currentMessage = $("#message_" + id + " .message-content").html();
		var editMarkUp = '<textarea rows="5" cols="80" id="txtmessage_'+id+'">'+currentMessage+'</textarea><button name="ok" onClick="callCrudAction(\'edit\','+id+')">Save</button><button name="cancel" onClick="cancelEdit(\''+currentMessage+'\','+id+')">Cancel</button>';
		$("#message_" + id + " .message-content").html(editMarkUp);
	}
	function cancelEdit(message,id) {
		$("#message_" + id + " .message-content").html(message);
		$('#frmAdd').show();
	}
	function cartAction(action,item_id) {
		var queryString = "";
		if(action != "") {
			switch(action) {
				case "add":
					queryString = 'action='+action+'&item_id='+ item_id+'&quantity='+$("#qty_"+item_id).val();
				break;
				case "remove":
					queryString = 'action='+action+'&item_id='+ item_id;
				break;
				case "empty":
					queryString = 'action='+action;
				break;
			}
		}
		jQuery.ajax({
		url: "ajax_action.php",
		data:queryString,
		type: "POST",
		success:function(data){
			$("#cart-item").html(data);
			if(action != "") {
				switch(action) {
					case "add":
						$("#add_"+item_id).show();

					break;
					case "remove":
						$("#add_"+item_id).show();

					break;
					case "empty":
						$(".btnAddAction").show();
						$(".btnAdded").hide();
					break;
				}
			}
		},
		error:function (){}
		});
	}
	</script>
</head>
<body>

	<!--modal-->
	<div class="modal fade" id="LoginModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog " role="document" >
			<div class="modal-content ">
				<div class="modal-header mx-auto">
					<h5 class="modal-title " id="exampleModalLabel">Sign In</h5>
				</div>
				<div class="modal-body">
					<form name="login" action="login_check.php" method="post">
						<table align=center cellpadding=10px>
							<tr>
									<td class="modalBodyHeadings">
										Phone No:
									</td>
									<td>
										<span class=" prenumber" id="basic-addon1">+91</span><span><input type=text name=ph_no placeholder="Enter Phone No:" pattern="[789][0-9]{9}" required></span>
									</td>
							</tr>
							<tr>
									<td class="modalBodyHeadings">
										Password:
								  </td>
									<td>
										<input type=password class=passwordlength name=password placeholder="Enter Password:" required>
									</td>
								</tr>
						</table>

						<div class='buttoncenter text-center'>
								<button type='submit' class='loginbutton'>Login</button>
						</div>

					</form>
				</div>
				<div class="modal-footer">
					<div class=" mx-auto">
						<strong>Not a member? <a href="#" data-toggle="modal" data-target="#signupmodel" data-dismiss="modal">Sign Up</a></strong>
				  </div>
			</div>
			</div>
		</div>
	</div>

	<div class="modal fade " data-backdrop="static" data-keyboard="false" id="signupmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content ">
			<div class="modal-header mx-auto ">
				<h5 class="modal-title mx-auto " id="exampleModalLabel">Sign Up</h5>
			</div>
			<div class="modal-body">

				<form id="registration">
					<table align=center cellpadding=10px >
						<tr>
							<td class="modalBodyHeadings">
								Full Name:
							</td>
							<td>
								<input type=text class=passwordlength  name="" id="fullname"  required>
							</td>
						</tr>
						<tr>
							<td class="modalBodyHeadings">
								Phone No:
							</td>
							<td>
								<span  class=" prenumber" id="basic-addon1">+91</span><span><input type=text name="" id="phno" maxlength="10" pattern="[789][0-9]{9}" title="Phone number with 7-9 and remaing 9 digit with 0-9" required></span>
							</td>
						</tr>
						<tr>
							<td class="modalBodyHeadings">
							Create Password:
							</td>
							<td>
								<input type=password name="" id="password" class=passwordlength required>
							</td>
						</tr>
						<tr>
							<td class="modalBodyHeadings">
								Confirm Password:
							</td>
							<td>
								<input type=password id="confirm_passowrd" class=passwordlength  oninput="check(this)" required>
							</td>
						</tr>
						<tr>
							<td class="modalBodyHeadings">
								Email Id:
							</td>
							<td>
								<input type=email class=passwordlength name="" id="email" required>
							</td>
						</tr>
						<tr>
							<td class="modalBodyHeadings">
								State:
							</td>
							<td>
									<select class="stateinput" name="" id="state" onchange="myfun(this.value)">
									<option value="">Select State</option>
                                    <option value="Haryana">Haryana</option>
                                    <option value="Delhi NCR">Delhi NCR</option>
									</select>
							</td>
						</tr>
						<tr>
								<td class="modalBodyHeadings">
									City:
								</td>
								<td>
									<select class="cityinput" id="city">

									<option value="">Select City</option>

										</select>

								</td>
							</tr>
							<tr>
						<td class="modalBodyHeadings">
							Check Locality:
						</td>
						<td>

						<input class="localityInput" list="locality" id="locality1"  placeholder="Check Your Locality:">
  								<datalist class="localitydatalist" id="locality">
    								<option value="Rajeev Nagar">
    								<option value="Sector 17">
    								<option value="Sector 14">
    								<option value="Sector 4">
    								<option value="Sector 5">
											<option value="Saket">
								  </datalist>
								  <p id="msg"></p>
						</td>
					</tr>
					</table>

					<div class="buttoncenter text-center ">
							<button type="submit" onclick="myFunction()" class="loginbutton">Register</button>
							</div>
							<div class="close"><button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<div class=" mx-auto">
					<small >Already a member? <strong><a href="#" data-toggle="modal" data-target="#LoginModel" data-dismiss="modal">Log In</a></strong></small>
				</div>
			</div>
		</div>
	</div>
</div>


	<!--Navbar-->
	<nav class="navbar navbar-expand-md sticky-top">
	<div class="container-fluid">
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link active" href="Khansama.php">HOME</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="menu.php">MENU</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="About-Us.php">ABOUT US</a>
				</li>
				<?php if(!empty($_SESSION["loggedin"])){
			?>
			<li class="nav-item">
				<a class="nav-link" href="your_order.php">YOUR ORDERS</a>
			</li><?php
		}
?>
	      <li>
	        <?php
	        if(!empty($_SESSION["loggedin"])){
	          echo'<li><a class="btn login-btn" href="logout.php"><strong>LOGOUT</strong></a></li>';
	        }
	        else{
	          echo '<li><button class="btn login-btn" type="button" name="button" data-toggle="modal" data-target="#LoginModel"><strong>LOGIN</strong></button></li>';
	        }
	        ?>
	      </li>
			</ul>
		</div>
	</div>
	</nav>

<!--Carousel-->
<div class="col-md-12 Carousels">
  <div class="row">
		<section id="cf4">
			<img class="first" src="Cover/1.jpg">
			<img class="second" src="Cover/2.jpg">
			<img class="third" src="Cover/3.jpg">
			<img class="forth" src="Cover/4.jpg">
		</section>
		<div class="Carousels-left">
			<img class="nav-logo" src="img/logo.jpg">
		</div>
</div>
</div>

<!--Menu-->
<div class="col-md-12 Main-menu text-center">
	<div class="row">
	<div class="menu-left">

<div class="Kababs div-padding">
	<div class="col-md-12 text-center">
		<h2 class="headings">Kababs</h2>
		<hr class="hr1">
	</div>


<div class="row mx-auto">

	<?php
	$product_array = $db_handle->runQuery("SELECT * FROM item");
	if (!empty($product_array)) {
	foreach($product_array as $key=>$value){
			$cat=$product_array[$key]["category_id"];
			if($cat==3)
			{
	?>

	<div class="Kababdiv cardsdiv">
		<div class="cards">
			<img class="card-img-top" src="images/mutton.jpg">
			<div class="card-body">
				<h6 class="card-title"><?php echo $product_array[$key]["item_name"];?></h6>
				<div class="row mx-auto quantboth">
				<select class="quantselect" id="qty_<?php echo $product_array[$key]["item_id"]; ?>" name="quantity">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				</select>
				<h6 class="cart-price"><?php echo "Rs ".$product_array[$key]["price"]; ?></h6>
				</div>
				<p class="card-text">Its a mouth watering dish and good for start.</p>
				<div class="row card-content">

					<input type="button" id="add_<?php echo $product_array[$key]["item_id"]; ?>" value="Add" class="btn btn-success cart-button" onClick = "cartAction('add','<?php echo $product_array[$key]["item_id"]; ?>')"  />

				</div>
			</div>
		</div>
	</div>

	<?php
	}
	}
	}
	?>

</div>
</div>

<div class="Hydrabadi-Biryani div-padding">
	<div class="col-md-12 text-center">
		<h2 class="headings">Hydrabadi Biryani</h2>
		<hr class="hr1">
	</div>

	<div class="row mx-auto">

		<?php
		$product_array = $db_handle->runQuery("SELECT * FROM item");
		if (!empty($product_array)) {
		foreach($product_array as $key=>$value){
				$cat=$product_array[$key]["category_id"];
				if($cat==1)
				{
		?>

	<div class="Highdiv cardsdiv">
		<div class="cards">
			<img class="card-img-top" src="images/big_biryani-10300.jpg">
			<div class="card-body">
				<h6 class="card-title"><?php echo $product_array[$key]["item_name"];?></h6>
				<br>
				<div class="row mx-auto quantboth">
				<select class="quantselect" id="qty_<?php echo $product_array[$key]["item_id"]; ?>" name="quantity">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				</select>
				<h6 class="cart-price"><?php echo "Rs ".$product_array[$key]["price"]; ?></h6>
				</div>
				<p class="card-text">Its a mouth watering dish and good for start.</p>
				<div class="row card-content">
					<input type="button" id="add_<?php echo $product_array[$key]["item_id"]; ?>" value="Add" class="btn btn-success cart-button" onClick = "cartAction('add','<?php echo $product_array[$key]["item_id"]; ?>')"  />
				</div>
			</div>
		</div>
	</div>

	<?php
	}
	}
	}
	?>

</div>
</div>

<div class="Lucknowi-Biryani div-padding">
	<div class="col-md-12 text-center">
		<h2 class="headings">Lucknowi Biryani</h2>
		<hr class="hr1">
	</div>

	<div class="row mx-auto">

		<?php
		$product_array = $db_handle->runQuery("SELECT * FROM item");
		if (!empty($product_array)) {
		foreach($product_array as $key=>$value){
				$cat=$product_array[$key]["category_id"];
				if($cat==2)
				{
		?>

	<div class="Luckdiv cardsdiv">
		<div class="cards">
			<img class="card-img-top" src="images/mutton.jpg">
			<div class="card-body">
				<h6 class="card-title"><?php echo $product_array[$key]["item_name"];?></h6>
				<div class="row mx-auto quantboth">
				<select class="quantselect" id="qty_<?php echo $product_array[$key]["item_id"]; ?>" name="quantity">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				</select>
				<h6 class="cart-price"><?php echo "Rs ".$product_array[$key]["price"]; ?></h6>
				</div>
				<p class="card-text">Its a mouth watering dish and good for start.</p>
				<div class="row card-content">
					<?php
						$in_session = "0";
						if(!empty($_SESSION["cart_item"])) {
							$session_code_array = array_keys($_SESSION["cart_item"]);
								if(in_array($product_array[$key]["item_id"],$session_code_array)) {
								$in_session = "1";
								}
						}
					?>

					<input type="button" id="add_<?php echo $product_array[$key]["item_id"]; ?>" value="Add" class="btn btn-success cart-button" onClick = "cartAction('add','<?php echo $product_array[$key]["item_id"]; ?>')"  />

				</div>
			</div>
		</div>
	</div>

	<?php
	}
	}
	}
	?>

</div>
</div>

<div class="Drinks div-padding">
	<div class="col-md-12 text-center">
		<h2 class="headings">Drinks</h2>
		<hr class="hr1">
	</div>

	<div class="row mx-auto">

		<?php
		$product_array = $db_handle->runQuery("SELECT * FROM item");
		if (!empty($product_array)) {
		foreach($product_array as $key=>$value){
				$cat=$product_array[$key]["category_id"];
				if($cat==4)
				{
		?>

	<div class="Drinkdiv cardsdiv">
		<div class="cards">
			<img class="card-img-top" src="images/mutton.jpg">
			<div class="card-body">
				<h6 class="card-title"><?php echo $product_array[$key]["item_name"];?></h6>
				<div class="row mx-auto quantboth">
				<select class="quantselect" id="qty_<?php echo $product_array[$key]["item_id"]; ?>" name="quantity">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				</select>
				<h6 class="cart-price"><?php echo "Rs ".$product_array[$key]["price"]; ?></h6>
				</div>
				<p class="card-text">Its a mouth watering dish and good for start.</p>
				<div class="row card-content">
					<?php
						$in_session = "0";
						if(!empty($_SESSION["cart_item"])) {
							$session_code_array = array_keys($_SESSION["cart_item"]);
								if(in_array($product_array[$key]["item_id"],$session_code_array)) {
								$in_session = "1";
								}
						}
					?>

					<input type="button" id="add_<?php echo $product_array[$key]["item_id"]; ?>" value="Add" class="btn btn-success cart-button" onClick = "cartAction('add','<?php echo $product_array[$key]["item_id"]; ?>')"  />

				</div>
			</div>
		</div>
	</div>

	<?php
	}
	}
	}
	?>

</div>
</div>

	</div>

	<div class="stickyCart menu-cart">
		<div class="stickyCart-item">
			<div id="cart-item">
			</div>
		</div>
	</div>

</div>
</div>

<!--- Footer -->
<footer>
<div class="container-fluid padding">
<div class="row text-center padding">
	<div class="col-md-8 footer-left">
		<hr class="hrfooter">
		<h5>FOLLOW US</h5>
		<hr class="hrfooter">
		<a href="#"><i class="fab fa-facebook-f"></i></a>
		<a href="#"><i class="fab fa-instagram"></i></a>
		<a href="#"><i class="fab fa-youtube"></i></a>
		<a href="#"><i class="fab fa-twitter"></i></a>
		<div class="text-center copyright">
		<p>&copy; Design and Developed by Pradeep.</p>
		</div>
	</div>

	<div class="col-md-4 footer-right">
		<hr class="hrfooter">
		<h5>CONTACT US</h5>
		<hr class="hrfooter">
		<p>+91 8799785822</p>
		<p>110/C Rajiv Nagar</p>
		<p>Sector - 12, Gurgaon, 122001</p>
	</div>

</div>
</div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="JS/jquery.sticky.js"></script>
<script>
  $(document).ready(function(){
    $(".stickyCart").sticky({topSpacing:52,bottomSpacing:209});
		$(".stickyCart").css("paddingRight", "28%");
		$(".stickyCart").css("paddingTop", "10px");
  });
</script>
<script>
$(document).ready(function () {
	cartAction('','');
})
</script>

</body>
</html>
