<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");  //include connection file
error_reporting(0);  // using to hide undefine undex errors
session_start(); //start temp session until logout/browser closed

?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Heathcare</title>
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

        .zoom-within-container {
            height: 300px;
            /* [1.1] Set it as per your need */
            overflow: hidden;
            /* [1.2] Hide the overflowing of child elements */
        }

        .zoom-within-container img {
            transition: transform .5s ease;
        }

        .zoom-within-container:hover img {
            transform: scale(1.5);
        }

        /* Without Container */
        .zoom-without-container {
            transition: transform .2s;
            /* Animation */
            margin: 0 auto;
        }

        .zoom-without-container img {
            width: 100%;
            height: auto;
        }

        .zoom-without-container:hover {
            transform: scale(1.5);
            /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
        }

        * {
            box-sizing: border-box;
        }

        .zoom {
            padding: 50px;
            background-color: green;
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

<body class="home">
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

                                // echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">My Orders</a> </li>';
                                // echo  '<li class="nav-item"><a href="view_schedule.php" class="nav-link active">View Schedule</a> </li>';
                                // echo  '<li class="nav-item"><a href="" class="nav-link active"> '. $_SESSION["user_name"] .'</a> </li>';
                                // echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a> </li>';
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
        <!-- banner part starts -->
        <section class="hero bg-image" data-image-src="images/img/banner.png">
            <div class="hero-inner">
                <div class="container text-center hero-text font-white">
                    <h1>Medicine Delivery & Consultation </h1>
                    <h5 class="font-white space-xs">Find shop, specials, and coupons for free</h5>
                    <div class="banner-form">
                        <?php
                        if (isset($_POST['search'])) {
                            $searchKey = $_POST['search'];
                            $query_res = mysqli_query($db, "SELECT * FROM dishes WHERE title LIKE '%$searchKey%'");
                            // $sql = "SELECT * FROM dishes WHERE title LIKE '%$searchKey%'";
                        } else {
                            $query_res = mysqli_query($db, "SELECT * FROM dishes LIMIT 6");
                            $searchKey = "";
                        }
                        ?>

                        <form class="form-inline" action="" method="POST">
                            <div class="form-group">
                                <label class="sr-only" for="exampleInputAmount">I would like to buy....</label>
                                <div class="form-group">
                                    <input type="text" name="search" id="search" class="form-control form-control-lg" value="<?php echo $searchKey; ?>" placeholder="I would like to buy....">
                                </div>
                            </div>
                            <button type="submit" class="btn theme-btn btn-lg">Search medicine</button>
                        </form>
                    </div>
                    <div class="steps">
                        <div class="step-item step1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 483 483" width="512" height="512">
                                <g fill="#FFF">
                                    <path d="M467.006 177.92c-.055-1.573-.469-3.321-1.233-4.755L407.006 62.877V10.5c0-5.799-4.701-10.5-10.5-10.5h-310c-5.799 0-10.5 4.701-10.5 10.5v52.375L17.228 173.164a10.476 10.476 0 0 0-1.22 4.938h-.014V472.5c0 5.799 4.701 10.5 10.5 10.5h430.012c5.799 0 10.5-4.701 10.5-10.5V177.92zM282.379 76l18.007 91.602H182.583L200.445 76h81.934zm19.391 112.602c-4.964 29.003-30.096 51.143-60.281 51.143-30.173 0-55.295-22.139-60.258-51.143H301.77zm143.331 0c-4.96 29.003-30.075 51.143-60.237 51.143-30.185 0-55.317-22.139-60.281-51.143h120.518zm-123.314-21L303.78 76h86.423l48.81 91.602H321.787zM97.006 55V21h289v34h-289zm-4.198 21h86.243l-17.863 91.602h-117.2L92.808 76zm65.582 112.602c-5.028 28.475-30.113 50.19-60.229 50.19s-55.201-21.715-60.23-50.19H158.39zM300 462H183V306h117v156zm21 0V295.5c0-5.799-4.701-10.5-10.5-10.5h-138c-5.799 0-10.5 4.701-10.5 10.5V462H36.994V232.743a82.558 82.558 0 0 0 3.101 3.255c15.485 15.344 36.106 23.794 58.065 23.794s42.58-8.45 58.065-23.794a81.625 81.625 0 0 0 13.525-17.672c14.067 25.281 40.944 42.418 71.737 42.418 30.752 0 57.597-17.081 71.688-42.294 14.091 25.213 40.936 42.294 71.688 42.294 24.262 0 46.092-10.645 61.143-27.528V462H321z"></path>
                                    <path d="M202.494 386h22c5.799 0 10.5-4.701 10.5-10.5s-4.701-10.5-10.5-10.5h-22c-5.799 0-10.5 4.701-10.5 10.5s4.701 10.5 10.5 10.5z"></path>
                                </g>
                            </svg>
                            <h4><span>1. </span>Choose Shop</h4>
                        </div>
                        <!-- end:Step -->
                        <div class="step-item step2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewbox="0 0 580.721 580.721">
                                <g fill="#FFF">
                                    <path d="m443.742188 117.851562h-58.003907v-64.222656c0-29.570312-24.054687-53.628906-53.628906-53.628906h-152.21875c-29.574219 0-53.628906 24.058594-53.628906 53.628906v64.222656h-58.003907c-37.636718 0-68.257812 30.621094-68.257812 68.257813v310.890625c0 8.285156 6.714844 15 15 15h482c8.285156 0 15-6.714844 15-15v-310.890625c0-37.636719-30.621094-68.257813-68.257812-68.257813zm-287.480469-64.222656c0-13.027344 10.597656-23.628906 23.628906-23.628906h152.222656c13.027344 0 23.628907 10.601562 23.628907 23.628906v64.222656h-30v-32.851562c0-13.785156-11.214844-25-25-25h-89.480469c-13.785157 0-25 11.214844-25 25v32.851562h-30zm139.476562 64.222656h-79.476562v-27.851562h79.476562zm-227.480469 30h375.484376c21.097656 0 38.257812 17.164063 38.257812 38.257813v31.976563h-452v-31.976563c0-21.09375 17.160156-38.257813 38.257812-38.257813zm-38.257812 334.148438v-233.914062h452v233.914062zm0 0" />
                                    <path d="m328.445312 321.148438h-27.429687v-27.433594c0-8.285156-6.71875-15-15-15h-60.03125c-8.285156 0-15 6.714844-15 15v27.433594h-27.433594c-8.28125 0-15 6.714843-15 15v60.027343c0 8.285157 6.71875 15 15 15h27.433594v27.433594c0 8.285156 6.714844 15 15 15h60.03125c8.28125 0 15-6.714844 15-15v-27.433594h27.429687c8.285157 0 15-6.714843 15-15v-60.027343c0-8.285157-6.714843-15-15-15zm-15 60.027343h-27.429687c-8.285156 0-15 6.71875-15 15v27.433594h-30.03125v-27.433594c0-8.28125-6.714844-15-15-15h-27.433594v-30.027343h27.433594c8.285156 0 15-6.71875 15-15v-27.433594h30.03125v27.433594c0 8.28125 6.714844 15 15 15h27.429687zm0 0" />
                                </g>
                            </svg>
                            <h4><span>2. </span>Order Medicine</h4>
                        </div>
                        <!-- end:Step -->
                        <div class="step-item step3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewbox="0 0 612.001 612">
                                <path d="M604.131 440.17h-19.12V333.237c0-12.512-3.776-24.787-10.78-35.173l-47.92-70.975a62.99 62.99 0 0 0-52.169-27.698h-74.28c-8.734 0-15.737 7.082-15.737 15.738v225.043h-121.65c11.567 9.992 19.514 23.92 21.796 39.658H412.53c4.563-31.238 31.475-55.396 63.972-55.396 32.498 0 59.33 24.158 63.895 55.396h63.735c4.328 0 7.869-3.541 7.869-7.869V448.04c-.001-4.327-3.541-7.87-7.87-7.87zM525.76 312.227h-98.044a7.842 7.842 0 0 1-7.868-7.869v-54.372c0-4.328 3.541-7.869 7.868-7.869h59.724c2.597 0 4.957 1.259 6.452 3.305l38.32 54.451c3.619 5.194-.079 12.354-6.452 12.354zM476.502 440.17c-27.068 0-48.943 21.953-48.943 49.021 0 26.99 21.875 48.943 48.943 48.943 26.989 0 48.943-21.953 48.943-48.943 0-27.066-21.954-49.021-48.943-49.021zm0 73.495c-13.535 0-24.472-11.016-24.472-24.471 0-13.535 10.937-24.473 24.472-24.473 13.533 0 24.472 10.938 24.472 24.473 0 13.455-10.938 24.471-24.472 24.471zM68.434 440.17c-4.328 0-7.869 3.543-7.869 7.869v23.922c0 4.328 3.541 7.869 7.869 7.869h87.971c2.282-15.738 10.229-29.666 21.718-39.658H68.434v-.002zm151.864 0c-26.989 0-48.943 21.953-48.943 49.021 0 26.99 21.954 48.943 48.943 48.943 27.068 0 48.943-21.953 48.943-48.943.001-27.066-21.874-49.021-48.943-49.021zm0 73.495c-13.534 0-24.471-11.016-24.471-24.471 0-13.535 10.937-24.473 24.471-24.473s24.472 10.938 24.472 24.473c0 13.455-10.938 24.471-24.472 24.471zm117.716-363.06h-91.198c4.485 13.298 6.846 27.54 6.846 42.255 0 74.28-60.431 134.711-134.711 134.711-13.535 0-26.675-2.045-39.029-5.744v86.949c0 4.328 3.541 7.869 7.869 7.869h265.96c4.329 0 7.869-3.541 7.869-7.869V174.211c-.001-13.062-10.545-23.606-23.606-23.606zM118.969 73.866C53.264 73.866 0 127.129 0 192.834s53.264 118.969 118.969 118.969 118.97-53.264 118.97-118.969-53.265-118.968-118.97-118.968zm0 210.864c-50.752 0-91.896-41.143-91.896-91.896s41.144-91.896 91.896-91.896c50.753 0 91.896 41.144 91.896 91.896 0 50.753-41.143 91.896-91.896 91.896zm35.097-72.488c-1.014 0-2.052-.131-3.082-.407L112.641 201.5a11.808 11.808 0 0 1-8.729-11.396v-59.015c0-6.516 5.287-11.803 11.803-11.803 6.516 0 11.803 5.287 11.803 11.803v49.971l29.614 7.983c6.294 1.698 10.02 8.177 8.322 14.469-1.421 5.264-6.185 8.73-11.388 8.73z" fill="#FFF" />
                            </svg>
                            <h4><span>3. </span>Delivery or Pickup</h4>
                        </div>
                        <!-- end:Step -->
                    </div>
                    <br>
                    <!-- end:Steps -->
                    <div class="banner-form">
                        <form class="form-inline">
                            <button onclick="location.href='doctor_appoinment.php'" type="button" class="btn theme-btn btn-lg">Find Doctor</button>
                        </form>
                    </div>
                    <div class="steps">
                        <div class="step-item step1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 60.721 60.721" width="512" height="512">
                                <g fill="#FFF">
                                    <path d="m61 20h-13v-17c0-.553-.448-1-1-1h-30c-.552 0-1 .447-1 1v17h-13c-.552 0-1 .447-1 1v40c0 .553.448 1 1 1h58c.552 0 1-.447 1-1v-40c0-.553-.448-1-1-1zm-57 2h12v38h-12zm31 28v10h-6v-10zm11 10h-9v-10h2v-2h-14v2h2v10h-9v-56h28zm14 0h-12v-38h12z" />
                                    <path d="m51 32h6c.552 0 1-.447 1-1v-6c0-.553-.448-1-1-1h-6c-.552 0-1 .447-1 1v6c0 .553.448 1 1 1zm1-6h4v4h-4z" />
                                    <path d="m51 42h6c.552 0 1-.447 1-1v-6c0-.553-.448-1-1-1h-6c-.552 0-1 .447-1 1v6c0 .553.448 1 1 1zm1-6h4v4h-4z" />
                                    <path d="m51 52h6c.552 0 1-.447 1-1v-6c0-.553-.448-1-1-1h-6c-.552 0-1 .447-1 1v6c0 .553.448 1 1 1zm1-6h4v4h-4z" />
                                    <path d="m13 24h-6c-.552 0-1 .447-1 1v6c0 .553.448 1 1 1h6c.552 0 1-.447 1-1v-6c0-.553-.448-1-1-1zm-1 6h-4v-4h4z" />
                                    <path d="m21 28h4c.552 0 1-.447 1-1v-4c0-.553-.448-1-1-1h-4c-.552 0-1 .447-1 1v4c0 .553.448 1 1 1zm1-4h2v2h-2z" />
                                    <path d="m34 22h-4c-.552 0-1 .447-1 1v4c0 .553.448 1 1 1h4c.552 0 1-.447 1-1v-4c0-.553-.448-1-1-1zm-1 4h-2v-2h2z" />
                                    <path d="m38 23v4c0 .553.448 1 1 1h4c.552 0 1-.447 1-1v-4c0-.553-.448-1-1-1h-4c-.552 0-1 .447-1 1zm2 1h2v2h-2z" />
                                    <path d="m21 36h4c.552 0 1-.447 1-1v-4c0-.553-.448-1-1-1h-4c-.552 0-1 .447-1 1v4c0 .553.448 1 1 1zm1-4h2v2h-2z" />
                                    <path d="m34 30h-4c-.552 0-1 .447-1 1v4c0 .553.448 1 1 1h4c.552 0 1-.447 1-1v-4c0-.553-.448-1-1-1zm-1 4h-2v-2h2z" />
                                    <path d="m43 30h-4c-.552 0-1 .447-1 1v4c0 .553.448 1 1 1h4c.552 0 1-.447 1-1v-4c0-.553-.448-1-1-1zm-1 4h-2v-2h2z" />
                                    <path d="m21 44h4c.552 0 1-.447 1-1v-4c0-.553-.448-1-1-1h-4c-.552 0-1 .447-1 1v4c0 .553.448 1 1 1zm1-4h2v2h-2z" />
                                    <path d="m34 38h-4c-.552 0-1 .447-1 1v4c0 .553.448 1 1 1h4c.552 0 1-.447 1-1v-4c0-.553-.448-1-1-1zm-1 4h-2v-2h2z" />
                                    <path d="m43 38h-4c-.552 0-1 .447-1 1v4c0 .553.448 1 1 1h4c.552 0 1-.447 1-1v-4c0-.553-.448-1-1-1zm-1 4h-2v-2h2z" />
                                    <path d="m13 34h-6c-.552 0-1 .447-1 1v6c0 .553.448 1 1 1h6c.552 0 1-.447 1-1v-6c0-.553-.448-1-1-1zm-1 6h-4v-4h4z" />
                                    <path d="m13 44h-6c-.552 0-1 .447-1 1v6c0 .553.448 1 1 1h6c.552 0 1-.447 1-1v-6c0-.553-.448-1-1-1zm-1 6h-4v-4h4z" />
                                    <path d="m26 16h3v3c0 .553.448 1 1 1h4c.552 0 1-.447 1-1v-3h3c.552 0 1-.447 1-1v-4c0-.553-.448-1-1-1h-3v-3c0-.553-.448-1-1-1h-4c-.552 0-1 .447-1 1v3h-3c-.552 0-1 .447-1 1v4c0 .553.448 1 1 1zm1-4h3c.552 0 1-.447 1-1v-3h2v3c0 .553.448 1 1 1h3v2h-3c-.552 0-1 .447-1 1v3h-2v-3c0-.553-.448-1-1-1h-3z" />
                                    <path d="m42 56h2v2h-2z" />
                                    <path d="m42 52h2v2h-2z" />
                                    <path d="m42 48h2v2h-2z" />
                                </g>
                            </svg>
                            <h4><span>1. </span>Choose Department</h4>
                        </div>
                        <!-- end:Step -->
                        <div class="step-item step2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewbox="0 0 580.721 580.721">
                                <g fill="#FFF">
                                    <path d="M178.2,192h150a6,6,0,0,0,0-12h-150a6,6,0,0,0,0,12Z" />
                                    <path d="M117.614,184.889l-13.331,12.745-5.407-5.407a6,6,0,1,0-8.484,8.485l9.555,9.556a6,6,0,0,0,8.389.094l17.571-16.8a6,6,0,1,0-8.293-8.673Z" />
                                    <path d="M108.2,156.9a40.722,40.722,0,1,0,40.722,40.721A40.767,40.767,0,0,0,108.2,156.9Zm0,69.443a28.722,28.722,0,1,1,28.722-28.722A28.754,28.754,0,0,1,108.2,226.347Z" />
                                    <path d="M178.2,292h150a6,6,0,0,0,0-12h-150a6,6,0,0,0,0,12Z" />
                                    <path d="M117.614,284.889l-13.331,12.745-5.407-5.407a6,6,0,1,0-8.484,8.485l9.555,9.556a6,6,0,0,0,8.389.094l17.571-16.8a6,6,0,1,0-8.293-8.673Z" />
                                    <path d="M108.2,256.9a40.722,40.722,0,1,0,40.722,40.721A40.767,40.767,0,0,0,108.2,256.9Zm0,69.443a28.722,28.722,0,1,1,28.722-28.722A28.754,28.754,0,0,1,108.2,326.347Z" />
                                    <path d="M117.614,384.889l-13.331,12.745-5.407-5.407a6,6,0,1,0-8.484,8.485l9.555,9.556a6,6,0,0,0,8.389.094l17.571-16.8a6,6,0,1,0-8.293-8.673Z" />
                                    <path d="M108.2,356.9a40.722,40.722,0,1,0,40.722,40.721A40.767,40.767,0,0,0,108.2,356.9Zm0,69.443a28.722,28.722,0,1,1,28.722-28.722A28.754,28.754,0,0,1,108.2,426.347Z" />
                                    <path d="M178.2,212h80a6,6,0,0,0,0-12h-80a6,6,0,0,0,0,12Z" />
                                    <path d="M178.2,312h80a6,6,0,0,0,0-12h-80a6,6,0,0,0,0,12Z" />
                                    <path d="M59,94.1a6,6,0,0,0-6,6v6.3a6,6,0,0,0,12,0v-6.3A6,6,0,0,0,59,94.1Z" />
                                    <path d="M59,119.391a6,6,0,0,0-6,6v58a6,6,0,0,0,12,0v-58A6,6,0,0,0,59,119.391Z" />
                                    <path d="M457.271,267.7A31.02,31.02,0,0,0,433.8,272.18L372,312.766V87.625C372,67.775,355.687,52,335.836,52H298V33.375a6,6,0,0,0-12,0V52H235V33.375a6,6,0,0,0-12,0V52H173V33.375a6,6,0,0,0-12,0V52H110V33.375a6,6,0,0,0-12,0V52H65.836A35.582,35.582,0,0,0,30,87.625v361C30,468.476,45.985,485,65.836,485h270C355.687,485,372,468.476,372,448.625V387.46l96.086-63.1A31.217,31.217,0,0,0,457.271,267.7ZM291.661,89.574a10.61,10.61,0,1,1-10.61,10.61A10.621,10.621,0,0,1,291.661,89.574Zm-62.523,0a10.61,10.61,0,1,1-10.611,10.61A10.622,10.622,0,0,1,229.138,89.574Zm-62.525,0A10.61,10.61,0,1,1,156,100.184,10.622,10.622,0,0,1,166.613,89.574Zm-62.523,0a10.61,10.61,0,1,1-10.611,10.61A10.622,10.622,0,0,1,104.09,89.574ZM360,448.625A24.491,24.491,0,0,1,335.836,473h-270C52.6,473,42,461.859,42,448.625v-361A23.57,23.57,0,0,1,65.836,64H98V78.388c-9,2.636-16.565,11.406-16.565,21.8a22.605,22.605,0,1,0,45.21,0A22.185,22.185,0,0,0,110,78.388V64h51V78.388a22.324,22.324,0,0,0-16.8,21.8,22.634,22.634,0,0,0,45.268,0A23.2,23.2,0,0,0,173,78.388V64h50V78.388c-9,2.636-16.541,11.406-16.541,21.8a22.6,22.6,0,1,0,45.2,0A22.2,22.2,0,0,0,235,78.388V64h51V78.388a22.3,22.3,0,0,0-16.779,21.8,22.631,22.631,0,0,0,45.262,0c0-10.39-7.483-19.16-16.483-21.8V64h37.836C349.069,64,360,74.392,360,87.625V320.646l-22.537,14.8a6,6,0,0,0-1.439,8.7h0a6,6,0,0,0,8.026,1.327l89.218-58.589,7.257,11.046L289.368,397.2l-7.259-11.047,28.4-18.647a6,6,0,0,0-6.587-10.031L270.533,379.4c-.061.041-.117.092-.179.135-.152.108-.3.216-.446.338-.048.04-.09.086-.135.128H178.2a6,6,0,0,0,0,12h84.81l-4.249,8.028c-.185-.017-.371-.028-.561-.028h-80a6,6,0,0,0,0,12h74.225l-6.937,13.105a6,6,0,0,0,5.3,8.807c.053,0,.106,0,.158,0l50.707-1.329c.123,0,.244-.024.366-.034s.261-.017.391-.037c.159-.024.313-.065.467-.1.114-.027.229-.046.343-.08a5.949,5.949,0,0,0,.767-.289c.061-.027.118-.065.178-.1a6,6,0,0,0,.566-.314c.02-.013.041-.02.059-.033L360,395.341Zm-69.439-27.757-29.667.777,13.462-25.438Zm12.655-2.593-.461-.7-6.8-10.344,151.157-99.265,7.258,11.045Zm161.013-106.12-20.756-31.589a19.363,19.363,0,0,1,16.073.484,17.179,17.179,0,0,1,3.973,2.649A19.275,19.275,0,0,1,464.229,312.155Z" />
                                </g>
                            </svg>
                            <h4><span>2. </span>Set Appointment</h4>
                        </div>
                        <!-- end:Step -->
                        <div class="step-item step3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewbox="0 0 64.001 64">
                                <g fill="#FFF">
                                    <path d="m21 53h2v2h-2z" />
                                    <path d="m21 57h2v2h-2z" />
                                    <path d="m44.043 33c.906 0 1.759-.399 2.338-1.095l4.088-4.905h7.531c2.757 0 5-2.243 5-5v-10c0-2.757-2.243-5-5-5h-5c0-3.309-2.691-6-6-6s-6 2.691-6 6h-5c-2.757 0-5 2.243-5 5v5.521c-1.903-1.574-4.343-2.521-7-2.521h-1c-3.316 0-6.49 1.525-8.566 4.099-3.165.764-5.434 3.622-5.434 6.901 0 3.452 1.48 6.688 4.054 8.969.335 3.11 2.262 5.742 4.946 7.081v2.158l-6.978 1.642c-5.901 1.388-10.022 6.592-10.022 12.654v4.496h42v-4.496c0-1.959-.436-3.825-1.217-5.504h3.748l4.088 4.904c.579.697 1.432 1.096 2.338 1.096 1.678 0 3.043-1.365 3.043-3.043v-2.957h3c2.757 0 5-2.243 5-5v-8c0-2.757-2.243-5-5-5h-20c-2.757 0-5 2.243-5 5v5.856c-.008-.002-.015-.005-.022-.006l-6.978-1.642v-2.158c2.684-1.339 4.611-3.972 4.946-7.081 2.323-2.059 3.744-4.896 3.999-7.969h6.055v2.957c0 1.678 1.365 3.043 3.043 3.043zm2.957-30c2.206 0 4 1.794 4 4s-1.794 4-4 4-4-1.794-4-4 1.794-4 4-4zm-28.407 43.123 2.157 2.877-2.329 3.105-2.014-5.468zm3.407 4.543 2.756 3.674-2.453 6.66h-.605l-2.453-6.66zm-19 7.838c0-5.13 3.487-9.533 8.481-10.708l2.963-.697 5.122 13.901h-8.566v-6h-2v6h-6zm32-18.504c0-1.654 1.346-3 3-3h20c1.654 0 3 1.346 3 3v8c0 1.654-1.346 3-3 3h-5v4.957c0 .575-.468 1.043-1.043 1.043-.311 0-.603-.137-.801-.375l-4.687-5.625h-5.849c-1.389-1.968-3.318-3.542-5.62-4.495zm6 18.504v2.496h-6v-6h-2v6h-8.566l5.121-13.901 2.963.697c4.995 1.176 8.482 5.579 8.482 10.708zm-13.406-11.866-2.014 5.468-2.33-3.106 2.157-2.877zm-3.594-1.971-2 2.667-2-2.667v-1.899c.644.147 1.312.232 2 .232s1.356-.085 2-.232zm5-10.667c0 3.86-3.141 7-7 7s-7-3.14-7-7v-4.697c0-.719.584-1.303 1.303-1.303.258 0 .508.076.723.219l2.671 1.781h6.303c1.654 0 3 1.346 3 3zm1.911-1.884c-.421-2.335-2.457-4.116-4.911-4.116h-5.697l-2.168-1.445c-.544-.363-1.178-.555-1.832-.555-1.822 0-3.303 1.481-3.303 3.303v2.684c-1.284-1.712-2-3.798-2-5.987 0-2.422 1.724-4.525 4.1-5l.472-.095.228-.305c1.691-2.254 4.383-3.6 7.2-3.6h1c4.963 0 9 4.038 9 9 0 2.243-.745 4.381-2.089 6.116zm4.038-7.116c-.178-1.962-.874-3.775-1.949-5.305v-7.695c0-1.654 1.346-3 3-3h5.35c.384 1.082 1.067 2.02 1.954 2.717-3.688 1.473-6.304 5.075-6.304 9.283v2h20v-2c0-4.208-2.616-7.81-6.304-9.283.887-.697 1.57-1.635 1.954-2.717h5.35c1.654 0 3 1.346 3 3v10c0 1.654-1.346 3-3 3h-8.469l-4.688 5.625c-.197.238-.489.375-.8.375-.575 0-1.043-.468-1.043-1.043v-4.957zm12.051-12c4.411 0 8 3.589 8 8h-16c0-4.411 3.589-8 8-8z" />
                                    <path d="m37 39h22v2h-22z" />
                                    <path d="m37 43h22v2h-22z" />
                                    <path d="m41 47h14v2h-14z" />
                                    <path d="m57 47h2v2h-2z" />
                                </g>
                            </svg>
                            <h4><span>3. </span>Consultation</h4>
                        </div>
                        <!-- end:Step -->
                    </div>
                    <!-- end:Steps -->
                </div>
            </div>
            <!--end:Hero inner -->
        </section>
        <!-- banner part ends -->



        <!-- Popular block starts -->
        <section class="popular">
            <div class="container">
                <div class="title text-xs-center m-b-30">
                    <h2>Medicine</h2>
                    <p class="lead">The easiest way to find your medicine</p>
                </div>
                <div class="row">



                    <?php
                    // fetch records from database to display popular first 3 dishes from table

                    // $result = mysqli_query($connection,$sql);

                    while ($r = mysqli_fetch_array($query_res)) {

                        echo '  <div class="col-xs-12 col-sm-6 col-md-4 food-item">
                                                        <div class="food-item-wrap">
                                                        
                                                           <div class="figure-wrap bg-image zoom" href="dishes.php?res_id=' . $r['rs_id'] . '" data-image-src="admin/Res_img/dishes/' . $r['img'] . '">
                                                           
												
															</div>
															<div class="content">
																<h5><a href="dishes.php?res_id=' . $r['rs_id'] . '">' . $r['title'] . '</a></h5>
																<div class="product-name">' . $r['slogan'] . '</div>
																<div class="price-btn-block"> <span class="price">TK' . $r['price'] . '</span> <a href="dishes.php?res_id=' . $r['rs_id'] . '" class="btn theme-btn-dash pull-right">Order Now</a> </div>
															</div>
															
														</div>
												</div>';
                    }


                    ?>

                </div>
            </div>
        </section>
        <!-- Popular block ends -->
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
        <!-- How it works block ends -->
        <!-- Featured restaurants starts -->
        <section class="featured-restaurants">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="title-block pull-left">
                            <h4>Medicine Shop</h4>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="restaurants-filter pull-right">
                            <nav class="primary pull-left">
                                <ul>
                                    <?php
                                    $res = mysqli_query($db, "select * from res_category");
                                    while ($row = mysqli_fetch_array($res)) {
                                        echo '<li><a href="#" data-filter=".' . $row['c_name'] . '"> ' . $row['c_name'] . '</a> </li>';
                                    }
                                    ?>

                                </ul>
                            </nav>
                        </div>
                        <!-- restaurants filter nav ends -->
                    </div>
                </div>
                <!-- restaurants listing starts -->
                <div class="row">
                    <div class="restaurant-listing">


                        <?php  //fetching records from table and filter using html data-filter tag
                        $ress = mysqli_query($db, "select * from restaurant");
                        while ($rows = mysqli_fetch_array($ress)) {
                            // fetch records from res_category table according to catgory ID
                            $query = mysqli_query($db, "select * from res_category where c_id='" . $rows['c_id'] . "' ");
                            $rowss = mysqli_fetch_array($query);

                            echo ' <div class="col-xs-12 col-sm-12 col-md-6 single-restaurant all ' . $rowss['c_name'] . '">
														<div class="restaurant-wrap">
															<div class="row">
																<div class="col-xs-12 col-sm-3 col-md-12 col-lg-3 text-xs-center">
																	<a class="restaurant-logo" href="dishes.php?res_id=' . $rows['rs_id'] . '" > <img src="admin/Res_img/' . $rows['image'] . '" alt="Restaurant logo"> </a>
																</div>
																<!--end:col -->
																<div class="col-xs-12 col-sm-9 col-md-12 col-lg-9">
																	<h5><a href="dishes.php?res_id=' . $rows['rs_id'] . '" >' . $rows['title'] . '</a></h5> <span>' . $rows['address'] . '</span>
																	
																</div>
																<!-- end:col -->
															</div>
															<!-- end:row -->
														</div>
														<!--end:Restaurant wrap -->
													</div>';
                        }


                        ?>




                    </div>
                </div>
                <!-- restaurants listing ends -->

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