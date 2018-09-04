<?php
	$uid="";
	$uname="";
	$login = false;
	$itemLESS = true;
	session_start();
	if(isset($_SESSION['userid']) && isset($_SESSION['username'])){
		$uid = $_SESSION['userid'];
		$uname = $_SESSION['username'];
		$login = true;
		//echo $uid;

		function itemsHistory(){
			include('config.php');
			$uid = $_SESSION['userid'];
			$sql = "SELECT i.name, i.path, ol.price, ol.quantity, date, ol.id AS idz FROM orderList ol INNER JOIN item i 
					ON ol.item_id = i.id  
					WHERE user_id = '$uid' AND ol.confirmOrder = true";
			$result = $conn->query($sql);
			if($result->num_rows >0){
				$i = 1;
				while($row = $result->fetch_assoc()){
					//$orderID = $row['idz'];
					$itemName = $row['name'];
					$itemName = trim($itemName);
					$quant= $row['quantity'];
					$dates = $row['date'];?>

					<div class="container" id="historyDetails">
						<div class="row-eq-height">
							<div id="number" class="col-sm-1 col-md-1 col-xs-1" ><?php echo $i; ?></div>
							<div id="productName" class="col-sm-6 col-md-6 col-xs-6"><?php echo $itemName; ?></div>
						    <div id="quantityNumber" class="col-sm-2 col-md-2 col-xs-2"><?php echo $quant; ?></div>
						    <div id="date" class="col-sm-3 col-md-3 col-xs-3"><?php echo $dates; ?></div>
						</div>
					</div><?php
					$i++;
				}
				if($i >3){
					$GLOBALS['itemLESS'] = false; //its used to adjust the footer 
				}
			}
			else{?>
				<div class="container" id="historyDetails" style="margin-bottom: 170px;">
					<div class="row-eq-height"  align="center">
						<div  id="productName" style="color: red; margin-top: 70px;">YOU DIDN'T ORDER ANY FOOD FROM HERE YET!</div>
						<div style="color: green;">Hope your journy with us gonna be awesome ;)</div>
					</div>
				</div><?php
				$GLOBALS['itemLESS'] = false;
			}

			$conn->close();
		}
	}
	else{
		header("location: home.php");
	}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Order History</title>

	<!-- Bootstrap core CSS -->

	<!-- Custom styles for this template -->
	<link href="css/full-slider.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style-slider.css">
	<link rel="stylesheet" type="text/css" href="css/custom-navbar.css">


	<link rel="stylesheet" type="text/css" href="css/bootstrap.min1.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min1.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min1.css">
    <script src="js/jquery.min1.js"></script>
    <script src="js/owl.carousel1.js"></script>
    <script src="css/owl.theme.min1.css"></script>
    <script src="css/owl.carousel1.css"></script>
    <script src="js/bootstrap.min1.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style-item1.css">

	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style-slider.css">

	<style type="text/css">

		#nav-item-name{
			font-size: 15px;
			padding-left:6px;
			padding-right: 6px;
		}

		#sliderLink{
			font-size: 12px;
		}
		strike{
			color: red;
			padding-right: 7px;
		}

		body{
			background-color: rgba(44, 62, 80,.2);
		}

		#drowdownMenu{
			padding: 2px;
		}
		#drowdownMenu li{
			margin:2px;
		}
		
		#nav-item-name{
			color: #F1C40F;
		}

		#heading{
			margin-top: 50px;
			width: 100%;
		    text-align: center;
		}
		#history{
			 color: #2E4053; 
			 font-size: 20px;
			 font-family: "Comic Sans MS", cursive, sans-serif; 
			 font-weight: bold; 
			 letter-spacing: -1px; 
			 line-height: 1; 
			 text-align: center; 
		}
		
		#headingforHistory{
			font-size: 20px;
			height: 60px;
			padding: 10px;
			background: rgba(40, 55, 71,.7);
			border-radius: 7px;
			color: white;
			font-weight: 10px;
		}
		#historyContent{
			border-radius: 7px;
			background: white;
		}
		#historyDetails{
			font-size: 20px;
			font-weight: 10px;
			height: 80px;
			color: black;
			margin-top: 15px;
			margin-bottom: 15px;
		}
		
		#center{
			text-align: center;
		}
		#quantityNumber,#productName,#number,#date{
			text-align: center;
			margin-top: 35px;
		}

		#quantityNumber,#productName,#number,#date{
			font-family: Arial, Helvetica, sans-serif;
			color: rgba(71,72,74,.8);
			text-align: center;
			margin-top: 35px;
			font-weight: bold;
		}
		#footer{
			margin-top: 60px;
		}

		
		
	</style>


</head>

<body>

