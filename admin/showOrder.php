<?php
	session_start();
	if($_SESSION['user']){
		$name = $_SESSION['user'];
	}
	else {
		header("location: index.php");
	}

	function showOrderList($tablenumber){
		$dates = date('Y-m-d');
		include('config.php');
		$sql = "SELECT id,user_id 
				FROM orderFromTableNumber 
				WHERE tableNumber = '$tablenumber' AND adminNotice = false AND date = '$dates' LIMIT 1";
		$result = $conn->query($sql);

		if($result->num_rows > 0){
			while ($row = $result->fetch_assoc()) {
				$uid = $row['user_id'];
				$oftID = $row['id'];


				$sql2 = "SELECT i.name AS iname, ol.quantity as iquantity
						FROM orderlist ol INNER JOIN item i ON i.id = ol.item_id
						WHERE ol.user_id = '$uid' AND ol.date = '$dates' AND ol.confirmOrder = true ";
				
				$result2 = $conn->query($sql2);

				if( $result2->num_rows > 0){
					$i =1;
					while ($row2 = $result2->fetch_assoc()) {
						$itemName = $row2['iname'];
						$itemQunt = $row2['iquantity'];?>

						<tr>
						    <td><?php echo $i; ?></td>
						    <td><?php echo $itemName; ?></td>
						    <td><?php echo $itemQunt; ?></td>
				    		<td><a href="updatetabledata.php?id=<?php echo $oftID ?>"> <img id="icon" src="images/ok.png"></a></td>

						</tr><?php
						$i++;
					}
				}
				else{?>
					<tr>
					    <th colspan="4"><center>NO ORDER YET!</center></th>
					</tr><?php
				}

			}

		}
		else{?>
			<tr>
			    <th colspan="4"><center>NO ORDER YET!</center></th>
			</tr><?php
		}

		$conn->close();
	}

?>

<?php
	
?>


