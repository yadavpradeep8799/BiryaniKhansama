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
	<title>Biryani Khansama | About Us</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	<script src="ajax_signup.js"></script>
	<link href="css/About-Us_upds.css" rel="stylesheet" />
	<script>
function myload() {
  alert("username or password incorrect");
}
</script>
<script language='javascript' type='text/javascript'>
    function check(input) {
        if (input.value != document.getElementById('password').value) {
            input.setCustomValidity('Password Must be Matching.');
        } else {
            // input is valid -- reset the error message
            input.setCustomValidity('');
        }
    }
</script>
</head>
<?php
	if(isset($_SESSION["login_check"])){
	echo '<body onload="myload()">';
	unset($_SESSION["login_check"]);
	}?>
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
										<option value="saket">
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
          echo'<li><a class="btn login-btn " href="logout.php"><strong>LOGOUT</strong></a></li>';
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


<!--Main Content-->
<div class="container-fluid divcardsdiv">
	<!-- Page-Heading -->
<div class="Menu-heading">
	<h1>Menu</h1>
</div>
	<div class="cardsdiv">
		<div class="card">
  		<img class="card-img-top cardimg" src="images/demo.jpg" alt="Card image">
			  <div class="card-body">
			    <h4 class="card-title">Kababs</h4>
			    <p class="card-text">Some info about Kababs.</p>
			    <a href="javascript:myinfo(1)">See More</a>
			  </div>
		</div>
		<div class="card">
  		<img class="card-img-top cardimg" src="images/demo.jpg" alt="Card image">
			  <div class="card-body">
			    <h4 class="card-title">Biryani</h4>
			    <p class="card-text">Some info about Biryani.</p>
			    <a href="javascript:myinfo(2)">See More</a>
			  </div>
		</div>
		<div class="card">
  		<img class="card-img-top cardimg" src="images/demo.jpg" alt="Card image">
			  <div class="card-body">
			    <h4 class="card-title">Desert</h4>
			    <p class="card-text">Some info about Drinks.</p>
			    <a href="javascript:myinfo(3)">See More</a>
			  </div>
		</div>
	</div>

<!-- AJAX For Card Buttons -->
<div id="showdata">

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
	<p>&copy; Design and Developed by Pradeep</p>
    </div>
  </div>

  <div class="col-md-4 footer-right">
    <hr class="hrfooter">
    <h5>CONTACT US</h5>
    <hr class="hrfooter">
	<p>+91 8799785822</p>
    <p>110/C Rajiv Nagar </p>
    <p>Sector - 12, Gurgaon, 122001</p>
  </div>

</div>
</div>
</footer>
<script type="text/javascript">
function function2()
{
window.location.href="menu.php";
}

function myinfo(id) {
  var readrecords = id;
  $.ajax({
    url: 'About-Info.php',
    type: 'POST',
    data: {
      readrecords: readrecords
    },
    success: function(data,status) {
      $('#showdata').html(data);
    }
  });
}
</script>
</body>
</html>
