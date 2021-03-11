<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
include_once 'product-action.php';
error_reporting(0);
session_start();
if (empty($_SESSION["user_id"])) {
    header('location:login.php');
} else {


    foreach ($_SESSION["cart_item"] as $item) {

        $item_total += ($item["price"] * $item["quantity"]);

        if ($_POST['submit']) {



            $radioVal = $_POST["mod"];

            if ($radioVal == "cod") {

                $SQL = "insert into users_orders(u_id,title,quantity,price) values('" . $_SESSION["user_id"] . "','" . $item["title"] . "','" . $item["quantity"] . "','" . $item_total . "')";
                mysqli_query($db, $SQL);
                $success = "Thankyou! Your Order Placed successfully!";
            } else if ($radioVal == "digital") {

                $SQL = "insert into users_orders(u_id,title,quantity,price) values('" . $_SESSION["user_id"] . "','" . $item["title"] . "','" . $item["quantity"] . "','" . $item_total . "')";
                mysqli_query($db, $SQL);
                header("Location: http://localhost/emed/paymentcheckout.php?price=$item_total");
            }
        }
    }
?>


    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="#">
        <title>Healthcare</title>
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
            <div class="site-wrapper">
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
                    <div class="top-links">
                        <div class="container">
                            <ul class="row links">


                                <li class="col-xs-12 col-sm-4 link-item active"><span>1</span><a href="restaurants.php">Choose Shop</a></li>
                                <li class="col-xs-12 col-sm-4 link-item"><span>2</span><a href="dishes.php">Pick Your Medicine</a></li>
                                <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="checkout.php">Order and Pay online</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="container">

                        <span style="color:green;">
                            <?php echo $success; ?>
                        </span>

                    </div>




                    <div class="container m-t-30">
                        <form action="" method="post">
                            <div class="widget clearfix">

                                <div class="widget-body">
                                    <form method="post" action="#">
                                        <div class="row">

                                            <div class="col-sm-12">
                                                <div class="cart-totals margin-b-20">
                                                    <div class="cart-totals-title">
                                                        <h4>Cart Summary</h4>
                                                    </div>
                                                    <div class="cart-totals-fields">

                                                        <table class="table">
                                                            <tbody>



                                                                <tr>
                                                                    <td>Cart Subtotal</td>
                                                                    <td> <?php echo "TK " . $item_total; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Shipping &amp; Handling</td>
                                                                    <td>free shipping</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-color"><strong>Total</strong></td>
                                                                    <td class="text-color"><strong> <?php echo "TK " . $item_total; ?></strong></td>
                                                                </tr>
                                                            </tbody>




                                                        </table>
                                                    </div>
                                                </div>
                                                <!--cart summary-->
                                                <div class="payment-option">
                                                    <ul class=" list-unstyled">
                                                        <li>
                                                            <label class="custom-control custom-radio  m-b-20">
                                                                <input name="mod" id="radioStacked1" value="cod" checked value="COD" type="radio" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Payment on delivery</span>
                                                                <br> <span>Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</span> </label>
                                                        </li>
                                                        <li>
                                                            <label class="custom-control custom-radio  m-b-10">
                                                                <input name="mod" type="radio" value="digital" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Digital Payment <img src="images/paypal.jpg" alt="" width="90"></span> </label>
                                                        </li>
                                                    </ul>
                                                    <p class="text-xs-center"> <input type="submit" onclick="return confirm('Are you sure?');" name="submit" class="btn btn-outline-success btn-block" value="Checkout"> </p>
                                                </div>
                                    </form>
                                </div>
                            </div>

                    </div>
                </div>
                </form>
            </div>

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
            <!-- end:Footer -->
        </div>
        <!-- end:page wrapper -->
        </div>
        </div>
        <!--/end:Site wrapper -->
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

<?php
}
?>