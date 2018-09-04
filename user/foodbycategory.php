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
?>

<?php	
	if(isset($_GET['id'])){
		$categoryNumber = $_GET['id'];


		switch ($categoryNumber) {
			case '1':
				$categoryName = "Pizza";
				$quote = "Life is short, eat the PIZZA!";
				break;
			case '2':
				$categoryName = "Pasta";
				$quote = "Eat PASTA run fasta!";
				break;
			case '3':
				$categoryName = "Burger";
				$quote = "Eat clean stay fit and have a BURGER to stay sane!";
				break;		
			default:
				$categoryName = "Beverage";
				$quote = "Hey, careful guys, There's a BEVERAGE here!";
				break;
		}

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

	    function sliderShow($categoryNumber){
	    	$dates = date('Y-m-d');
	        include("config.php");
	        $isDiscountItem = false;
	        $percent=0;

			 $sql = "SELECT i.id, i.name, i.price,i.path
					FROM item i INNER JOIN discountitem di ON di.item_id = i.id
					WHERE di.date = '$dates' AND i.category = '$categoryNumber' 
					UNION 
					SELECT i.id, i.name, i.price,i.path
					FROM item i INNER JOIN availableitem ai ON ai.item_id = i.id
					WHERE ai.date = '$dates' AND i.category = '$categoryNumber' ";
	 
	        
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
	                if($i%4==0){

	                	if($i!=0){ ?>
						<section class="py-5">
	                			<div class="container"> <?php
	                	}?>
	                    <div class="row"> <?php
	                }

	                singleSlider($location,$ids,$names,$prices,$isDiscountItem,$percent);

	                if($i%4==3){ ?>
	                    </div>
	                    </div>
	                </section>
	                   <?php
	                }
	                $i++;
	                $isDiscountItem = false;
	            }

	            if($i%4!=3){ ?>
	                </div>
	                </div>
	                <?php
	            }
	        }
	        else{
	            echo "0 result ";
	        }
	        $conn->close();

	    }

	}

	else{
		header("location:home.php");
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>FOODS</title>

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
		
		#heading{
			margin-top: 50px;
			width: 100%;
		    text-align: center;
		}
		#quote{
			 color: #2E4053; 
			 font-size: 20px;
			 font-family: "Comic Sans MS", cursive, sans-serif; 
			 font-weight: bold; 
			 letter-spacing: -1px; 
			 line-height: 1; 
			 text-align: center; 
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
	                <div id="quote">
						<?php echo $quote; ?>
					</div>
	            </div>
			</div>
		</div>	
	</section>

	<section class="py-5">
		<div class="container">
	        <div class="row">
	            <div class="col-md-6 col-sm-6 col-xs-12">
	                <div>
	                	<h1><?php echo $categoryName; ?></h1>
	                </div>
	            </div>
	        </div>

	        <div id="carousel-example1" class="carousel slide hidden-xs" data-ride="carousel" data-type="multi">
	            <div class="carousel-inner">
	            	<div class="item active">
		                <?php sliderShow($categoryNumber); ?>
		            </div>
	            </div>
	        </div>
	    </div>
	</section>

	<!-- Footer -->
	<footer class="py-5 bg-dark" style="margin-top: 50px;">
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