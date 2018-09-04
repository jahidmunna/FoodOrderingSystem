<?php
	$error="";
	if(isset($_POST['button'])){
		if(empty(trim($_POST['user-name']))|| empty(trim($_POST['password']))){
			$error = "User or Password is invalid!";
		}
		else{
			$user = trim($_POST['user-name']);
			$user = validate($user);
			$pass = trim($_POST['password']);
			$pass = validate($pass);
			include('config.php');

			$sql = "SELECT * FROM manager WHERE username = ? AND password = ? ";

			/*to avoid sqlinjection */
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("ss", $uname, $ps); //double s means two parameter 
			// set parameters and execute
			$uname = $user;
			$ps = $pass;
			$stmt->execute();
			$stmt->store_result();
			
			$rows = $stmt->num_rows;
			if($rows == 1){
				session_start();
				$_SESSION['user'] = $user;
				header("Location: welcome.php");
			}
			else{
				//echo "$rows";
				//$error = $password;
				$error = "username or password is invalid";
			}
			mysqli_close($conn);
		}
	}

	function validate($data){
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);

		return $data;
	}
?>