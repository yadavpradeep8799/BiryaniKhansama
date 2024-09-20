<?php
session_start();
  // Authorisation details.
  $item_ids="";
  $item_qty="";
  foreach ($_SESSION["cart_item"] as $item){
  $item_ids=$item_ids.$item["item_id"]."-";
  $_SESSION["item_ids"]=$item_ids;
  $item_qty=$item_qty.$item["quantity"]."-";
  $_SESSION["item_qty"]=$item_qty;
  }
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Biryani Khansama | Checkout</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
  <script src="ajax_signup.js"></script>
  <link href="css/checkouts.css" rel="stylesheet" />

<script>
  function pay(id){
    if(id=="paytm"){
      $("#checkout_form").attr("action", "PaytmKit/pgRedirect.php");
}
else{

}
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
  <script>
  function myfun1(datavalue){

    console.log(datavalue);
    if(datavalue=="Later") {

      var table = document.getElementById("myTable");
  var row_date = table.insertRow(6);
  var row_time = table.insertRow(7);
  var cell_time1 = row_time.insertCell(0);
  var cell_time2 = row_time.insertCell(1);
  var cell_date1 = row_date.insertCell(0);
  var cell_date2 = row_date.insertCell(1);
  cell_time1.innerHTML = "Specify Time";
  cell_time2.innerHTML = "<input type='time' id='later_time' name ='later_time' class='form-control'>";
  cell_date1.innerHTML = "Specify Date";
  cell_date2.innerHTML = "<input type='date' id='later_date' name ='later_date' class='form-control'>";


    }
  else{
    document.getElementById("myTable").deleteRow(6);
    document.getElementById("myTable").deleteRow(6);
  }
  }
  </script>
</head>
<body>

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
        <li class="nav-item">
          <a class="nav-link" href="your_order.php">YOUR ORDERS</a>
        </li>
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
<div id="locality_check" class="text-center">
<br>
<h2 class="text-center">Location Check</h2>
<input class="localityInput" list="locality" id="locality1"  placeholder="Check Your Locality:" required>
  								<datalist class="localitydatalist" id="locality">
    								<option value="Rajeev Nagar">
    								<option value="Sector 17">
    								<option value="Sector 14">
    								<option value="Sector 4">
    								<option value="Sector 5">
                    <option value="Saket">

                    </option>
								  </datalist>
				<p id="loc" style="color:red" align="center"></p>
        <button onclick="check1()" type="button" class="btn btn-success">Check</button>
</div>
<div class="checkout-table text-center" id="checkout1" style="display:none">
    <h3>Enter Your Delivery Address</h3>
    <form action="cod.php" method="post" id="checkout_form">
    <table class="mx-auto" cellpadding="5px" id="myTable">

        <tr>
          <td>
            Address Line 1
          </td>
          <td>
            <input type="text" name="al1" required class="form-control">
          </td>
        </tr>

        <tr>
          <td>
            Address Line 2
          </td>
          <td>
            <input type="text" name="al2" required class="form-control">
          </td>
        </tr>

        <tr>
          <?php  if(empty($_SESSION["loggedin"])){ ?>
            <td>
              Phone No
            </td>
            <td>
              <input type="text" class="form-control" name="phno" pattern="[789][0-9]{9}" maxlength="10" title="Phone number with 7-9 and remaing 9 digit with 0-9" required>
            </td>
            <?php }?>
        </tr>
       <tr>
          <td>
            Apply Promocode
          </td>
          <td>
          <input type="text" name="promo" id="promo" class="form-control">
          </td>
          <td>
          <button type="button" class="btn btn-danger" onclick="check_promo()">Check</button><td><span id="prm" style="font-weight:900"></span></td>
          </td>
        </tr>
        <tr>
        <td>
           Final Amount
        </td>
          <td>
            <br>
            <p id="ndisc" style="font-weight:700"><?php echo $_SESSION["final_price"];?> Rs</p>
        </td>
        <td>
            <br>
            <p id="disc" style="font-weight:700;display:none"></p>
        </td>
        </tr>
        <tr>
          <td>
            Order Time
          </td>
          <td>
          <select class="form-control" name="order_time" id="time" onchange="myfun1(this.value)">
									<option value="">Select Time</option>
                                    <option value="Now">Now</option>
                                    <option value="Later">Later</option>
									</select>
          </td>
        </tr>
    </table>

    <div class="PayOptions">
      <h6>Payment Options</h6>
      <table class="mx-auto" cellpadding="5px">
        <tr>
          <td> <input type="radio" name="payment" value="COD" id="cod" checked onclick="pay(this.id)" /> </td>
          <td>Cash On Delivery</td>
        </tr>
        <tr>
          <td> <input type="radio" name="payment" id="paytm" value="Paytm" onclick="pay(this.id)"/> </td>
          <td>Paytm</td>
        </tr>
        <tr>
          <td></td>
          <td>
            <input type="submit" value="Continue" class="submit-button"/>
          </td>
        </tr>
      </table>
    </div>

    </form>
</div>
<script>
function check_promo(){
 var promo= $("#promo").val();
  $.ajax({
            url: "promo_check.php",
            type: "POST",
            async: false,
            data: {  promo:promo
            },
            success: function (result) {
              var data = result.split(",");
                resultt=data[0];
                if(resultt=="1"){
                  document.querySelector('#prm').textContent="Valid";
                  document.querySelector('#prm').style.color="Green";
                  document.querySelector('#ndisc').style.textDecoration="line-through";
                  document.querySelector('#disc').style.display="block";
                  document.getElementById('disc').innerHTML=data[1];
                }
                else{

                  document.querySelector('#prm').textContent="Not Valid";
                  document.querySelector('#prm').style.color="Red";

                }
            }
        });
}
</script>
<script>
function Validation(){
        var flag=0;
        const city1=["Rajeev Nagar","Sector 14","Sector 17","Sector 5","Sector 4","Saket"];
   let value=document.getElementById("locality1").value;

   for(let i=0;i<city1.length;i++){
    if(value==city1[i]){
          flag=1;
    }
   }

   return flag;

}
function check1(){
  var validation=Validation();
  console.log(validation);
  if(validation==1){
    $('#locality_check').hide();
    $('#checkout1').show();
  }
  else{
    document.getElementById("loc").innerHTML="Sorry We do not deliver to this location";
    document.getElementById("locality1").value="";
  }
}
</script>
</body>
</html>
