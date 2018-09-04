<?php
	session_start();
	if($_SESSION['user']){
		$name = $_SESSION['user'];
	}
	else 
		header("location: index.php");
?>

<?php
	function getItems(){
		include("config.php");
		$sql = "SELECT id, name, price FROM item";
		$result = $conn->query($sql);

		$i=1;
		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    	$itemName = $row['name'];
		    	$itemID = $row['id'];
		    	$itemPrice = $row['price']; ?>
		    	<tr>
				    <td><?php echo $i ?></td>
				    <td><?php echo $itemName ?></td>
				    <td><?php echo $itemPrice ?></td>
				    <td id="option"><a href="edit.php?id=<?php echo $itemID ?>"> <img id="icon" src="images/edit.png"></a></td>
				    <td id="option"><a href="delete.php?id=<?php echo $itemID ?>"> <img id="icon" src="images/delete.png" ></a></td>
				</tr> <?php
				$i++;
			}
		} else {
		    echo "0 results";
		}
		$conn->close();
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Item</title>
	<link rel="stylesheet" type="text/css" href="css/style-btnOptions.css">
	<link rel="stylesheet" href="css/w3.css">	
	<link href="css/font.css" rel='stylesheet' type='text/css'>
	<script src="js/jquery-3.3.1.js"></script>
	<style>
		#option{
			color: #16A085;
		}
		a{
			text-decoration: none;
		}
		#icon{
			height: 20px; 
			width: 20px;
		}
	</style>
</head>
<body>

	<div class="w3-container w3-green" >
		<div class="w3-display-container w3-green" style="height:80px;">
	  		<div class="w3-display-middle"><h1>Edit Item</h1></div>
	  		<div class="w3-display-right"><a id="logout" href="Logout.php" style="text-decoration: none;">Logout</a></div>
	  		<div class="w3-display-left"><a id="logout" href="welcome.php" style="text-decoration: none;">Home</a></div>
	  	</div>
	</div>

	<div class="w3-container" style="margin: 100px auto; width: 80%;">
		<center><h1>ITEM LISTS</h1></center>
		<table class="w3-table-all w3-hoverable">
		  <tr class="w3-green">
		    <th>#</th>
		    <th>Item Name</th>
		    <th>Price(bdt)</th>
		    <th>Edit</th>
		    <th>Delete</th>
		  </tr>
		  <?php getItems(); ?>
		</table>		
	</div>

</body>
</html>