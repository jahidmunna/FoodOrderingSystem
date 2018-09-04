<?php
	session_start();
	if($_SESSION['user']){
		$name = $_SESSION['user'];
	}
	else 
		header("location: index.php");
?>

<?php
	
	$feedbackMessage = "";
	function getItemLists(){
		$itemNames = array();
		$ids = array();
		$str="";
		include("config.php");
		$sql = "SELECT id, name FROM item";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    	$itemNames[] = $row['name'];
		    	$ids[] = $row['id'];
			}
		} else {
		    echo "0 results";
		}
		$conn->close();

		$arrlength = count($itemNames);

		for($i=0; $i<$arrlength;$i++){

			$str =  '<div class="list-group-item list-group-item-action">'.$itemNames[$i].' '.'<input type="checkbox" value="'.$ids[$i].'" name = "values1[]" /> </div>';

			echo $str;
		}
	}

	if(isset($_POST['save1']) && isset($_POST['values1'])){
		$value = $_POST['values1'];
		include 'config.php';
		$dates = date('Y-m-d');	
		foreach ($value as $ids) {
			$sql = "INSERT INTO availableitem (item_id, date)
				VALUES ('$ids', '$dates')";
			if ($conn->query($sql) === TRUE) {
				//return 1;
				} 
			else {
			//	return 2;
			}	
		}
		$feedbackMessage = "Available Items are set successfully!";
		$conn->close();
	}


	function getAvailableItemLists(){
		$itemNames = array();
		$ids = array();
		$str="";
		$dates = date('Y-m-d');	
		include("config.php");
		$sql = "SELECT i.id, i.name
				FROM item i INNER JOIN availableitem ai ON ai.item_id = i.id
				WHERE ai.date = '$dates'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    	$itemNames[] = $row['name'];
		    	$ids[] = $row['id'];
			}
		} else { ?>
		    <div style="text-align: center; color: red; padding: 5px;"> <?php echo "Please SET Available Menu First"?></div> <?php
		}
		$conn->close();

		$arrlength = count($itemNames);

		for($i=0; $i<$arrlength;$i++){

			$str =  '<div class="list-group-item list-group-item-action">'.$itemNames[$i].' '.'<input type="checkbox" value="'.$ids[$i].'" name = "values2[]" /> </div>';

			echo $str;
		}
	}


	if(isset($_POST['save2']) && isset($_POST['values2'])){
		$value = $_POST['values2'];
		include 'config.php';
		$dates = date('Y-m-d');	
		foreach ($value as $ids) {
			$sql = "INSERT INTO specialitem (item_id, date)
				VALUES ('$ids', '$dates')";
			if ($conn->query($sql) === TRUE) {
				//return 1;
				} 
			else {
			//	return 2;
			}	
		}
		$conn->close();
		$feedbackMessage = "Special Items are set successfully!";
	}


	function getAvailableItemListsForDiscount(){
		$itemNames = array();
		$ids = array();
		$str="";
		$dates = date('Y-m-d');	
		include("config.php");
		$sql = "SELECT i.id, i.name
				FROM item i INNER JOIN availableitem ai ON ai.item_id = i.id
				WHERE ai.date = '$dates'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    	$itemNames[] = $row['name'];
		    	$ids[] = $row['id'];
			}
		} else { ?>
				<td colspan="3" align="center" style="text-align: center; color: red;"><?php echo "Please SET Available Menu First";?></td> <?php
		    
		}
		$conn->close();

		$arrlength = count($itemNames);

		for($i=0; $i<$arrlength;$i++){ ?>
			<tr>
				<td><?php echo $i+1;?></td>
				<td><?php echo $itemNames[$i];?></td>
				<td><input type="number" name="<?php echo $ids[$i]; ?>" placeholder=" enter discount value"></td>
			</tr><?php
			 
		}
	}


	if(isset($_POST['save3'])){
		$itemNames = array();
		$ids = array();
		$value = array();
		$str="";
		$dates = date('Y-m-d');	
		include("config.php");
		$sql = "SELECT i.id, i.name
				FROM item i INNER JOIN availableitem ai ON ai.item_id = i.id
				WHERE ai.date = '$dates'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    	$tempid = $row['id'];
		    	$tempName = $row['name'];
		    	
		    	if(isset($_POST[$tempid]) && trim($_POST[$tempid]) != ''){
		    		$itemNames[] = $tempName;
		    		$ids[] = $tempid;
		    		$value[] = $_POST[$tempid];
		    	}
		    	else
		    	{
		    	}
			}
		} else {
		    echo "0 results";
		}
		$conn->close();

		$arrlength = count($itemNames);
		include("config.php");
		$zeroItem = true;
		for($i=0;$i<$arrlength;$i++){
			$per = $value[$i];
			$iid = $ids[$i];
			//echo "Value = "." id = ".$ids[$i]."<br>";
			$insertQuery = "INSERT INTO discountitem (percentage, item_id, date)
				VALUES ('$per', '$iid', '$dates')";
			if ($conn->query($insertQuery) === TRUE) {
				//echo "inserted<br>";
				$zeroItem = false;
			} 
			else {
				//echo "not inserted!";
			}	
		}
		$conn->close();
		if(!$zeroItem){ 
			$feedbackMessage = "Discounts are set successfully!";
		}
		else { 
			$feedbackMessage = "";
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Set Menu</title>
	<link rel="stylesheet" type="text/css" href="css/style-btnOptions.css">
	<link rel="stylesheet" href="css/w3.css">	
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script src="js/jquery-3.3.1.js"></script>
	<script src="js/jquery.js"></script>
	<style type="text/css">
		.msg{
			display: none;
			margin-bottom: 10px;"
		}
		#listGroup{
			text-align: center; 
			width: 80%;
		}
		table{
		    width: 100%;
		    border-collapse:collapse;
		}
		td{
		    width: 50%;
		    height: 10px;
		    text-align: left;
		}
		#demo{
			font-size: 30px;
			color: red;
			margin-top: 30px;
		}

	</style>
