<?php
	include("loginServer.php");
	if($successful){?>
		<script type="text/javascript">
			alert("Successfully registered!");		
		</script> <?php

		$successful = false;
	}
		
?>

<!DOCTYPE html>
<html>
<head>
	<title>login/Signup</title>
	<link rel="stylesheet" type="text/css" href="css/style-login.css">
	<script src="js/jquery.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script src="js/bootbox.min.js"></script>

</head>

<body>
	<div class="login-wrap">
		<div class="login-html">
			<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
			<input id="tab-2" type="radio" name="tab" class="sign-up" <?php if ($error!="") {
				echo 'checked="checked"';
			}?> ><label for="tab-2" class="tab">Sign Up</label>
			<div class="login-form">
				<div class="sign-in-htm">
					<form method="post" action="">
						<div class="group">
							<label for="user" class="label">Username</label>
							<input id="user-signin" name="user-signin" type="text" class="input">
						</div>
						<div class="group">
							<label for="pass" class="label">Password</label>
							<input id="pass-signin" name="pass-signin" type="password" class="input" data-type="password">
						</div>
						<div class="group">
							<input id="check" type="checkbox" class="check" checked>
							<label for="check"><span class="icon"></span> Keep me Signed in</label>
						</div>
						<div class="group">
							<strong class="alert"><?php echo $errorLogin;?></strong> 
							<input type="submit" name="signin" class="button" value="Sign In">
						</div>
						<div class="hr"></div>
						<div class="foot-lnk">
							<a href="#forgot">Forgot Password?</a>
						</div>
					</form>
				</div>

				<form id="sign-up-form" method="post" action="">
					<div class="sign-up-htm" id="signupform">
						<div class="group">
							<label for="user" class="label">Username</label>
							<input type="text" id="user-signup" name="user-signup" class="input" required minlength="5" value="<?php echo $uname; ?>">
							<strong class="alert" id="Username"><?php echo $error;?></strong>
						</div>
							
						<div class="group">
							<label for="pass" class="label">Password</label>
							<input id="pass1-signup" name="pass1-signup" type="password" class="input" required minlength="6">
							<strong class="alert" id="password1-signup"></strong>
						</div>
						<div class="group">
							<label for="pass" class="label">Repeat Password</label>
							<input id="pass2-signup" name="pass2-signup" type="password" class="input" required minlength="6">
							<strong class="alert" id="password2-signup"></strong>
						</div>
						<div class="group">
							<label for="phone-signup" class="label">Phone Number</label>
							<input id="phone-signup" name="phone-signup" pattern="^([+]8{2})?01(1|8|9|5|6|7)[0-9]{8}$" class="input" minlength="11" required value="<?php if($uphone) echo $uphone;
								else echo "+880"; ?>">
							<strong class="alert" id="phoneNumber-signup"></strong>
						</div>
						<div class="group">
							<input type="submit" class="button" value="Sign Up" id="submit-btn-signup" name="signupbtn">
						</div>
						<div class="hr"></div>
						<div class="foot-lnk">
							<label for="tab-1">Already Member?</label>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

<script src="js/jquery.min.js"></script>
<script>
	var password = document.getElementById("pass1-signup") , confirm_password = document.getElementById("pass2-signup");

	function validatePassword(){
		if(password.value != confirm_password.value) {
		    confirm_password.setCustomValidity("Password doesnot match!");
		} 
		else {
		    confirm_password.setCustomValidity('');
		}
	}
	password.onchange = validatePassword;
	confirm_password.onkeyup = validatePassword;

</script>

  <script type="text/javascript">
  	$('#user-signup').on("input", function() {
		  var userNameLength = this.value.trim().length;
	//	  userNameCheckForSignup = false;
		  if (userNameLength<=0) {
		  		$('#Username').text("The field is required!");
		  		$('#Username').css('color', '#FF0000');
		  }
		  else if (userNameLength<5) {
		  		$('#Username').text("Must be minimum 5 character!");
		  		$('#Username').css('color', '#FFFF00');
		  }
		  else{
		  	userNameCheckForSignup = true;
		  	$('#Username').text("");
		  }

	});

  	var password1;
	$('#pass1-signup').on("input", function() {
		  var passwordLength = this.value.trim().length;
		  if (passwordLength<=0) {
		  		$('#password1-signup').text("The field is required!");
		  		$('#password1-signup').css('color', '#FF0000');

		  }
		  else if (passwordLength<6) {
		  		$('#password1-signup').text("Must be minimum 6 character!");
		  		$('#password1-signup').css('color', '#FFFF00');
		  }
		  else{
		  	password1 = this.value;
		  	$('#password1-signup').text("");
		  }

	});


	$('#pass2-signup').on("input", function() {
		  var passwordLength = this.value.trim().length;
		  //	passwordCheckForSignup = false;
		  if (passwordLength<=0) {
		  		$('#password2-signup').text("The field is required!");
		  		$('#password2-signup').css('color', '#FF0000');
		  }
		  else if (passwordLength<6) {
		  		$('#password2-signup').text("Must be minimum 6 character!");
		  		$('#password2-signup').css('color', '#FFFF00');
		  }
		  else{
		  	var password2 = this.value;
		  	if (password1 !=password2) {
		  		$('#password2-signup').text("Password doesnot match!");
		  		$('#password2-signup').css('color', '#00FFFF');
		  	}
		  	else{
		  		$('#password2-signup').text("");

		  	}
		  }

	});


	$('#phone-signup').on("input", function() {
		  const str = this.value.trim();
		  var phoneNumberLength = this.value.trim().length;
		  phonenumberCheckForSignup = false;
		  if (phoneNumberLength<=0) {
		  		$('#phoneNumber-signup').text("The field is required!");
		  		$('#phoneNumber-signup').css('color', '#FF0000');
		  }
		  else if (phoneNumberLength==14 || phoneNumberLength==11){
		  	const regex = /^([+]8{2})?01(1|8|9|5|6|7)[0-9]{8}$/g;

		  	if(str.match(regex)){
		  		$('#phoneNumber-signup').text("");

		  		phonenumberCheckForSignup = true;
		  	}
		  	else {
				$('#phoneNumber-signup').text("Must be a valid phone number!");
		  		$('#phoneNumber-signup').css('color', '#FFFF00');
		  	}
		  }

  		  else {
		  		$('#phoneNumber-signup').text("Must be a valid phone number!");
		  		$('#phoneNumber-signup').css('color', '#FFFF00');
		  }

	});
  </script>

</body>
</html>