<!DOCTYPE html>
<html>
<head>
	<title>Show Order</title>
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

		.w3-btn{
			padding: 10px;
			margin: 2px;
			border: 1px solid white;
		}
		#demo{
			font-size: 30px;
			color: red;
			margin-top: 30px;
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
	  		<div class="w3-display-middle"><h1>Show Order</h1></div>
	  		<div class="w3-display-right"><a style="text-decoration: none;color: white;" href="Logout.php" >Logout</a></div>
	  		<div class="w3-display-left"><a style="text-decoration: none; color: white;" href="welcome.php">Home</a></div>
	  	</div>
	</div>

	<div class="w3-container" style="margin: 100px auto; margin-left: 10%; margin-right: 10%">
		
		<div class="w3-col s1">
			<p><button  class="w3-btn w3-block w3-green" onclick="check('msg1', 'btn1')">Table1</button></p>
		</div>
		<div class="w3-col s1">
			<p><button  class="w3-btn w3-block w3-green" onclick="check('msg2', 'btn2')">Table2</button></p>
		</div>

  		<div class="w3-col s1">
			<p><button  class="w3-btn w3-block w3-green" onclick="check('msg3', 'btn3')">Table3</button></p>
  		</div>

  		<div class="w3-col s1">
			<p><button  class="w3-btn w3-block w3-green" onclick="check('msg4', 'btn4')">Table4</button></p>
		</div>
		<div class="w3-col s1">
			<p><button  class="w3-btn w3-block w3-green" onclick="check('msg5', 'btn5')">Table5</button></p>
		</div>

  		<div class="w3-col s1">
			<p><button  class="w3-btn w3-block w3-green" onclick="check('msg6', 'btn6')">Table6</button></p>
  		</div>

  		<div class="w3-col s1">
			<p><button  class="w3-btn w3-block w3-green" onclick="check('msg7', 'btn7')">Table7</button></p>
		</div>
		<div class="w3-col s1">
			<p><button  class="w3-btn w3-block w3-green" onclick="check('msg8', 'btn8')">Table8</button></p>
		</div>

  		<div class="w3-col s1">
			<p><button  class="w3-btn w3-block w3-green" onclick="check('msg9', 'btn9')">Table9</button></p>
  		</div>


  		<div class="w3-col s1">
			<p><button  class="w3-btn w3-block w3-green" onclick="check('msg10', 'btn10')">Table10</button></p>
		</div>
		<div class="w3-col s1">
			<p><button  class="w3-btn w3-block w3-green" onclick="check('msg11', 'btn11')">Table11</button></p>
		</div>

  		<div class="w3-col s1">
			<p><button  class="w3-btn w3-block w3-green" onclick="check('msg12', 'btn12')">Table12</button></p>
  		</div>

		
		<div id="msg1" class="msg" align="center">
			<div class="w3-container" style="margin: 100px auto; width: 80%;">
				<center><h1>Order Lists From</h1> <h1 style="color: red;">TABLE-1</h1></center>
					<table class="w3-table-all w3-hoverable">
					  <tr class="w3-green">
					    <th>#</th>
					    <th>Item Name</th>
					    <th>Quantity</th>
					    <th>Delivered</th>
					  </tr>
					  <?php showOrderList(1); ?>
					</table>		
			</div>
		</div>

		<div id="msg2" class="msg" align="center">
			<div class="w3-container" style="margin: 100px auto; width: 80%;">
				<center><h1>Order Lists From</h1> <h1 style="color: red;">TABLE-2</h1></center>
					<table class="w3-table-all w3-hoverable">
					  <tr class="w3-green">
					    <th>#</th>
					    <th>Item Name</th>
					    <th>Quantity</th>
					    <th>Delivered</th>
					  </tr>
					  <?php showOrderList(2); ?>
					</table>		
			</div>
		</div>


		<div id="msg3" class="msg" align="center">
			<div class="w3-container" style="margin: 100px auto; width: 80%;">
				<center><h1>Order Lists From</h1> <h1 style="color: red;">TABLE-3</h1></center>
					<table class="w3-table-all w3-hoverable">
					  <tr class="w3-green">
					    <th>#</th>
					    <th>Item Name</th>
					    <th>Quantity</th>
					    <th>Delivered</th>
					  </tr>
					  <?php showOrderList(3); ?>
					</table>		
			</div>
		</div>


		<div id="msg4" class="msg" align="center">
			<div class="w3-container" style="margin: 100px auto; width: 80%;">
				<center><h1>Order Lists From</h1> <h1 style="color: red;">TABLE-4</h1></center>
					<table class="w3-table-all w3-hoverable">
					  <tr class="w3-green">
					    <th>#</th>
					    <th>Item Name</th>
					    <th>Quantity</th>
					    <th>Delivered</th>
					  </tr>
					  <?php showOrderList(4); ?>
					</table>		
			</div>
		</div>


		<div id="msg5" class="msg" align="center">
			<div class="w3-container" style="margin: 100px auto; width: 80%;">
				<center><h1>Order Lists From</h1> <h1 style="color: red;">TABLE-5</h1></center>
					<table class="w3-table-all w3-hoverable">
					  <tr class="w3-green">
					    <th>#</th>
					    <th>Item Name</th>
					    <th>Quantity</th>
					    <th>Delivered</th>
					  </tr>
					  <?php showOrderList(5); ?>
					</table>		
			</div>
		</div>


		<div id="msg6" class="msg" align="center">
			<div class="w3-container" style="margin: 100px auto; width: 80%;">
				<center><h1>Order Lists From</h1> <h1 style="color: red;">TABLE-6</h1></center>
					<table class="w3-table-all w3-hoverable">
					  <tr class="w3-green">
					    <th>#</th>
					    <th>Item Name</th>
					    <th>Quantity</th>
					    <th>Delivered</th>
					  </tr>
					  <?php showOrderList(6); ?>
					</table>		
			</div>
		</div>


		<div id="msg7" class="msg" align="center">
			<div class="w3-container" style="margin: 100px auto; width: 80%;">
				<center><h1>Order Lists From</h1> <h1 style="color: red;">TABLE-7</h1></center>
					<table class="w3-table-all w3-hoverable">
					  <tr class="w3-green">
					    <th>#</th>
					    <th>Item Name</th>
					    <th>Quantity</th>
					    <th>Delivered</th>
					  </tr>
					  <?php showOrderList(7); ?>
					</table>		
			</div>
		</div>

		<div id="msg8" class="msg" align="center">
			<div class="w3-container" style="margin: 100px auto; width: 80%;">
				<center><h1>Order Lists From</h1> <h1 style="color: red;">TABLE-8</h1></center>
					<table class="w3-table-all w3-hoverable">
					  <tr class="w3-green">
					    <th>#</th>
					    <th>Item Name</th>
					    <th>Quantity</th>
					    <th>Delivered</th>
					  </tr>
					  <?php showOrderList(8); ?>
					</table>		
			</div>
		</div>

		<div id="msg9" class="msg" align="center">
			<div class="w3-container" style="margin: 100px auto; width: 80%;">
				<center><h1>Order Lists From</h1> <h1 style="color: red;">TABLE-9</h1></center>
					<table class="w3-table-all w3-hoverable">
					  <tr class="w3-green">
					    <th>#</th>
					    <th>Item Name</th>
					    <th>Quantity</th>
					    <th>Delivered</th>
					  </tr>
					  <?php showOrderList(9); ?>
					</table>		
			</div>
		</div>

		<div id="msg10" class="msg" align="center">
			<div class="w3-container" style="margin: 100px auto; width: 80%;">
				<center><h1>Order Lists From</h1> <h1 style="color: red;">TABLE-10</h1></center>
					<table class="w3-table-all w3-hoverable">
					  <tr class="w3-green">
					    <th>#</th>
					    <th>Item Name</th>
					    <th>Quantity</th>
					    <th>Delivered</th>
					  </tr>
					  <?php showOrderList(10); ?>
					</table>		
			</div>
		</div>

		<div id="msg11" class="msg" align="center">
			<div class="w3-container" style="margin: 100px auto; width: 80%;">
				<center><h1>Order Lists From</h1> <h1 style="color: red;">TABLE-11</h1></center>
					<table class="w3-table-all w3-hoverable">
					  <tr class="w3-green">
					    <th>#</th>
					    <th>Item Name</th>
					    <th>Quantity</th>
					    <th>Delivered</th>
					  </tr>
					  <?php showOrderList(11); ?>
					</table>		
			</div>
		</div>

		<div id="msg12" class="msg" align="center">
			<div class="w3-container" style="margin: 100px auto; width: 80%;">
				<center><h1>Order Lists From</h1> <h1 style="color: red;">TABLE-12</h1></center>
					<table class="w3-table-all w3-hoverable">
					  <tr class="w3-green">
					    <th>#</th>
					    <th>Item Name</th>
					    <th>Quantity</th>
					    <th>Delivered</th>
					  </tr>
					  <?php showOrderList(12); ?>
					</table>		
			</div>
		</div>
	</div>



	<script >
		var btn1 = false;
		var btn2 = false;
		var btn3 = false;
		var btn4 = false;
		var btn5 = false;
		var btn6 = false;
		var btn7 = false;
		var btn8 = false;
		var btn9 = false;
		var btn10 = false;
		var btn11 = false;
		var btn12 = false;
		var prevBtn = "msg13";

		function check(str,btnName){

			$('#'+prevBtn).hide();
			prevBtn = str;
			switch(btnName){
				case "btn1": hasBeenClicked =btn1;
							btn1 = (!btn1);
							break;
				case "btn2": hasBeenClicked =btn2;
							btn2 = (!btn2);
							break;
				case "btn3": hasBeenClicked =btn3;
							btn3 = (!btn3); 
							break;
				case "btn4": hasBeenClicked =btn4;
							btn4 = (!btn4);
							break;
				case "btn5": hasBeenClicked =btn5;
							btn5 = (!btn5); 
							break;
				case "btn6": hasBeenClicked =btn6;
							btn6 = (!btn6); 
							break;
				case "btn7": hasBeenClicked =btn7;
							btn7 = (!btn7); 
							break;
				case "btn8": hasBeenClicked =btn8;
							btn8 = (!btn8);
							break;
				case "btn9": hasBeenClicked =btn9;
							btn9 = (!btn9); 
							break;
				case "btn10": hasBeenClicked =btn10;
							btn10 = (!btn10); 
							break;
				case "btn11": hasBeenClicked =btn11;
							btn11 = (!btn11); 
							break;
				case "btn12": hasBeenClicked =btn12;
							btn12 = (!btn12);
							break;
			}

			if(hasBeenClicked){
				$('#'+str).hide();
			}else{
				$('#'+str).show();
			}
		}
	</script>

</body>
</html>