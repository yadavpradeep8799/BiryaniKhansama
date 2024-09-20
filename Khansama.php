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
	<title>Biryani Khansama | Home</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	<link href="css/index_upd.css" rel="stylesheet" />
	<script src="ajax_signup.js"></script>
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
				<button type="button" class="close" style="position:absolute; display:flex; right:20px; top:30px;" data-dismiss="modal">&times;</button>
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

						</td>
					</tr>
					<tr>
						<td></td>
						<td><p id="msg"></p></td>
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

<!--Carousel-->
<div class="col-md-12 Carousels">
  <div class="row">
  <div class="col-md-4 Carousels-left">
    <img class="nav-logo" src="img/logo.jpg" />
  </div>

  <div class="col-md-8 Carousel-right">
    <div id="slides" class="carousel slide" data-ride="carousel">
    	<ul class="carousel-indicators">
    		<li data-target="#slides" data-slide-to="0" class="active"></li>
    		<li data-target="#slides" data-slide-to="1"></li>
    		<li data-target="#slides" data-slide-to="2"></li>
    	</ul>

    	<div class="carousel-inner">
    		<div class="carousel-item active">
    			<img src="img/1.jpg">
    		</div>
    		<div class="carousel-item">
    			<img src="img/2.jpg">
    		</div>
    		<div class="carousel-item">
    			<img src="img/3.jpg">
    		</div>
    	</div>
    </div>
  </div>
</div>
</div>

<!--- Two Column Section -->
<div class="container-fluid Discover-menu padding">
<div class="row padding">
	<div class="col-lg-6 discover-box">
    <h2 class="text-center discover-heading">Discover</h2>
    <h4 class="text-center menu-heading">MENU</h4>
    <hr class="hrstyle">
    <p class="discover-text text-center">
      <strong>For those with pure food indulgence in mind, come next door and sate your desires with our ever changing internationally and seasonally inspired small plates.  We love food, lots of different food, just like you.</strong>
    </p>
    <div class="text-center"><button type="button" onClick="function2()" class="discover-link">VIEW THE FULL MENU</button></div>
	</div>
	<div class="col-lg-6">
    <div class="row">
      <div class="col-md-6">
        <img src="img/menu1.jpg" alt="img" class="img-responsive menu1">
      </div>
      <div class="col-md-6">
        <img src="img/menu2.jpg" alt="img" class="img-responsive menu2">
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <img src="img/menu3.jpg" alt="img" class="img-responsive menu3">
      </div>
      <div class="col-md-6">
        <img src="img/menu4.jpeg" alt="img" class="img-responsive menu4">
      </div>
    </div>
	</div>
</div>
</div>

<!--Services-->
<div class="col-md-12 services text-center">
  <h3 class="service-heading">Services We</h3>
  <h1 class="service-text">PROVIDE</h1>
  <hr class="hrstyle2">
  </div>
  <div class="col-md-12 boxes text-center">
    <div class="row">
      <div class="col-md-4 box1 mx-auto fadeInUp">
        <h3 class="box-heading">FREE PACKAGING</h3>
        <p>
        A resuable and protective covering for the food.
        </p>
      </div>
      <div class="col-md-4 box2 mx-auto fadeInUp">
        <h3 class="box-heading">BULK ORDER</h3>
        <p>
          Buy large quantities of One product at one time.
        </p>
      </div>
      <div class="col-md-4 box3 mx-auto fadeInUp">
        <h3 class="box-heading">FAST DELIVERY FOOD</h3>
        <p>
          Being on time, Keeping packages safe, and having friendly drivers.
        </p>
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
      <a href="https://www.facebook.com/Biryani-Khansama-103846192176632/"><i class="fab fa-facebook-f"></i></a>
      <a href="#"><i class="fab fa-instagram"></i></a>
      <a href="#"><i class="fab fa-youtube"></i></a>
      <a href="#"><i class="fab fa-twitter"></i></a>
      <div class="text-center copyright">
	  <p>&copy; Design and Developed by Pradeep Yadav. All rights reserved.</p>
      </div>
  	</div>

  	<div class="col-md-4 footer-right">
  		<hr class="hrfooter">
  		<h5>CONTACT US</h5>
  		<hr class="hrfooter">
        <p>+91 8799785822</p>

  		<p>Rajiv Nagar sec- 12, Gurgaon, 122001</p>
  	</div>

  </div>
  </div>
  </footer>
<script>
function function2()
{
	window.location.href="menu.php";
}

</script>
</body>
</html>
