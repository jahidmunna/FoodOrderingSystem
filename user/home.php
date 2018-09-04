<?php
	$uid="";
	$uname="";
	session_start();
	if(isset($_SESSION['userid']) && isset($_SESSION['username'])){
		$uid = $_SESSION['userid'];
		$uname = $_SESSION['username'];
		//echo $uid;
	}
	else{
	//	echo "empty ".$uid;
	}

	if(isset($_POST['submit'])){
		$userName = validate($_POST['name']);
		$userEmail = validate($_POST['email']);
		$userMessage = validate($_POST['message']);

		include('config.php');
		$dates = date('Y-m-d');
		$sql = "INSERT INTO feedback ( name, email, date, message) 
				VALUES ('$userName','$userEmail','$dates','$userMessage')";

		if($conn->query($sql)){
			$_SESSION['error'] = false;
			header("location: feedbackmessage.php");
		}
		else{
			echo "error ".$conn->erro;
		}

		$conn->close();

	}

	function validate($data){
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);

		return $data;
	}
	
?>


<?php	
    function singleSlider($location,$ids,$name,$price,$isDiscountItem,$percent){ ?>
        <div class="col-md-3 col-sm-3 col-xs-12" id="itemSlider" onclick="productPage(<?php echo $ids; ?>);">
            <div class="slider-item" >
                <div class="slider-image">
                    <img src="<?php echo $location; ?>" class="img-responsive" alt="a" />
                </div>
                <div id="details" class="slider-main-detail">
                    <div class="slider-detail">
                        <div class="product-detail">
                            <h5 id="productName"><?php echo $name; ?></h5>
                            <h5 id="productPrice" class="detail-price"><?php 
                            	if($isDiscountItem){?>
	                            		<strike><?php echo $price."BDT"; ?></strike>
	                            		<strong> <?php echo intval ($price*(1-($percent)/100))." BDT "; ?> <span style="color: #148F77;"><?php echo " (".$percent."% OFF)"; ?></span>
	                            		</strong><?php
	                            }
                            	else{
                            		echo $price." BDT";
                            	}; ?>
                        	</h5>
                        </div>
                    </div>
                    <div class="cart-section">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-6 review" style="color: white;">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            </div>
                            <?php /*
                            <div class="col-md-6 col-sm-12 col-xs-6">
                                <a href="#" class="AddCart btn btn-info" style="background-color: rgba(244, 208, 63,.8);"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add To Cart</a>
                            </div>
                            */
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div> <?php
    }

    function sliderShow($tableNumber){
    	$dates = date('Y-m-d');
        include("config.php");
        $isDiscountItem = false;
        $percent=0;
        switch ($tableNumber) {
        	case '1':
        		$sql = "SELECT i.id, i.name, i.price,i.path
				FROM item i INNER JOIN availableitem ai ON ai.item_id = i.id
				WHERE ai.date = '$dates'";

        		break;
        	
        	case '2':
        		$sql = "SELECT i.id, i.name, i.price,i.path
				FROM item i INNER JOIN specialitem si ON si.item_id = i.id
				WHERE si.date = '$dates'";

        		break;

        	case '3':
        		$sql = "SELECT i.id, i.name, i.price,i.path, di.percentage
				FROM item i INNER JOIN discountitem di ON di.item_id = i.id
				WHERE di.date = '$dates'";

				$isDiscountItem = true;
        		break;


        	default:
        		 $sql = $sql = "SELECT id, name, price, path FROM item";
        		break;
        }
        
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            $i=0; //to count total number of items
            while ($row = $result->fetch_assoc()) {
                $location = "../restaurant/images/".$row['path'];
                $names = $row['name'];
                $prices = $row['price'];
                $ids = $row['id'];

                $sql2 = "SELECT  di.percentage FROM  discountitem di 
								WHERE di.date = '$dates' AND di.item_id = '$ids' ";

				$result2 = $conn->query($sql2);
				if($result2->num_rows > 0){
					while ($row2 = $result2->fetch_assoc()) {
						$percent = $row2['percentage'];
					}

					$isDiscountItem = true;

				}

              
                //to make a group with 4 items
                if($i%4==0){ 

                    //means it's the very first item group
                    if($i==0){?>
                        <div class="item active"> <?php
                    }
                    //means its another group but not the first one
                    else{ ?>
                        <div class="item"> <?php
                    } ?>
                    <div class="row"> <?php
                }

                singleSlider($location,$ids,$names,$prices,$isDiscountItem,$percent);

                if($i%4==3){ ?>
                    </div>
                    </div> <?php
                }
                $i++;
                $isDiscountItem = false;

            }

            if($i%4!=3){ ?>
                </div>
                </div> <?php
            }
        }
        else{
            echo "0 result ";
        }
        $conn->close();

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Home</title>

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
			border: 7px;
		}
		#drowdownMenu li{
			margin:2px;
		}
		
		#nav-item-name{
			color: #F1C40F;
		}

		#itemSlider:hover #details{
			background: #2E4053;
		}
		#itemSlider:hover{
			cursor: pointer;
		}
		#details{
			background: #212F3C;
		}
		#productName{
			color: white;
		}
		#productPrice{
			color: #F1C40F;
		}
		#aboutANDcontact{
			margin-top: 50px;
		}
		#about h1{
			padding: 16px;
		}
		#about p{
			font-size: 12px;
		}
		#contactus h1{
			padding-top: 16px;
		}
		#contactus #name, #email, #message{
			font-size: 16px;
			width: 100%;
			padding: 10px;
			margin: 10px;
			height: 40px;
			background: rgba(202, 207, 210,.7);
			border-radius: 7px;
		}
		#contactus #message{
			resize: none;
			height:120px;

		}

		#contactus #submit{
			width: 25%;
			height: 35px;
			font-size: 16px;
			background: rgba(46, 64, 83,.7);
			border: none;
			color: white;
		}

		#contactus #submit:hover{
			background: rgba(46, 64, 83,.4);
		}


	</style>