</head>
<body>

	<div class="w3-container w3-green" >
		<div class="w3-display-container w3-green" style="height:80px;">
	  		<div class="w3-display-middle"><h1>Set Menu</h1></div>
	  		<div class="w3-display-right"><a style="text-decoration: none;color: white;" href="Logout.php" >Logout</a></div>
	  		<div class="w3-display-left"><a style="text-decoration: none; color: white;" href="welcome.php">Home</a></div>
	  	</div>
	</div>

	<div class="w3-container" style="margin: 100px auto; margin-left: 10%; margin-right: 10%">
		<p><button  class="w3-btn w3-block w3-green" onclick="check('msg1', 'availableBtn')">Set Available Menu</button></p>
		<div id="msg1" class="msg" align="center">
			<div class="list-group"  id="listGroup">
			  <a href="#" class="list-group-item list-group-item-action active">Select Items</a>    
			   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
				  	<?php getItemLists(); ?>
				  	<input type="submit" class="w3-btn w3-block" name="save1" value="Save" style="background-color: #007BFF; color: white;">
   			    </form>	
			</div>
		</div>

		<p><button  class="w3-btn w3-block w3-green" onclick="check('msg2', 'specialBtn')">Set Special Menu</button></p>
		<div id="msg2" class="msg" align="center">
			<div class="list-group"  id="listGroup">
			  <a href="#" class="list-group-item list-group-item-action active">Select Items</a>    
			   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
				  	<?php getAvailableItemLists(); ?>
				  	<input type="submit" class="w3-btn w3-block" name="save2" value="Save" style="background-color: #007BFF; color: white;">
   			    </form>	
			</div>
		</div>
		<p><button  class="w3-btn w3-block w3-green" onclick="check('msg3', 'discountBtn')">Set Discount Menu</button></p>
		<div id="msg3" class="msg w3-container" align="center">
			<table class="w3-table-all w3-hoverable" id="listGroup" >
				<thead>
				      <tr style="background: #007BFF; color: white;">
				        <th>#</th>
				        <th>Item Name</th>
				        <th>Set Percentage (%)</th>
				      </tr>
				</thead>
			    	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
					  	<?php getAvailableItemListsForDiscount(); ?>
			</table>

						<input type="submit" class="w3-btn w3-block" name="save3" id="listGroup" value="Save" style="background-color: #007BFF;color: white;">
		   			</form>	
				    
		</div>

		<div id="demo" align="center"><?php echo $feedbackMessage; ?></div>

	</div>



	<script >
		var availableBtn = false;
		var specialBtn = false;
		var discountBtn = false;


		function check(str,btnName){
			$( "#demo" ).text("");
			if (btnName == 'availableBtn') {
				hasBeenClicked = availableBtn;
				availableBtn = (!availableBtn);
			}else if (btnName == 'specialBtn') {
				hasBeenClicked = specialBtn;
				specialBtn = (!specialBtn);
			}else{
				hasBeenClicked = discountBtn;
				discountBtn = (!discountBtn);
			}

			if(hasBeenClicked){
				$('#'+str).hide();
			}else{
				$('#'+str).show();
			}
			<?php
				$feedbackMessage = "";
			?>
		}
	</script>

</body>
</html>