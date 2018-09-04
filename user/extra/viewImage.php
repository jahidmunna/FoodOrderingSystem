<?php
    function singleSlider($location,$name){ ?>
        <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="slider-item">
                <div class="slider-image">
                    <img src="<?php echo $location; ?>" class="img-responsive" alt="a" />
                </div>
                <div class="slider-main-detail">
                    <div class="slider-detail">
                        <div class="product-detail">
                            <h5><?php echo $name; ?></h5>
                            <h5 class="detail-price">$187.87</h5>
                        </div>
                    </div>
                    <div class="cart-section">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-6 review">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-6">
                                <a href="#" class="AddCart btn btn-info"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add To Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <?php
    }

    function sliderShow(){
        include("config.php");
        $sql = "SELECT id, name, path FROM item";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            $i=0; //to count total number of items
            while ($row = $result->fetch_assoc()) {
                $location = "../restaurant/images/".$row['path'];
                $names = $row['name'];

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

                singleSlider($location,$names);

                if($i%4==3){ ?>
                    </div>
                    </div> <?php
                }
                $i++;
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
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min1.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min1.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min1.css">
    <script src="js/jquery.min1.js"></script>
    <script src="js/owl.carousel1.js"></script>
    <script src="css/owl.theme.min1.css"></script>
    <script src="css/owl.carousel1.css"></script>
    <script src="js/bootstrap.min1.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style-item1.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <h3>Product Slider</h3>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-6 hidden-xs">
                <div class="controls pull-right">
                    <a class="left fa fa-chevron-left btn btn-info " href="#carousel-example" data-slide="prev"></a><a class="right fa fa-chevron-right btn btn-info" href="#carousel-example" data-slide="next"></a>
                </div>
            </div>
        </div>

        <div id="carousel-example" class="carousel slide hidden-xs" data-ride="carousel" data-type="multi">
            <div class="carousel-inner">
                <?php sliderShow(); ?>
            </div>
        </div>
    </div>
</body>
</html>