</head>

<body>

<!-- Navigation  navbar-dark bg-dark-->
	<nav class="navbar navbar-expand-lg navbar-dark  fixed-top" id="navigationbar" style="border-radius: 0px;">
	    <div class="container" id="nav-container">
		    <a class="navbar-brand" id="nav-item-name" href="#"><img src="images/logo.png" style="height: 50px; width: 50px;"></a>
		    <h4 id="nav-item-name" style="word-spacing: -5;">Foodie</h4>
		    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" id="navbarResponsive">
		        <ul class="navbar-nav ml-auto">
			        <li class="nav-item active">
			          <a class="nav-link" href="#" id="nav-item-name">Home
			            <span class="sr-only">(current)</span>
			          </a>
			        </li>

		        	<li class="nav-item">
			          <a class="nav-link" id="nav-item-name" href="#about" >About</a>
			        </li>
			        
			        <li class="nav-item">
			          <a class="nav-link" id="nav-item-name" href="#contactus">Contact</a>
			        </li>
			        
		        	<li class="nav-item dropdown">
		        		<a class="nav-link dropdown-toggle" id="nav-item-name" href="" data-toggle="dropdown">Menu</a>
		        		<ul class="dropdown-menu" role="menu" aria-labelledby="menu1" id="drowdownMenu">
						    <li role="presentation"><a role="menuitem" href="#availableITEM">Available Menu</a></li>
						    <li role="presentation"><a role="menuitem" href="#specialITEM">Special Menu</a></li>
						    <li role="presentation"><a role="menuitem" href="#discountITEM">Discount Menu</a></li>
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
			          			<a class="nav-link" id="nav-item-name" href="login.php">Login</a> <?php
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

	<header id="slider">
	  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
	    <ol class="carousel-indicators">
	      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
	      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
	      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
	    </ol>
	    <div class="carousel-inner" role="listbox">
	      <!-- Slide One - Set the background image for this slide in the line below -->
	      <div class="carousel-item active" style="background-image: url('images/1.jpg');width: 100%">
	        <div class="carousel-caption d-none d-sm-block">
	          <h3>Available Items</h3>
	          <p style="font-size: 14px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
	          <a href="#availableITEM" id="sliderLink">Check Now</a>
	        </div>
	      </div>
	      <!-- Slide Two - Set the background image for this slide in the line below -->
	      <div class="carousel-item" style="background-image: url('images/2.jpg');width: 100%">
	        <div class="carousel-caption d-none d-sm-block">
	          <h3>Special Items</h3>
	          <p style="font-size: 14px;" >Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
	          <a href="#specialITEM" id="sliderLink">Check Now</a>
	        </div>
	      </div>
	      <!-- Slide Three - Set the background image for this slide in the line below -->
	      <div class="carousel-item" style="background-image: url('images/3.jpg'); width: 100%;">
	        <div class="carousel-caption d-none d-sm-block">
	          <h3>Discount Items</h3>
	          <p style="font-size: 14px;" >Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
	          <a href="#discountITEM" id="sliderLink" >Check Now</a>
	        </div>
	      </div>
	    </div>
	    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
	      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	      <span class="sr-only">Previous</span>
	    </a>
	    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
	      <span class="carousel-control-next-icon" aria-hidden="true"></span>
	      <span class="sr-only">Next</span>
	    </a>
	  </div>
	</header>

	<!-- Page Content -->
	<section class="py-5" id="availableITEM">
		<div class="container">
	        <div class="row">
	            <div class="col-md-6 col-sm-6 col-xs-12">
	                <h1>Today's Items</h1>
	            </div>

	            <div class="col-md-6 col-sm-6 col-xs-6 hidden-xs">
	                <div class="controls pull-right">
	                    <a class="left fa fa-chevron-left btn btn-info " href="#carousel-example1" data-slide="prev"></a><a class="right fa fa-chevron-right btn btn-info" href="#carousel-example1" data-slide="next"></a>
	                </div>
	            </div>
	        </div>

	        <div id="carousel-example1" class="carousel slide hidden-xs" data-ride="carousel" data-type="multi">
	            <div class="carousel-inner">
	                <?php sliderShow(1); ?>
	            </div>
	        </div>
	    </div>
	</section>


	<section class="py-5" id="specialITEM">
		<div class="container">
	        <div class="row">
	            <div class="col-md-6 col-sm-6 col-xs-12">
	                <h1>Special Items</h1>
	            </div>

	            <div class="col-md-6 col-sm-6 col-xs-6 hidden-xs">
	                <div class="controls pull-right">
	                    <a class="left fa fa-chevron-left btn btn-info " href="#carousel-example2" data-slide="prev"></a><a class="right fa fa-chevron-right btn btn-info" href="#carousel-example2" data-slide="next"></a>
	                </div>
	            </div>
	        </div>

	        <div id="carousel-example2" class="carousel slide hidden-xs" data-ride="carousel" data-type="multi">
	            <div class="carousel-inner">
	                <?php sliderShow(2); ?>
	            </div>
	        </div>
	    </div>
	</section>


	<section class="py-5" id="discountITEM">
		<div class="container">
	        <div class="row">
	            <div class="col-md-6 col-sm-6 col-xs-12">
	                <h1>Discount Items</h1>
	            </div>

	            <div class="col-md-6 col-sm-6 col-xs-6 hidden-xs">
	                <div class="controls pull-right">
	                    <a class="left fa fa-chevron-left btn btn-info " href="#carousel-example3" data-slide="prev"></a><a class="right fa fa-chevron-right btn btn-info" href="#carousel-example3" data-slide="next"></a>
	                </div>
	            </div>
	        </div>

	        <div id="carousel-example3" class="carousel slide hidden-xs" data-ride="carousel" data-type="multi">
	            <div class="carousel-inner">
	                <?php sliderShow(3); ?>
	            </div>
	        </div>
	    </div>
	</section>

	<section class="py-5" id="aboutANDcontact" >
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-6" align="center" id="about">
	                <h1>ABOUT FOODIE RESTAURANT</h1>
	                <p>Providing western cuisine such as salad, soup, varieties of fried chicken, pizza & pasta, using 100% full taste of coffee bean for international coffee such as cappuccino, latte, espresso & others refreshing drinks. Can accommodate for up to …….. person at a time. Serving fresh & healthiest western cuisine such as salad, soup, varieties of fried & grilled chicken menu, pizza and refreshing cold & hot beverages likes international coffee.</p>
	                <hr>

					<h2>Why choose FOODIE?</h2>
					<p>serving fresh & healthiest western cuisine such as salad, soup, varieties of fried & grilled chicken menu, pizza and refreshing cold & hot beverages likes international coffee.</p>
	                <hr>

					<h2>What makes "BBQ" different?</h2> 
					<p>We are using only 100% Olive Oil in "bbq". You will be treated with the inimitable bbq’s taste and not compromising on the value of healthy-eating.</p>
					<h1>Keep Your Eyes on our page and stay tuned!!</h1>
	            </div>
	            <div class="col-md-6 col-sm-6 col-xs-6" align="center" id="contactus">
	                <h1>Contact US</h1>
	                <p>How can we help you?</p>
	                <form method="POST" action="">
		                <div><input type="text" name="name" id="name" placeholder="Your Name" required=""></div>
		                <div><input type="email" name="email" id="email" placeholder="Your email address" required=""></div>
		                <div><textarea type="text" name="message" id="message" placeholder="Your Messages..."  required="" maxlength="250"></textarea></div>
		                <input type="submit" id="submit" name="submit" value="submit" style="border-radius: 7px;">
	                </form>

	            </div>
			</div>
		</div>
	</section>

	<!-- Footer -->
	<footer class="py-5 bg-dark">
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


		function productPage(idz){
			var pagName = "productpreview.php?id=";
			var res = pagName.concat(idz);
			window.location = res;
		}

	</script>

</body>

</html>