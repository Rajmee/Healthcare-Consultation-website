<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php"); // connection to db
error_reporting(0);
session_start();

include_once 'doctor-action.php'; //including controller

?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Starter Template for Bootstrap</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <style>
        .navbar .nav-item:not(:last-child) {
            margin-right: 5px;
        }

        .dropdown-toggle::after {
            transition: transform 0.15s linear;
        }

        .show.dropdown .dropdown-toggle::after {
            transform: translateY(3px);
        }

        .dropdown-menu {
            margin-top: 0;
        }
    </style>
</head>

<body>
    <div class="site-wrapper animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
        <!--header starts-->
        <header id="header" class="header-scroll top-header headrom">
            <!-- .navbar -->
            <nav class="navbar navbar-dark">
                <div class="container">
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                    <a class="navbar-brand" href="index.html"> <img class="img-rounded" style="margin-top:-12px" src="images/doc-logo.png" alt=""> </a>
                    <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
                            <li class="nav-item"> <a class="nav-link active" href="restaurants.php">E-Medicine <span class="sr-only"></span></a> </li>
                            <li class="nav-item"> <a class="nav-link active" href="doctor_appoinment.php">Doctor Appointment <span class="sr-only"></span></a> </li>



                            <?php
                            if (empty($_SESSION["user_id"])) // if user is not login
                            {
                                echo
                                '<li class="nav-item dropdown"><a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true">Login</a> 
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                                <a class="dropdown-item" href="login.php">As a Patient</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="doctor_login.php">As a Doctor</a>
                                </div>                                
                                </li>
                                <li class="nav-item"><a href="registration.php" class="nav-link active">Signup</a> </li>';
                                // echo '<li class="nav-item"><a href="doctor_login.php" class="nav-link active">As a Doctor</a> </li>
                                // <li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>                                
                                // <li class="nav-item"><a href="registration.php" class="nav-link active">Signup</a> </li>';
                            } else {
                                //if user is login

                                echo
                                '<li class="nav-item dropdown"><a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true">' . $_SESSION["user_name"] . '</a> 
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                                <a class="dropdown-item" href="your_orders.php">My Orders</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="view_schedule.php">View Schedule</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">Logout</a>
                                </div>                                
                                </li>';
                            }

                            ?>

                        </ul>

                    </div>
                </div>
            </nav>
            <!-- /.navbar -->
        </header>
        <div class="page-wrapper">
            <!-- top Links -->
            <!-- <div class="top-links">
                <div class="container">
                    <ul class="row links">
                      
                        <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="restaurants.php">Choose Restaurant</a></li>
                        <li class="col-xs-12 col-sm-4 link-item active"><span>2</span><a href="dishes.php?res_id=<?php echo $_GET['res_id']; ?>">Pick Your favorite food</a></li>
                        <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">Order and Pay online</a></li>
                    </ul>
                </div>
            </div> -->
            <!-- end:Top links -->
            <!-- start: Inner page hero -->
            <?php $ress = mysqli_query($db, "select * from dep_cat where dep_id='$_GET[dp_id]'");
            $rows = mysqli_fetch_array($ress);

            ?>
            <section class="inner-page-hero bg-image" data-image-src="images/img/banner-1.jpg">
                <div class="profile">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12  col-md-4 col-lg-4 profile-img">
                                <div class="image-wrap">
                                    <figure><?php echo '<img src="admin/Res_img/dep/5fc6c31dcc11c.jpg' . $rows['image'] . '" alt="Restaurant logo">'; ?></figure>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 profile-desc">
                                <div class="pull-left right-text white-txt">
                                    <h6><a href="#"><?php echo $rows['title']; ?></a></h6>
                                    <p><?php echo $rows['address']; ?></p>
                                    <p><?php echo $rows['descr']; ?></p>
                                    </ul>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </section>
            <!-- end:Inner page hero -->
            <div class="breadcrumb">
                <div class="container">

                </div>
            </div>
            <div class="container m-t-30">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">

                        <div class="widget widget-cart">
                            <div class="widget-heading">
                                <h3 class="widget-title text-dark">
                                    Your Doctor Name
                                </h3>


                                <div class="clearfix"></div>
                            </div>
                            <div class="order-row bg-white">
                                <div class="widget-body">


                                    <?php

                                    $item_total = 0;

                                    foreach ($_SESSION["doc_item"] as $item)  // fetch items define current into session ID
                                    {
                                    ?>

                                        <div class="title-row">
                                            <?php echo $item["title"]; ?><a href="doctor.php?dp_id=<?php echo $_GET['dp_id']; ?>&doc_action=remove&id=<?php echo $item["doc_id"]; ?>">
                                                <i class="fa fa-trash pull-right"></i></a>
                                        </div>

                                        <div class="form-group row no-gutter">
                                            <div class="col-xs-8">
                                                <input type="text" class="form-control b-r-0" value=<?php echo "TK" . $item["fee"]; ?> readonly id="exampleSelect1">

                                            </div>


                                        </div>

                                    <?php
                                        $item_total += ($item["fee"]); // calculating current price into cart
                                    }
                                    ?>



                                </div>
                            </div>

                            <!-- end:Order row -->

                            <div class="widget-body">
                                <div class="price-wrap text-xs-center">
                                    <p>TOTAL</p>
                                    <h3 class="value"><strong><?php echo "TK " . $item_total; ?></strong></h3>

                                    <a href="doc_checkout.php?dp_id=<?php echo $_GET['dp_id']; ?>&doc_action=check" class="btn theme-btn btn-lg">Checkout</a>
                                </div>
                            </div>




                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">

                        <!-- end:Widget menu -->
                        <div class="menu-widget" id="2">
                            <div class="widget-heading">
                                <h3 class="widget-title text-dark">
                                    POPULAR DOCTORS<a class="btn btn-link pull-right" data-toggle="collapse" href="#popular2" aria-expanded="true">
                                        <i class="fa fa-angle-right pull-right"></i>
                                        <i class="fa fa-angle-down pull-right"></i>
                                    </a>
                                </h3>
                                <div class="clearfix"></div>
                            </div>
                            <div class="collapse in" id="popular2">
                                <?php  // display values and item of food/dishes
                                $stmt = $db->prepare("select * from doclist where dep_id='$_GET[dp_id]'");
                                $stmt->execute();
                                $doctors = $stmt->get_result();
                                if (!empty($doctors)) {
                                    foreach ($doctors as $doctor) {

                                ?>
                                        <div class="food-item">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-lg-8">
                                                    <form method="post" action='doctor.php?dp_id=<?php echo $_GET['dp_id']; ?>&doc_action=add&id=<?php echo $doctor['doc_id']; ?>'>
                                                        <div class="rest-logo pull-left">
                                                            <a class="restaurant-logo pull-left" href="#"><?php echo '<img src="admin/Res_img/doc/' . $doctor['img'] . '" alt="Food logo">'; ?></a>
                                                        </div>
                                                        <!-- end:Logo -->
                                                        <div class="rest-descr">
                                                            <h6><a href="#"><?php echo $doctor['title']; ?></a></h6>
                                                            <p> <?php echo $doctor['info']; ?></p>
                                                            <?php echo '<a href="doc_schedule.php?doc_sch=' . $doctor['doc_id'] . '" class="btn btn-success btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-calendar"></i></a>' ?>
                                                            <!-- <h6><a href="doc_schedule.php?doc_sch= ">Schedule</a></h6> -->
                                                        </div>
                                                        <!-- end:Description -->
                                                </div>
                                                <!-- end:col -->
                                                <div class="col-xs-12 col-sm-12 col-lg-4 pull-right item-cart-info">
                                                    <span class="price pull-left">TK <?php echo $doctor['fee']; ?></span>

                                                    <input type="submit" class="btn theme-btn" style="margin-left:10px;" value="Set Appointment" />

                                                </div>
                                                </form>
                                            </div>
                                            <!-- end:row -->
                                        </div>
                                        <!-- end:Food item -->

                                <?php
                                    }
                                }

                                ?>



                            </div>
                            <!-- end:Collapse -->
                        </div>
                        <!-- end:Widget menu -->

                    </div>
                    <!-- end:Bar -->
                    <!-- <div class="col-xs-12 col-md-12 col-lg-3">
                        <div class="sidebar-wrap">
                            <div class="widget clearfix"> -->
                                <!-- /widget heading -->
                                <!-- <div class="widget-heading">
                                    <h3 class="widget-title text-dark">
                                        Popular tags
                                    </h3>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="widget-body">
                                    <ul class="tags">
                                        <li> <a href="#" class="tag">
                                                Napa
                                            </a> </li>
                                        <li> <a href="#" class="tag">
                                                Sergil
                                            </a> </li>
                                        <li> <a href="#" class="tag">
                                                Losectil
                                            </a> </li>
                                        <li> <a href="#" class="tag">
                                                Artica
                                            </a> </li>
                                        <li> <a href="#" class="tag">
                                                Vitamil C
                                            </a> </li>
                                        <li> <a href="#" class="tag">
                                                Cal-D
                                            </a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- end:Right Sidebar -->
                </div>
                <!-- end:row -->
            </div>
            <!-- end:Container -->

            <!-- start: FOOTER -->
            <footer class="footer">
                <div class="container">
                    <div class="bottom-footer">
                        <div class="row">
                            <div class="col-xs-12 col-sm-3 payment-options color-gray">

                                <a href="#"> <img src="images/doc-logo.png" alt="Footer logo"> </a><br><br> <span>Order Delivery &amp; Consult </span>

                            </div>
                            <div class="col-xs-12 col-sm-4 address color-gray">
                                <h5>Address</h5>
                                <p>House 56, Rd 4/A @ Satmasjid Road Dhanmondi, Dhaka-1209, Bangladesh</p>
                                <h5>Phone: <a href="tel:+8801851109986">+880 1851 109986</a></h5>
                            </div>
                            <div class="col-xs-12 col-sm-5 additional-info color-gray">
                                <h5>Addition informations</h5>
                                <p>Join the thousands of other shop who benefit from having their medicine on TakeOff</p>
                            </div>
                        </div>
                    </div>
                    <!-- bottom footer ends -->
                </div>
            </footer>
            <!-- end:Footer -->
        </div>
        <!-- end:page wrapper -->
    </div>
    <!--/end:Site wrapper -->
    <!-- Modal -->
    <div class="modal fade" id="order-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                <div class="modal-body cart-addon">
                    <div class="food-item white">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left" href="#"><img src="http://placehold.it/70x70" alt="Food logo"></a>
                                </div>
                                <!-- end:Logo -->
                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande Menü (28 - 30 cm.)</a></h6>
                                </div>
                                <!-- end:Description -->
                            </div>
                            <!-- end:col -->
                            <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center"> <span class="price pull-left">$ 2.99</span></div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0" id="exampleSelect2">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control" type="number" value="0" id="quant-input-2">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end:row -->
                    </div>
                    <!-- end:Food item -->
                    <div class="food-item">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left" href="#"><img src="http://placehold.it/70x70" alt="Food logo"></a>
                                </div>
                                <!-- end:Logo -->
                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande Menü (28 - 30 cm.)</a></h6>
                                </div>
                                <!-- end:Description -->
                            </div>
                            <!-- end:col -->
                            <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center"> <span class="price pull-left">$ 2.49</span></div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0" id="exampleSelect3">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control" type="number" value="0" id="quant-input-3">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end:row -->
                    </div>
                    <!-- end:Food item -->
                    <div class="food-item">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left" href="#"><img src="http://placehold.it/70x70" alt="Food logo"></a>
                                </div>
                                <!-- end:Logo -->
                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande Menü (28 - 30 cm.)</a></h6>
                                </div>
                                <!-- end:Description -->
                            </div>
                            <!-- end:col -->
                            <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center"> <span class="price pull-left">$ 1.99</span></div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0" id="exampleSelect5">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control" type="number" value="0" id="quant-input-4">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end:row -->
                    </div>
                    <!-- end:Food item -->
                    <div class="food-item">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left" href="#"><img src="http://placehold.it/70x70" alt="Food logo"></a>
                                </div>
                                <!-- end:Logo -->
                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande Menü (28 - 30 cm.)</a></h6>
                                </div>
                                <!-- end:Description -->
                            </div>
                            <!-- end:col -->
                            <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center"> <span class="price pull-left">$ 3.15</span></div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0" id="exampleSelect6">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control" type="number" value="0" id="quant-input-5">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end:row -->
                    </div>
                    <!-- end:Food item -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn theme-btn">Add to cart</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
    <script src="js/dropdown.js"></script>
</body>

</html>