<!-- Navigation  navbar-dark bg-dark-->
	<nav class="navbar navbar-expand-lg navbar-dark  fixed-top" id="navigationbar" style="border-radius: 0px;">
	    <div class="container" id="nav-container">
		    <a class="navbar-brand" id="nav-item-name" href="home.php"><img src="images/logo.png" style="height: 50px; width: 50px;"></a>
		    <h4 id="nav-item-name" style="word-spacing: -5;">Foodie</h4>
		    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" id="navbarResponsive">
		        <ul class="navbar-nav ml-auto">
			        <li class="nav-item active">
			          <a class="nav-link" href="home.php" id="nav-item-name">Home
			          </a>
			        </li>

		        	<li class="nav-item">
			          <a class="nav-link" id="nav-item-name" href="home.php#about" >About</a>
			        </li>
			        
			        <li class="nav-item">
			          <a class="nav-link" id="nav-item-name" href="home.php#contactus">Contact</a>
			        </li>			        

		        	<li class="nav-item dropdown">
		        		<a class="nav-link dropdown-toggle" id="nav-item-name" href="" data-toggle="dropdown">Menu</a>
		        		<ul class="dropdown-menu" role="menu" aria-labelledby="menu1" id="drowdownMenu">
						    <li role="presentation"><a role="menuitem" href="home.php#availableITEM">Available Menu</a></li>
						    <li role="presentation"><a role="menuitem" href="home.php#specialITEM">Special Menu</a></li>
						    <li role="presentation"><a role="menuitem" href="home.php#discountITEM">Discount Menu</a></li>
						    <li role="presentation" class="divider"></li>
						    <li role="presentation"><a role="menuitem" href="foodbycategory.php?id=1">Pizza Menu</a></li>
						    <li role="presentation"><a role="menuitem" href="foodbycategory.php?id=2">Pasta Menu</a></li>
						    <li role="presentation"><a role="menuitem" href="foodbycategory.php?id=3">Burger Menu</a></li>
						    <li role="presentation"><a role="menuitem" href="foodbycategory.php?id=4">Beverage Menu</a></li>

						</ul>
		        	</li>
			        <li class="nav-item">
			          	<?php 
			        		if($uid == ""){ ?>
			          			<a class="nav-link" id="nav-item-name" href="login.php">login</a> <?php
			        		} 
			        		else { ?>
			        			<li class="nav-item dropdown">
					        		<a class="nav-link dropdown-toggle" id="nav-item-name" href="" data-toggle="dropdown"><?php echo $uname; ?></a>
					        		<ul class="dropdown-menu" role="menu" aria-labelledby="menu1" id="drowdownMenu">
									    <li role="presentation"><a role="menuitem" href="cart.php">Cart</a></li>
									    <li role="presentation" class="divider"></li>
									    <li role="presentation"><a role="menuitem" href="orderHistory.php">History</a></li>
										<li role="presentation" class="divider"></li>
									    <li role="presentation"><a role="menuitem" href="logout.php">logout</a></li>
									</ul>
					        	</li> <?php
			        		}
			        	?>
			        </li>
		        </ul>
		    </div>
	    </div>
	</nav>

	<!-- Page Content -->
	<section class="py-5" id="heading">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
	                <div id="history">
						Ordered History
					</div>
	            </div>
			</div>
		</div>	
	</section>

	<!-- Page Content -->
	<section class="py-5">
		<div class="container" id="headingforHistory">
			<div class="row-eq-height">
				<div class="col-sm-1 col-md-1 col-xs-1" align="center">#</div>
				<div class="col-sm-6 col-md-6 col-xs-6" align="center">Product</div>
			    <div id="center" class="col-sm-2 col-md-2 col-xs-2">Quantity</div>
			    <div id="center" class="col-sm-3 col-md-3 col-xs-3" style="padding-right:60px;">Date</div>
			</div>
		</div>	
	</section>


	<div class="container" id="historyContent">
		<?php itemsHistory(); ?>
	</div>
	

	<!-- Footer -->
	<footer class="py-5 bg-dark" id="footer" 
		 <?php
			if($itemLESS){?>
				style = "margin-top: 205px;" <?php
			}
		?> >
	  	<div class="container">
	    	<p class="m-0 text-center text-white">Developed By JIM</p>
	  	</div>
	</footer>

	<!-- Bootstrap core JavaScript -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>


	<script type="text/javascript">
		var a = $(".navbar").offset().top;

		$(document).scroll(function(){
		    if($(this).scrollTop() > a)
		    {   
		       $('.navbar').css({"background":"rgba(52, 58, 64,.8)"});
		    } else {
		       $('.navbar').css({"background":"transparent"});
		    }
		});


		function productPage(idz){
			var pagName = "productpreview.php?id=";
			var res = pagName.concat(idz);
			window.location = res;
		}

	</script>

</body>

</html>