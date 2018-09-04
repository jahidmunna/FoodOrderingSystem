<?php
	session_start();
	if($_SESSION['user']){
		$name = $_SESSION['user'];
	}
	else 
		header("location: index.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/w3.css">
	<link rel="stylesheet" type="text/css" href="css\style-btnOptions.css">
	<style type="text/css">
		a{
			text-decoration: none;
		}
	</style>
</head>
<body>

	<div class="w3-container w3-green" >
		<div class="w3-display-container w3-green" style="height:80px;">
	  		<div class="w3-display-middle"><h1>Welcome <strong><?php echo strtoupper($name)?></strong></h1></div>
	  		<div class="w3-display-right"><a id="logout" href="Logout.php" style="text-decoration: none;">Logout</a></div>
	  		
	  	</div>
	</div>


	<div class="w3-container" id="container">
		<p><button class="w3-button  w3-green" id="btn" onclick="gotoPage('addItem.php')">Add new item</button></p>
		<p><button class="w3-button  w3-green" id="btn" onclick="gotoPage('editItem.php')">Edit Item</a></button></p>
		<p><button class="w3-button  w3-green" id="btn" onclick="gotoPage('setMenu.php')">Set Menu</a></button></p>
		<p><button class="w3-button  w3-green" id="btn" onclick="gotoPage('showOrder.php')">Show Order</a></button></p>
		<p><button class="w3-button  w3-green" id="btn" onclick="gotoPage('showMessage.php')">Show Message</a></button></p>
	</div>


	<script>
		function gotoPage(str){
			window.location = str;
		}

	</script>
</body>
</html> 
