<?php
	$servername = "localhost";
	$username = "root";
	$password = ""; 
	$databasename = "restaurant";

	$conn = mysqli_connect($servername, $username, $password);
	mysqli_select_db($conn,$databasename);


	if (!$conn) {
		    die("Connecting to database failed: <br><br>" . mysqli_connect_error());
		}
	else {
	//	echo "DB is Connected successfully <br><br>";
	}

?>