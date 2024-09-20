  

function myfun(datavalue){
            
            $.ajax({
                url:'biryani_area.php',
                type:'POST',
                data:{datapost:datavalue},
                success:function(result){
                    $('#city').html(result);
                }
            });
    }


function user_check(){
    var flag=0;
    var phno=$('#phno').val();
        $.ajax({
            url: "check_username.php",
            type: "POST",
            async: false,
            data: {  phno:phno
            },
            success: function (result) {
                if(result=="1"){
                flag=1;
                }
            }
        }); 
        return flag;
           }

           function Validation(){
        var flag=0;
        const city1=["Rajeev Nagar","Sector 14","Sector 17","Sector 5","Sector 4"];
   let value=document.getElementById("locality1").value;
   
   for(let i=0;i<city1.length;i++){
    if(value==city1[i]){
          flag=1;
    }
   }

   return flag;
    
}

           function myFunction() {
    $("#registration").on("submit", function (event) {
        event.preventDefault();
        var f=user_check();
        if(f=="0"){
        var r= Validation();
        if(r==1){
        var fullname=$('#fullname').val();
        var phno=$('#phno').val();
		var password=$('#password').val();
        var email=$('#email').val();
        var city=$('#city').val();
		var state=$('#state').val();
		var locality=document.getElementById("locality1").value;
        $.ajax({
            url: "sign_up_new.php",
            type: "POST",
            data: {
                			   fullname:fullname,
                               phno:phno,
                               password:password,
                               email:email,
							   city:city,
							   state:state,
							   locality:locality
                
            },
            success: function (result) {
                
                document.querySelector('#msg').textContent="Registration Successfull"
        document.querySelector('#msg').style.color="Green";
        var timer = setTimeout(function() {
            window.location='index.php'
        }, 2000);
            }
        });
        }
        else{

    document.querySelector('#msg').textContent="Location Not Valid"
        document.querySelector('#msg').style.color="Red";
        document.getElementById("locality1").value="";
}
}
else if(f=="1") {
    document.querySelector('#msg').textContent="Phone Number Already Registered";
        document.querySelector('#msg').style.color="Red";
}
    
})
}


      