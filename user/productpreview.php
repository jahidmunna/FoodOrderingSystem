<?php
	$uid="";
	$uname="";
	$login = false;
	session_start();
	if(isset($_SESSION['userid']) && isset($_SESSION['username'])){
		$uid = $_SESSION['userid'];
		$uname = $_SESSION['username'];
		$login = true;

		//echo $uid;
	}
	else{
		//echo "empty ".$login;
	}
?>

<?php
	$ids = $_GET['id'];
	include('config.php');

	$dates = date('Y-m-d');	
	$sql = "SELECT i.id, i.name, i.price,i.path, i.details, di.percentage
				FROM item i INNER JOIN discountitem di ON di.item_id = i.id
				WHERE di.date = '$dates' AND i.id = '$ids' ";
	$result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $location = "../restaurant/images/".$row['path'];
            $names = $row['name'];
            $prices = $row['price'];
            $discount = $row ['percentage'];
            $detail = $row['details'];
            $totalPrice = intval ($prices*(1-($discount)/100));
        }
    }
    else {
    	$sql = "SELECT i.id, i.name, i.price,i.path,i.details
				FROM item i WHERE i.id = '$ids' ";

		$result = $conn->query($sql);
	    if ($result->num_rows > 0) {
	        while ($row = $result->fetch_assoc()) {
	            $location = "../restaurant/images/".$row['path'];
	            $names = $row['name'];
	            $prices = $row['price'];
	            $detail = $row['details'];
	            $totalPrice = $prices;
	        }
	    }
	    else{
	    	echo "error".$conn->error;
	    }
    }

    $conn->close();

    date_default_timezone_set('Asia/Dhaka');
    $hour =  date('H');
    date_default_timezone_set('Europe/Berlin');
    $greeting;
    if($hour>=3 && $hour<12){
    	$greeting = "Morning!";
    }
    else if($hour>=12 && $hour<=18){
    	$greeting = "Afternoon!";
    }
    else {
    	$greeting = "Evening!";	
    }


    if(isset($_POST['addtoCartBtn'])){

    	if($login){
    		include('config.php');
	    	$qntty = $_POST['quant'];
	    	$_POST=array();
			$dates = date('Y-m-d');	
			$sql = "INSERT INTO orderList (user_id, item_id, price, quantity, date)
					VALUES ('$uid', '$ids', '$totalPrice', '$qntty', '$dates')";
			if($conn->query($sql)){ 
				
				header("location:notify.php");
			}

			$conn->close();
    	}
    	else{ ?>
    		<script type="text/javascript">
	    		alert("Please login first to order!");
				window.location = "login.php";
			</script> <?php
    	}
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Product Preview</title>

	<!-- Custom styles for this template -->
	<link rel="stylesheet" type="text/css" href="css/custom-navbar.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min1.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min1.css">
    <link rel="stylesheet" type="text/css" href="css/style-item1.css">	
	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<style type="text/css">

		#nav-item-name{
			font-size: 15px;
			padding-left:6px;
			padding-right: 6px;
		}
		
		body{
			background: rgba(39, 55, 70,.8);
			background-image: url("images/previewBackground1.jpg");
			background-size:     cover;                      /* <------ */
		    background-repeat:   no-repeat;
		    background-position: center center;
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

		#content{
			margin-top: 60px;
			margin-left: 80px;
			padding: 20px;
			width: 800px;
			min-height: 400px;
			position: relative;
			overflow: hidden;
		}
		#leftContent{
			position: absolute;
			width: 290px;
			min-height: 400px;
			float:left;
		}	

		#rightContent{
			width: 400px;
			min-height: 400px;
			float:right;
			color: white;
		}	

		table tr td {
			font-size: 17px;
		}
		#greetings{
			color: #F1C40F;
			text-align: center;
			font-size: 20px;
			margin-bottom: 30px;
		}
		#foodimage{
			border: 2px solid #F1C40F;
		}
		#foodName{
			color: #F1C40F;
		}
		#foodDetails{
			color: white;
			font-size: 11px;
		}

		#btn{
			font-size: 12px;
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

	<section  class="py-5" id="content">
		<div id="greetings">Good <?php echo $greeting; ?></div>
		<!-- Page Content -->
		  <div class="container" id="leftContent">
		    <img id="foodimage" src="<?php echo $location; ?>">
		    <div id="foodName"><h3><?php echo $names; ?></h3></div>
		    <div id="foodDetails"><?php echo $detail; ?></div>
		  </div>

  		  <div class="container" id="rightContent">
  		  	<form method="post" action="">
	  		  	<table width="100%">
	  		  		<tr>
	  		  			<td>Price</td>
	  		  			<td>:</td>
	  		  			<td><?php echo $totalPrice; ?> BDT</td>
	  		  		</tr>
	  		  		<tr>
	  		  			<td>Quantity</td>
	  		  			<td>:</td>
	  		  			<td>
					        <div class="col-sm-6">
					            <div class="input-group">
					                <span class="input-group-btn" style="margin-right: 22px;">
						              	<button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant">
						                  <span class="glyphicon glyphicon-minus"></span>
						                </button>
					                </span>
					                <input type="text" name="quant" class="form-control input-number" value="1" min="1" max="10" style="height: 25px;">
					                <span class="input-group-btn">
						              	<button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant">
						                  <span class="glyphicon glyphicon-plus"></span>
						                </button>
					                </span>
					            </div>
					        </div>
	  		  			</td>
	  		  		</tr>
	  		  		<tr>
	  		  			<td>Rating</td>
	  		  			<td>:</td>
	  		  			<td><div class="col-md-8 col-sm-12 col-xs-6 review" style="color: white;">
	                            <i class="fa fa-star" aria-hidden="true"></i>
	                            <i class="fa fa-star" aria-hidden="true"></i>
	                            <i class="fa fa-star" aria-hidden="true"></i>
	                            <i class="fa fa-star-o" aria-hidden="true"></i>
	                            <i class="fa fa-star-o" aria-hidden="true"></i>
							</div>
	                    </td>
	  		  		</tr>

	  		  		<tr>
	  		  			<td><input type="submit" id="btn" name="addtoCartBtn" class="btn btn-default" value="Add to Cart"></td>
	  		  			<td><button type="button" id="btn" class="btn btn-default" onclick="backToHomePage()">Back</button></td>
	  		  		</tr>
	  		  	</table>
  		  	</form>
		  </div>

	</section>



	<!-- Footer -->
	<footer class="py-5">
	  <div class="container">
	    <p class="m-0 text-center text-white">Developed By JIM</p>
	  </div>
	  <!-- /.container -->
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



		$('.btn-number').click(function(e){
		    e.preventDefault();
		    
		    fieldName = $(this).attr('data-field');
		    type      = $(this).attr('data-type');
		    var input = $("input[name='"+fieldName+"']");
		    var currentVal = parseInt(input.val());
		    if (!isNaN(currentVal)) {
		        if(type == 'minus') {
		            
		            if(currentVal > input.attr('min')) {
		                input.val(currentVal - 1).change();
		            } 
		            if(parseInt(input.val()) == input.attr('min')) {
		                $(this).attr('disabled', true);
		            }

		        } else if(type == 'plus') {

		            if(currentVal < input.attr('max')) {
		                input.val(currentVal + 1).change();
		            }
		            if(parseInt(input.val()) == input.attr('max')) {
		                $(this).attr('disabled', true);
		            }

		        }
		    } else {
		        input.val(0);
		    }
		});

		$('.input-number').focusin(function(){
		   $(this).data('oldValue', $(this).val());
		});
		$('.input-number').change(function() {
		    
		    minValue =  parseInt($(this).attr('min'));
		    maxValue =  parseInt($(this).attr('max'));
		    valueCurrent = parseInt($(this).val());
		    
		    name = $(this).attr('name');
		    if(valueCurrent >= minValue) {
		        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
		    } else {
		        alert('Sorry, the minimum value was reached');
		        $(this).val($(this).data('oldValue'));
		    }
		    if(valueCurrent <= maxValue) {
		        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
		    } else {
		        alert('Sorry, the maximum value was reached');
		        $(this).val($(this).data('oldValue'));
		    }
		    
		    
		});
		$(".input-number").keydown(function (e) {
		        // Allow: backspace, delete, tab, escape, enter and .
		        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
		             // Allow: Ctrl+A
		            (e.keyCode == 65 && e.ctrlKey === true) || 
		             // Allow: home, end, left, right
		            (e.keyCode >= 35 && e.keyCode <= 39)) {
		                 // let it happen, don't do anything
		                 return;
		        }
		        // Ensure that it is a number and stop the keypress
		        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
		            e.preventDefault();
		        }
		    });


		function backToHomePage(){
			window.location = "home.php";
		}

		function response(login){
			if(login){
				alert("added to the cart!");
			}
			else{
				alert("Please login first to order!");
				window.location = "login.php";

			}
		}

	</script>

</body>
</html>