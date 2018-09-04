<?php
	$error="";
	$errorLogin="";
	$successful = false;
	$uname = "";
	$upass = "";
	$uphone ="";
	
	if(isset($_POST['signupbtn'])){
		$uname = validate($_POST['user-signup']);
		$upass = sha1(validate($_POST['pass1-signup']));
		$uphone = validate($_POST['phone-signup']);
		$len = strlen($uphone);
		
		if($len==11){
			$uphone = "+88".$uphone;
		}

		include("config.php");

		$sql = "SELECT * FROM users WHERE name = '$uname'";
		$result = $conn->query($sql);

		if($result->num_rows > 0){
			$error = "user name is already exist!";
			$successful = false;
		}
		else{

			$sql1= "INSERT INTO users (name, password, phonenumber)
					VALUES ('$uname', '$upass', '$uphone')";
			if ($conn->query($sql1) === TRUE) { 
				$error="";
				$successful = true; 
			} 
			else {
				$successful = false;
				echo " erro ".$conn->erro;
			}
		}

		$conn->close();
	}

	if(isset($_POST['signin'])){

		$unameSignin = validate($_POST['user-signin']);
		$upassSignin = sha1(validate($_POST['pass-signin']));

		include("config.php");

		$sql = "SELECT * FROM users WHERE name = '$unameSignin' AND password ='$upassSignin' ";
		$result = $conn->query($sql);

		if($result->num_rows > 0){
			while ($row = $result->fetch_assoc()) {
				session_start();
	            $_SESSION['userid'] = $row['id'];
	            $_SESSION['username'] = $row['name'];
	            header("location:home.php");
        	}
		}
		else{

			$errorLogin = "invalid username or password!";

		}

		$conn->close();	
	}


	function validate($data){
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);

		return $data;
	}
?>