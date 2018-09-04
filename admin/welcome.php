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
	<link href="css/font.css" rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/style-btn.css">
    
    <style type="text/css">
    	#logout{
    		margin-top: 80px;
    		margin-right: 70px;
		}	
    </style>
</head>

<body>

  		<h1 style="margin-bottom: 80px;">Welcome <strong><?php echo strtoupper($name);?></strong></h1>

		<button class="btn first" id="btn" onclick="gotoPage('addItem.php')">Add new item</button>
		<button class="btn first" id="btn" onclick="gotoPage('editItem.php')">Edit Item</button>
		<button class="btn first" id="btn" onclick="gotoPage('setMenu.php')">Set Menu</button>
		<button class="btn first" id="btn" onclick="gotoPage('showOrder.php')">Show Order</button>
		<button class="btn first" id="btn" onclick="gotoPage('showMessage.php')">Show Message</button>

  		<button id="logout" class="btn third" onclick="gotoPage('Logout.php')">Logout</button>

	


	<script>
		function gotoPage(str){
			window.location = str;
		}

	</script>
</body>
</html> 
