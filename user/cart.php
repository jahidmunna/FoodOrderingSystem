<?php
	$uid="";
	$uname="";
	$login = false;
	$totalPrice = 0;
	$noItemInCart = true;
	session_start();
	if(isset($_SESSION['userid']) && isset($_SESSION['username'])){
		$uid = $_SESSION['userid'];
		$uname = $_SESSION['username'];
		$login = true;
		
		function itemsInCart(){
			include('config.php');
			$dates = date('Y-m-d');
			$uid = $_SESSION['userid'];
			$sql = "SELECT i.name, i.path, ol.price, ol.quantity, ol.id AS idz FROM orderList ol INNER JOIN item i 
					ON ol.item_id = i.id  
					WHERE user_id = '$uid' AND date = '$dates' AND ol.confirmOrder = false ";
			$result = $conn->query($sql);
			if($result->num_rows >0){
				$GLOBALS['noItemInCart'] = false;
				while($row = $result->fetch_assoc()){
					$orderID = $row['idz'];
					$itemName = $row['name'];
					$quant= $row['quantity'];
					$prices= $row['price'] * $quant;
					$location = "../restaurant/images/".$row['path'];
					$GLOBALS['totalPrice'] += $prices;?>

					<div class="container" id="cartDetails">
						<div class="row-eq-height">
							<div class="col-sm-3 col-md-3 col-xs-3">
								<img id="cartImage" src="<?php echo $location; ?>">
							</div>
						    <div id="name" class="col-sm-4 col-md-4 col-xs-4"><?php echo $itemName; ?></div>
						    <div id="quantity" class="col-sm-2 col-md-2 col-xs-2"><?php echo $quant; ?></div>
						    <div id="price" class="col-sm-2 col-md-2 col-xs-2"><?php echo $prices; ?> BDT</div>
						    <div id="close" class="col-sm-1 col-md-1 col-xs-1"><a href="delete.php?id=<?php echo $orderID; ?>"><img src="images/cross.png" style="height: 20px; width: 20px;"></a></div>
						</div>
					</div><?php

				}
			}
			else{
				?>
				<div class="container" id="cartDetails" style="margin-bottom: 80px;">
					<div class="row-eq-height" id="name" >
						<div style="color: red; font-weight: bold;">YOU HAVE NO FOOD IN YOUR CART YET!</div>
						<div style="color: green;">Hope, you gonna have it very soon ;)</div>
					</div>
				</div><?php
			}

			$conn->close();
		}
	}
	else{
		header("location: home.php");
	}

	if(isset($_GET['btnConfirm'])){
		$tablenumber = $_GET['tableNumber'];
		$dates = date('Y-m-d');
		include('config.php');
		$sql1 = "INSERT INTO orderFromTableNumber (tableNumber, user_id, date)
				VALUES ('$tablenumber','$uid','$dates')";
		if($conn->query($sql1)){

			$sql2 = "UPDATE orderList SET confirmOrder = true 
					WHERE user_id = '$uid' AND date = '$dates' ";
			if($conn->query($sql2)){
				$conn->close();
				header("location: orderConfirmation.php");
			}
			else{
				echo "error in inner side ".$conn->error;
			}
		}
		else{
			echo "error ".$conn->error;
		}

		$conn->close();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>food court</title>

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
		#cart{
			 color: #2E4053; 
			 font-size: 20px;
			 font-family: "Comic Sans MS", cursive, sans-serif; 
			 font-weight: bold; 
			 letter-spacing: -1px; 
			 line-height: 1; 
			 text-align: center; 
		}
		#footer{
			margin-top: 50px;
		}
		#headingforCart{
			font-size: 20px;
			height: 60px;
			padding: 10px;
			background: rgba(40, 55, 71,.7);
			border-radius: 7px;
			color: white;
			font-weight: 10px;
		}
		#cartContent{
			border-radius: 7px;
			background: white;
		}
		#cartDetails{
			font-size: 20px;
			font-weight: 10px;
			height: 100px;
			color: black;
			margin-top: 15px;
			margin-bottom: 15px;
		}
		#paymentDetails{
			font-size: 30px;
		}
		#center{
			text-align: center;
		}
		#name, #quantity, #price, #close{
			text-align: center;
			margin-top: 35px;
		}

		#cartImage{
			height: 100px;
			width: 125px;
		}

		#totalPriceLabel,#totalPrice,#selectTableLabel,#selectTable{
			font-family: Arial, Helvetica, sans-serif;
			color: rgba(71,72,74,.8);
			text-align: center;
			margin-top: 35px;
			font-weight: bold;
		}
		#selectTableLabel,#selectTable,#name, #quantity, #price{
			color: #898989;
		}

		#btnConfirm{
			text-align: center;
			margin-top: 30px;
			height: 40px;
			background-color: #2E4053; 
			border: none;
		}
		#btnConfirm:hover{
			background-color: #566573; 
		}
		#selectTable{
			background: white;
			border: 2px solid #B6C0C9;
		}
		#selectTable{
			width: 60%;
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
	                <div id="cart">
						CART WIDGET
					</div>
	            </div>
			</div>
		</div>	
	</section>


	<!-- Page Content -->
	<section class="py-5">
		<div class="container" id="headingforCart">
			<div class="row-eq-height">
				<div class="col-sm-4 col-md-4 col-xs-4" style="padding-left: 60px;">Product</div>
			    <div id="center" class="col-sm-3 col-md-3 col-xs-3"></div>
			    <div id="center" class="col-sm-2 col-md-2 col-xs-2">Quantity</div>
			    <div id="center" class="col-sm-2 col-md-2 col-xs-2" style="padding-right:60px;">Price</div>
			    <div id="center" class="col-sm-1 col-md-1 col-xs-1"></div>
			</div>
		</div>	
	</section>

	<!-- Page Content -->
	<div class="container" id="cartContent">
		<?php itemsInCart(); ?>
	</div>

	<div class="container" id="paymentContent">
		<div class="container" id="paymentDetails">
			<div class="row-eq-height">
				<div id="totalPriceLabel" class="col-sm-4 col-md-4 col-xs-4">Total Price</div>
			    <div class="col-sm-4 col-md-4 col-xs-4"></div>
			    <div id="totalPrice" class="col-sm-4 col-md-4 col-xs-4"><?php echo $totalPrice; ?> BDT</div>
			</div>
		</div>
	</div>
	
	<section class="py-5" <?php 
							if($noItemInCart){?> 
								style="display: none; <?php
							}?> >
		<div class = "container" id="cartContent">
			<div class="container" id="cartDetails">
				<div class="row-eq-height">
					<form method="get">
						<div id="selectTableLabel" class="col-sm-4 col-md-4 col-xs-4" align="right">Select Your Table Number </div>
					    <div class="col-sm-2 col-md-2 col-xs-2" align="left">
						    <select class="select" id="selectTable" name="tableNumber" required="">
							    <option value="" disabled selected><b>#</b></option>
							    <option value="1">1</option>
							    <option value="2">2</option>
							    <option value="3">3</option>
							    <option value="4">4</option>
							    <option value="5">5</option>
							    <option value="6">6</option>
							    <option value="7">7</option>
							    <option value="8">8</option>
							    <option value="9">9</option>
							    <option value="10">10</option>
							    <option value="11">11</option>
							    <option value="12">12</option>

							</select> 
					    </div>
					    <div class="col-sm-4 col-md-4 col-xs-4"></div>
					    <input class="col-sm-2 col-md-2 col-xs-2 btn btn-primary btn-lg" id="btnConfirm" name="btnConfirm" type="submit"  value="Confirm Order">
				    </form>
				</div>
			</div>
		</div>
	</section>	




	<!-- Footer -->
	<footer class="py-5 bg-dark" id="footer">
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