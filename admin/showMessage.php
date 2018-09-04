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
		$sql = "SELECT id, name, email, date, message FROM feedback";
		$result = $conn->query($sql);

		$i=1;
		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    	$userName = $row['name'];
		    	$messageID = $row['id'];
		    	$userEmail = $row['email'];
		    	$dates = $row['date'];
		    	$userMessage = $row['message']; ?>
		    	<tr>
				    <td><?php echo $i; ?></td>
				    <td><?php echo $userName; ?></td>
				    <td><?php echo $userEmail; ?></td>
				    <td><?php echo $userMessage; ?></td>
				    <td><?php echo $dates; ?></td>

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
	<title>Messages</title>
	<link rel="stylesheet" type="text/css" href="css/style-btnOptions.css">
	<link rel="stylesheet" href="css/w3.css">	
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
	  		<div class="w3-display-middle"><h1>Show Messages</h1></div>
	  		<div class="w3-display-right"><a id="logout" href="Logout.php" style="text-decoration: none;">Logout</a></div>
	  		<div class="w3-display-left"><a id="logout" href="welcome.php" style="text-decoration: none;">Home</a></div>
	  	</div>
	</div>

	<div class="w3-container" style="margin: 100px auto; width: 80%;">
		<center><h1>Message Lists</h1></center>
		<table class="w3-table-all w3-hoverable">
		  <tr class="w3-green">
		    <th>#</th>
		    <th>User Name</th>
		    <th>User Email</th>
		    <th>Message</th>
		    <th>Date</th>
		  </tr>
		  <?php getItems(); ?>
		</table>		
	</div>

</body>
</html>