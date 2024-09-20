<?php
session_start();
$city_id=$_POST['datapost'];

if($city_id=="Haryana"){
    ?>

    <option value="Gurgaon">
                    Gurgaon
                    </option> 
    
    <?php
}
else if($city_id=="Delhi NCR"){
?>
<option value="Noida">
                    Noida
                    </option> 
<?php
}
?>