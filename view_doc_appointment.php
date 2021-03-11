<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();

if (empty($_SESSION['doctor_id']))  //if usser is not login redirected baack to login page
{
  header('location:doctor_login.php');
} else {
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
    <style type="text/css" rel="stylesheet">
      .indent-small {
        margin-left: 5px;
      }

      .form-group.internal {
        margin-bottom: 0;
      }

      .dialog-panel {
        margin: 10px;
      }

      .datepicker-dropdown {
        z-index: 200 !important;
      }

      .panel-body {
        background: #e5e5e5;
        /* Old browsers */
        background: -moz-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
        /* FF3.6+ */
        background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, #e5e5e5), color-stop(100%, #ffffff));
        /* Chrome,Safari4+ */
        background: -webkit-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
        /* Chrome10+,Safari5.1+ */
        background: -o-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
        /* Opera 12+ */
        background: -ms-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
        /* IE10+ */
        background: radial-gradient(ellipse at center, #e5e5e5 0%, #ffffff 100%);
        /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#e5e5e5', endColorstr='#ffffff', GradientType=1);
        /* IE6-9 fallback on horizontal gradient */
        font: 600 15px "Open Sans", Arial, sans-serif;
      }

      label.control-label {
        font-weight: 600;
        color: #777;
      }


      table {
        width: 750px;
        border-collapse: collapse;
        margin: auto;

      }

      /* Zebra striping */
      tr:nth-of-type(odd) {
        background: #eee;
      }

      th {
        background: #ff3300;
        color: white;
        font-weight: bold;

      }

      td,
      th {
        padding: 10px;
        border: 1px solid #ccc;
        text-align: left;
        font-size: 14px;

      }

      /* 
Max width before this PARTICULAR table gets nasty
This query will take effect for any screen smaller than 760px
and also iPads specifically.
*/
      @media only screen and (max-width: 760px),
      (min-device-width: 768px) and (max-device-width: 1024px) {

        table {
          width: 100%;
        }

        /* Force table to not be like tables anymore */
        table,
        thead,
        tbody,
        th,
        td,
        tr {
          display: block;
        }

        /* Hide table headers (but not display: none;, for accessibility) */
        thead tr {
          position: absolute;
          top: -9999px;
          left: -9999px;
        }

        tr {
          border: 1px solid #ccc;
        }

        td {
          /* Behave  like a "row" */
          border: none;
          border-bottom: 1px solid #eee;
          position: relative;
          padding-left: 50%;
        }

        td:before {
          /* Now like a table header */
          position: absolute;
          /* Top/left values mimic padding */
          top: 6px;
          left: 6px;
          width: 45%;
          padding-right: 10px;
          white-space: nowrap;
          /* Label the data */
          content: attr(data-column);

          color: #000;
          font-weight: bold;
        }

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
            <a class="navbar-brand" href="index.html"> <img class="img-rounded" src="images/doc-logo.png" alt=""> </a>
            <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
              <ul class="nav navbar-nav">


                <?php
                if (empty($_SESSION["doctor_id"])) {
                  echo '<li class="nav-item"><a href="doctor_login.php" class="nav-link active">login</a> </li>';
                } else {
                  echo  '<li class="nav-item"><a href="doctor_logout.php" class="nav-link active">logout</a> </li>';
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

        <!-- end:Top links -->
        <!-- start: Inner page hero -->
        <div class="inner-page-hero bg-image" data-image-src="images/img/res.jpeg">
          <div class="container"> </div>
          <!-- end:Container -->
        </div>
        <div class="result-show">
          <div class="container">
            <div class="row">


            </div>
          </div>
        </div>
        <!-- //results show -->
        <section class="restaurants-page">
          <div class="container">
            <div class="row">

              <div class="col-xs-12 col-sm-7 col-md-7 ">
                <div class="bg-gray restaurant-entry">
                  <div class="row">

                    <table>
                      <thead>
                        <tr>

                          <th>Patient Name</th>
                          <th>Phone number</th>
                          <th>status</th>
                          <th>Appointment Date</th>
                          <th>Action</th>

                        </tr>
                      </thead>
                      <tbody>


                        <?php
                        // displaying current session user login orders 
                        $query_res = mysqli_query($db, "select * from appointment_list where doc_id='" . $_SESSION['doctor_id'] . "'");

                        if (!mysqli_num_rows($query_res) > 0) {
                          echo '<td colspan="6"><center>You have No appointment Placed yet. </center></td>';
                        } else {

                          while ($row = mysqli_fetch_array($query_res)) {
                            $query_res_doc = mysqli_query($db, "select * from users where u_id='" . $row['patient_id'] . "'");
                            $roww = mysqli_fetch_array($query_res_doc);

                        ?>
                            <tr>
                              <td data-column="Item"> <?php echo $roww['username']; ?></td>

                              <td data-column="Item"> <?php echo $roww['phone']; ?></td>
                              <td data-column="status">
                                <?php
                                $status = $row['status'];
                                if ($status == "" or $status == "NULL") {
                                ?>
                                  <button type="button" class="btn btn-info" style="font-weight:bold;">Requesting !</button>
                                <?php
                                }
                                if ($status == "scheduling") { ?>
                                  <button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin" aria-hidden="true"></span> Scheduling!</button>
                                <?php
                                }
                                if ($status == "scheduled") {
                                ?>
                                  <button type="button" class="btn btn-success"><span class="fa fa-check-circle" aria-hidden="true"> Scheduled</button>
                                <?php
                                }
                                ?>
                                <?php
                                if ($status == "rejected") {
                                ?>
                                  <button type="button" class="btn btn-danger"> <i class="fa fa-close"></i> Cancelled</button>
                                <?php
                                }
                                ?>
                              </td>
                              <td data-column="Date"> <?php echo $row['schedule']; ?></td>
                              <td data-column="Action">
                                <a href="patient_info.php?appoint_upd=<?php echo $row['id']; ?>" class="btn btn-success btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-calendar" style="font-size:16px"></i></a>
                              </td>

                            </tr>


                        <?php }
                        } ?>




                      </tbody>
                    </table>



                  </div>
                  <!--end:row -->
                </div>



              </div>



            </div>
          </div>
      </div>
      </section>

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
  </body>

</html>
<?php
}
?>