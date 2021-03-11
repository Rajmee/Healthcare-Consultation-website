<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php"); // connection to db
error_reporting(0);
session_start();

include_once 'product-action.php'; //including controller

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

        * {
            box-sizing: border-box;
        }

        .zoom {
            padding: 50px;
            background-color: transparent;
            transition: transform .2s;
            width: 200px;
            height: 200px;
            margin: 0 auto;
        }

        .zoom:hover {
            -ms-transform: scale(1.5);
            /* IE 9 */
            -webkit-transform: scale(1.5);
            /* Safari 3-8 */
            transform: scale(1.5);
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
            <div class="top-links">
                <div class="container">
                    <ul class="row links">

                        <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="restaurants.php">Choose Shop</a></li>
                        <li class="col-xs-12 col-sm-4 link-item active"><span>2</span><a href="dishes.php?res_id=<?php echo $_GET['res_id']; ?>">Pick Your medicine</a></li>
                        <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">Order and Pay online</a></li>
                    </ul>
                </div>
            </div>
            <!-- end:Top links -->
            <!-- start: Inner page hero -->
            <?php $ress = mysqli_query($db, "select * from restaurant where rs_id='$_GET[res_id]'");
            $rows = mysqli_fetch_array($ress);

            ?>
            <section class="inner-page-hero bg-image" data-image-src="images/img/banner-1.jpg">
                <div class="profile">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12  col-md-4 col-lg-4 profile-img">
                                <div class="image-wrap">
                                    <figure><?php echo '<img src="admin/Res_img/' . $rows['image'] . '" alt="Restaurant logo">'; ?></figure>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 profile-desc">
                                <div class="pull-left right-text white-txt">
                                    <h6><a href="#"><?php echo $rows['title']; ?></a></h6>
                                    <p><?php echo $rows['address']; ?></p>
                                    <p><?php echo $rows['url']; ?></p>
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
                                    Your Shopping Cart
                                </h3>


                                <div class="clearfix"></div>
                            </div>
                            <div class="order-row bg-white">
                                <div class="widget-body">


                                    <?php

                                    $item_total = 0;

                                    foreach ($_SESSION["cart_item"] as $item)  // fetch items define current into session ID
                                    {
                                    ?>

                                        <div class="title-row">
                                            <?php echo $item["title"]; ?><a href="dishes.php?res_id=<?php echo $_GET['res_id']; ?>&action=remove&id=<?php echo $item["d_id"]; ?>">
                                                <i class="fa fa-trash pull-right"></i></a>
                                        </div>

                                        <div class="form-group row no-gutter">
                                            <div class="col-xs-8">
                                                <input type="text" class="form-control b-r-0" value=<?php echo "TK" . $item["price"]; ?> readonly id="exampleSelect1">

                                            </div>
                                            <div class="col-xs-4">
                                                <input class="form-control" type="text" readonly value='<?php echo $item["quantity"]; ?>' id="example-number-input">
                                            </div>

                                        </div>

                                    <?php
                                        $item_total += ($item["price"] * $item["quantity"]); // calculating current price into cart
                                    }
                                    ?>



                                </div>
                            </div>

                            <!-- end:Order row -->

                            <div class="widget-body">
                                <div class="price-wrap text-xs-center">
                                    <p>TOTAL</p>
                                    <h3 class="value"><strong><?php echo "TK " . $item_total; ?></strong></h3>
                                    <p>Free Shipping</p>
                                    <a href="checkout.php?res_id=<?php echo $_GET['res_id']; ?>&action=check" class="btn theme-btn btn-lg">Checkout</a>
                                </div>
                            </div>




                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-6">

                        <!-- end:Widget menu -->
                        <div class="menu-widget" id="2">
                            <div class="widget-heading">
                                <h3 class="widget-title text-dark">
                                    All medicine ! <a class="btn btn-link pull-right" data-toggle="collapse" href="#popular2" aria-expanded="true">
                                        <i class="fa fa-angle-right pull-right"></i>
                                        <i class="fa fa-angle-down pull-right"></i>
                                    </a>
                                </h3>
                                <div class="clearfix"></div>
                            </div>
                            <div class="collapse in" id="popular2">
                                <?php  // display values and item of food/dishes
                                $stmt = $db->prepare("select * from dishes where rs_id='$_GET[res_id]'");
                                $stmt->execute();
                                $products = $stmt->get_result();
                                if (!empty($products)) {
                                    foreach ($products as $product) {



                                ?>
                                        <div class="food-item">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-lg-8">
                                                    <form method="post" action='dishes.php?res_id=<?php echo $_GET['res_id']; ?>&action=add&id=<?php echo $product['d_id']; ?>'>
                                                        <div class="rest-logo pull-left">
                                                            <a class="restaurant-logo pull-left" href="#"><?php echo '<img src="admin/Res_img/dishes/' . $product['img'] . '" alt="Medicine img">'; ?></a>
                                                        </div>
                                                        <!-- end:Logo -->
                                                        <div class="rest-descr">
                                                            <h6><a href="#"><?php echo $product['title']; ?></a></h6>
                                                            <p> <?php echo $product['slogan']; ?></p>
                                                        </div>
                                                        <!-- end:Description -->
                                                </div>
                                                <!-- end:col -->
                                                <div class="col-xs-12 col-sm-12 col-lg-4 pull-right item-cart-info">
                                                    <span class="price pull-left">TK <?php echo $product['price']; ?></span>
                                                    <input class="b-r-0" type="text" name="quantity" style="margin-left:30px;" value="1" size="2" />
                                                    <input type="submit" class="btn theme-btn" style="margin-left:40px;" value="Add to cart" />
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
                    <div class="col-xs-12 col-md-12 col-lg-3">
                        <div class="sidebar-wrap">
                            <div class="widget clearfix">
                                <!-- /widget heading -->
                                <div class="widget-heading">
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
                    </div>
                    <!-- end:Right Sidebar -->
                </div>
                <!-- end:row -->
            </div>
            <!-- end:Container -->
            <!-- How it works block starts -->
            <section class="how-it-works">
                <div class="container">
                    <div class="text-xs-center">
                        <h2>Easy 3 Step Order</h2>
                        <!-- 3 block sections starts -->
                        <div class="row how-it-works-solution">
                            <div class="col-xs-12 col-sm-12 col-md-4 how-it-works-steps white-txt col1">
                                <div class="how-it-works-wrap">
                                    <div class="step step-1">
                                        <div class="icon" data-step="1">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 483 483" width="512" height="512">
                                                <g fill="#FFF">
                                                    <path d="M467.006 177.92c-.055-1.573-.469-3.321-1.233-4.755L407.006 62.877V10.5c0-5.799-4.701-10.5-10.5-10.5h-310c-5.799 0-10.5 4.701-10.5 10.5v52.375L17.228 173.164a10.476 10.476 0 0 0-1.22 4.938h-.014V472.5c0 5.799 4.701 10.5 10.5 10.5h430.012c5.799 0 10.5-4.701 10.5-10.5V177.92zM282.379 76l18.007 91.602H182.583L200.445 76h81.934zm19.391 112.602c-4.964 29.003-30.096 51.143-60.281 51.143-30.173 0-55.295-22.139-60.258-51.143H301.77zm143.331 0c-4.96 29.003-30.075 51.143-60.237 51.143-30.185 0-55.317-22.139-60.281-51.143h120.518zm-123.314-21L303.78 76h86.423l48.81 91.602H321.787zM97.006 55V21h289v34h-289zm-4.198 21h86.243l-17.863 91.602h-117.2L92.808 76zm65.582 112.602c-5.028 28.475-30.113 50.19-60.229 50.19s-55.201-21.715-60.23-50.19H158.39zM300 462H183V306h117v156zm21 0V295.5c0-5.799-4.701-10.5-10.5-10.5h-138c-5.799 0-10.5 4.701-10.5 10.5V462H36.994V232.743a82.558 82.558 0 0 0 3.101 3.255c15.485 15.344 36.106 23.794 58.065 23.794s42.58-8.45 58.065-23.794a81.625 81.625 0 0 0 13.525-17.672c14.067 25.281 40.944 42.418 71.737 42.418 30.752 0 57.597-17.081 71.688-42.294 14.091 25.213 40.936 42.294 71.688 42.294 24.262 0 46.092-10.645 61.143-27.528V462H321z" />
                                                    <path d="M202.494 386h22c5.799 0 10.5-4.701 10.5-10.5s-4.701-10.5-10.5-10.5h-22c-5.799 0-10.5 4.701-10.5 10.5s4.701 10.5 10.5 10.5z" />
                                                </g>
                                            </svg>
                                        </div>
                                        <h3>Choose a medicine shop</h3>
                                        <p>We"ve got your covered with medicine from over 345 delivery pharmacy online.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 how-it-works-steps white-txt col2">
                                <div class="step step-2">
                                    <div class="icon" data-step="2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewbox="0 0 580.721 580.721">
                                            <g fill="#FFF">
                                                <path d="m443.742188 117.851562h-58.003907v-64.222656c0-29.570312-24.054687-53.628906-53.628906-53.628906h-152.21875c-29.574219 0-53.628906 24.058594-53.628906 53.628906v64.222656h-58.003907c-37.636718 0-68.257812 30.621094-68.257812 68.257813v310.890625c0 8.285156 6.714844 15 15 15h482c8.285156 0 15-6.714844 15-15v-310.890625c0-37.636719-30.621094-68.257813-68.257812-68.257813zm-287.480469-64.222656c0-13.027344 10.597656-23.628906 23.628906-23.628906h152.222656c13.027344 0 23.628907 10.601562 23.628907 23.628906v64.222656h-30v-32.851562c0-13.785156-11.214844-25-25-25h-89.480469c-13.785157 0-25 11.214844-25 25v32.851562h-30zm139.476562 64.222656h-79.476562v-27.851562h79.476562zm-227.480469 30h375.484376c21.097656 0 38.257812 17.164063 38.257812 38.257813v31.976563h-452v-31.976563c0-21.09375 17.160156-38.257813 38.257812-38.257813zm-38.257812 334.148438v-233.914062h452v233.914062zm0 0" />
                                                <path d="m328.445312 321.148438h-27.429687v-27.433594c0-8.285156-6.71875-15-15-15h-60.03125c-8.285156 0-15 6.714844-15 15v27.433594h-27.433594c-8.28125 0-15 6.714843-15 15v60.027343c0 8.285157 6.71875 15 15 15h27.433594v27.433594c0 8.285156 6.714844 15 15 15h60.03125c8.28125 0 15-6.714844 15-15v-27.433594h27.429687c8.285157 0 15-6.714843 15-15v-60.027343c0-8.285157-6.714843-15-15-15zm-15 60.027343h-27.429687c-8.285156 0-15 6.71875-15 15v27.433594h-30.03125v-27.433594c0-8.28125-6.714844-15-15-15h-27.433594v-30.027343h27.433594c8.285156 0 15-6.71875 15-15v-27.433594h30.03125v27.433594c0 8.28125 6.714844 15 15 15h27.429687zm0 0" />
                                            </g>
                                        </svg>
                                    </div>
                                    <h3>Choose medicine</h3>
                                    <p>We"ve got your covered with medicine from over 345 delivery pharmacy online.</p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 how-it-works-steps white-txt col3">
                                <div class="step step-3">
                                    <div class="icon" data-step="3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewbox="0 0 612.001 612">
                                            <path d="M604.131 440.17h-19.12V333.237c0-12.512-3.776-24.787-10.78-35.173l-47.92-70.975a62.99 62.99 0 0 0-52.169-27.698h-74.28c-8.734 0-15.737 7.082-15.737 15.738v225.043h-121.65c11.567 9.992 19.514 23.92 21.796 39.658H412.53c4.563-31.238 31.475-55.396 63.972-55.396 32.498 0 59.33 24.158 63.895 55.396h63.735c4.328 0 7.869-3.541 7.869-7.869V448.04c-.001-4.327-3.541-7.87-7.87-7.87zM525.76 312.227h-98.044a7.842 7.842 0 0 1-7.868-7.869v-54.372c0-4.328 3.541-7.869 7.868-7.869h59.724c2.597 0 4.957 1.259 6.452 3.305l38.32 54.451c3.619 5.194-.079 12.354-6.452 12.354zM476.502 440.17c-27.068 0-48.943 21.953-48.943 49.021 0 26.99 21.875 48.943 48.943 48.943 26.989 0 48.943-21.953 48.943-48.943 0-27.066-21.954-49.021-48.943-49.021zm0 73.495c-13.535 0-24.472-11.016-24.472-24.471 0-13.535 10.937-24.473 24.472-24.473 13.533 0 24.472 10.938 24.472 24.473 0 13.455-10.938 24.471-24.472 24.471zM68.434 440.17c-4.328 0-7.869 3.543-7.869 7.869v23.922c0 4.328 3.541 7.869 7.869 7.869h87.971c2.282-15.738 10.229-29.666 21.718-39.658H68.434v-.002zm151.864 0c-26.989 0-48.943 21.953-48.943 49.021 0 26.99 21.954 48.943 48.943 48.943 27.068 0 48.943-21.953 48.943-48.943.001-27.066-21.874-49.021-48.943-49.021zm0 73.495c-13.534 0-24.471-11.016-24.471-24.471 0-13.535 10.937-24.473 24.471-24.473s24.472 10.938 24.472 24.473c0 13.455-10.938 24.471-24.472 24.471zm117.716-363.06h-91.198c4.485 13.298 6.846 27.54 6.846 42.255 0 74.28-60.431 134.711-134.711 134.711-13.535 0-26.675-2.045-39.029-5.744v86.949c0 4.328 3.541 7.869 7.869 7.869h265.96c4.329 0 7.869-3.541 7.869-7.869V174.211c-.001-13.062-10.545-23.606-23.606-23.606zM118.969 73.866C53.264 73.866 0 127.129 0 192.834s53.264 118.969 118.969 118.969 118.97-53.264 118.97-118.969-53.265-118.968-118.97-118.968zm0 210.864c-50.752 0-91.896-41.143-91.896-91.896s41.144-91.896 91.896-91.896c50.753 0 91.896 41.144 91.896 91.896 0 50.753-41.143 91.896-91.896 91.896zm35.097-72.488c-1.014 0-2.052-.131-3.082-.407L112.641 201.5a11.808 11.808 0 0 1-8.729-11.396v-59.015c0-6.516 5.287-11.803 11.803-11.803 6.516 0 11.803 5.287 11.803 11.803v49.971l29.614 7.983c6.294 1.698 10.02 8.177 8.322 14.469-1.421 5.264-6.185 8.73-11.388 8.73z" fill="#FFF" />
                                        </svg>
                                    </div>
                                    <h3>Pick up or Delivery</h3>
                                    <p>Get your medcine delivered! And cure your body! Pay online on pickup or delivery</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 3 block sections ends -->
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <p class="pay-info">Pay by Cash on delivery</p>
                        </div>
                    </div>
                </div>
            </section>

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