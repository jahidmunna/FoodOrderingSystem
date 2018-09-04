<?php
	session_start();
	if($_SESSION['user']){
		$name = $_SESSION['user'];
	}
	else 
		header("location: index.php");
?>


<?php
	$oftID = $_GET['id'];
	include('config.php');
	$sql3 = "UPDATE orderFromTableNumber SET adminNotice = true WHERE id = '$oftID' ";
	if($conn->query($sql3)){
		header("location: showOrder.php");
	}
	else{
		header("location: index.php");
	}

	$conn->close();
?>