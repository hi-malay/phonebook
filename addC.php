
<?php
// Adding new contacts
$error = array("name"=>"","dob"=>"","mobile"=>"","mobile2"=>"","mobile3"=>"","email"=>"","email2"=>"","email3"=>"");
$name=$dob=$mobile=$email="";
$mobile2=$mobile3=$email2=$email3="--";
if(isset($_POST["submit"]))
{
	include "connection.php";
    $name = $_POST['name'];
	$dob = $_POST['dob'];
	$mobile = $_POST['mobile'];
	$email = $_POST['email'];
	// Validation
    if(empty($name)){
		$error['name'] = "Enter Name <br>";
      }
      else if(!preg_match('/^[A-Za-z ]+$/',$name)) {
          $error['name'] = "Name can contain alphabets and spaces only!";
		}else if(empty($dob)){
			$error['dob'] = "Enter DOB";
		}
		else if(empty($mobile)){
			$error['mobile'] = "Enter Mobile";
		  }
		  else if(!preg_match("/^[0-9]{10}$/",$mobile)) {
			  $error['mobile'] = "Mobile number should be 10 digit number!";
			}else if(empty($email)){
        		$error['email'] = "Enter Email";
      	}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
          $error['email'] = "Email has to be a valid email address!";
        }else {
			//Insert data to the database
	  $rs=mysqli_query($conn,"select * from phbook where mobile='$mobile' OR mobile2='$mobile' OR mobile3='$mobile'");
	  if (mysqli_num_rows($rs)>0)
      {
        $error['mobile'] = "This mobile number is already exists!";
      }else {
		$q = "insert into phbook(name,dob,mobile,mobile2,mobile3,email,email2,email3)values('$name','$dob','$mobile','$mobile2','$mobile3','$email','$email2','$email3')";
		$res = $conn->query($q);
		if($res)
		{
			header("Location:home.php");
		}
	  }
	}
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="addC.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<title>RENTOMOJO</title>
<script type="text/javascript">
//Add mobile number input field
$(document).ready(function() {
	var max_fields = 2; 
	var wrapper = $(".input_fields_wrap"); 
	var add_button = $("#ar1"); 
	
	var x = 1; //initlal text box count
	$(add_button).click(function(e){ //on add input button click
		e.preventDefault();
		var mobile = $('.a2').val();
		if(mobile=='')
		{
			alert("Please enter mobile number!");
		}else {
		if(x <= max_fields){ //max input box allowed
			x++; //text box increment
			$(wrapper).append('<div><input type="text" class="a2" placeholder="Enter Phone Number" name="mobile"/><a href="#" class="rfeild"><i class="fa fa-times" aria-hidden="true"></i></a></div><div class="text_color"><?php echo $error['mobile2'] ?></div><br>'); //add input box
		}else{
			alert("Enter 3 or less than 3 number");
		}
		}
	});
	
	$(wrapper).on("click",".rfeild", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
	})
});

$(document).ready(function() {
	var max_fields_email = 2;
	var wrapper_email = $(".input_fields_email");
	var add_button_email = $("#email");
	
	var s= 1; //initlal text box count
	$(add_button_email).click(function(e){ //on add input button click
		e.preventDefault();
		var email = $('.aemail').val();
		if(email=='')
		{
			alert("Please enter your Email!");
		}else {
		if(s <= max_fields_email){ //max input box allowed
			s++; //text box increment
			$(wrapper_email).append('<div><input type="email" name="email" placeholder="Enter Email" class="aemail"/><a href="#" class="rmemail"><i class="fa fa-times" aria-hidden="true"></i></a></div><div class="text_color"><?php echo $error['email'] ?></div><br>'); //add input box
		}else{
			alert("You can't enter more than 3 Email addresses!");
		}
		}
	});
	
	$(wrapper_email).on("click",".rmemail", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); s--;
	})
});
</script>
</head>
<body>
	<centre>
<form action="addC.php" method="POST">
	<div id="header">
		<p id="h" ><b><a href="home.php" style="
  text-decoration:none;">RM-PHONEBOOK</a></b></p>
	<div id="from">
		<i class="fa fa-arrow-left" id="ab"></i><?php echo " Add new contact"?><br><br>
		<?php echo "Name"?><br><br>
		<input type="text" name="name" placeholder="Name" class="a1" value="<?php echo $name ?>">
		<div class="text_color"><?php echo $error['name'] ?></div><br><br>
		
		<?php echo"DOB"?><br>
		<input type="text" name="dob" placeholder="dd/mm/yyyy" onfocus="(this.type='date')" class="a1" value="<?php echo $dob ?>">
		<div class="text_color"><?php echo $error['dob'] ?></div><br><br>
		
		<?php echo "Mobile Number" ?> <br>
		<div class="input_fields_wrap">
			<input type="number" min="10" name="mobile" placeholder="Enter Phone Number" class="a2" value="<?php echo $mobile ?>">
			<i class="fa fa-plus-circle" id="ar1"></i>
			<div class="text_color"><?php echo $error['mobile'] ?></div><br><br>
		</div>
		<?php echo "Email"?><br>
		<div class="input_fields_email">
			<input type="email" name="email" placeholder="Enter Email" class="aemail" value="<?php echo $email ?>">
			<i class="fa fa-plus-circle" id="email"></i>
			<div class="text_color"><?php echo $error['email'] ?></div><br>
		</div>
		<input type="submit" name="submit" value="Save" class="a3"><br><br>
	</div>	
	</div>
</form>
</centre>
</body>
</html>