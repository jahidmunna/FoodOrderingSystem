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

		html, body {
		  margin: 0;
		  padding: 0;
		  width: 100%;
		  height: 100%;
		  font-family: 'Montserrat', sans-serif;
		  font-size: 16px;
		}

		body {
		  display: flex;
		  flex-wrap: wrap;
		  justify-content: space-around;
		  align-items: center;
		  align-content: center;
		}
		.btn {
			  box-sizing: border-box;
			  -webkit-appearance: none;
			     -moz-appearance: none;
			          appearance: none;
			  background-color: transparent;
			  border: 2px solid #4CAF50  ;
			  border-radius: 0.6em;
			  color: #4CAF50  ;
			  cursor: pointer;
			  display: flex;
			  align-self: center;
			  font-size: 1rem;
			  font-weight: 400;
			  line-height: 1;
			  margin: 20px;
			  padding: 1.2em 2.8em;
			  text-decoration: none;
			  text-align: center;
			  text-transform: uppercase;
			  font-family: 'Montserrat', sans-serif;
			  font-weight: 700;
			}

			.first {
				  transition: box-shadow 300ms ease-in-out, color 300ms ease-in-out;
			}
			.first:hover {
				  box-shadow: 0 0 40px 40px #4CAF50   inset;
				  color: white;
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
		<p><button  class="btn first" onclick="gotoPage('addItem.php')">Add new item</button></p>
		<p><button  class="btn first" onclick="gotoPage('editItem.php')">Edit Item</a></button></p>
		<p><button  class="btn first" onclick="gotoPage('setMenu.php')">Set Menu</a></button></p>
		<p><button  class="btn first" onclick="gotoPage('showOrder.php')">Show Order</a></button></p>
		<p><button  class="btn first" onclick="gotoPage('showMessage.php')">Show Message</a></button></p>
	</div>


	<script>
		function gotoPage(str){
			window.location = str;
		}

	</script>
</body>
</html> 
