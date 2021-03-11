<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();

?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
  <title>Ela - Bootstrap Admin Dashboard Template</title>
  <!-- Bootstrap Core CSS -->
  <link href="admin/css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="admin/css/helper.css" rel="stylesheet">
  <link href="admin/css/style.css" rel="stylesheet">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:** -->
  <!--[if lt IE 9]>
    <script src="https:**oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https:**oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header">
  <!-- Preloader - style you can find in spinners.css -->
  <div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
      <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
    </svg>
  </div>
  <!-- Main wrapper  -->
  <div id="main-wrapper">
    <!-- header header  -->

    <!-- Left Sidebar  -->

    <!-- Page wrapper  -->
    <div class="page-wrapper" style="height:1200px;">
      <!-- Bread crumb -->

      <!-- End Bread crumb -->
      <!-- Container fluid  -->
      <div class="container-fluid">
        <!-- Start Page Content -->


        <?php echo $error;
        echo $success; ?>




        <div class="col-lg-12">
          <div class="card card-outline-primary">
            <div class="card-header">
              <h4 class="m-b-0 text-white">Doctor schedule</h4>
            </div>
            <div class="card-body">
              <form action='' method='post' enctype="multipart/form-data">
                <div class="form-body">
                  <?php
                  $qml = "select * from doctors_schedule where doc_id='$_GET[doc_sch]'";
                  $rest = mysqli_query($db, $qml);

                  ?>

                  <hr>

                  <div class="container-fluid">
                    <div class="col-lg-12">
                      <div class="row">
                        <table class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th class="text-center">Day</th>
                              <th class="text-center">Schedule</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php while ($roww = $rest->fetch_assoc()) : ?>
                              <tr>
                                <th class="text-center" placeholder="day"><?php echo $roww['day'] ?></th>
                                <th class="text-center" placeholder="time"><?php echo date("h:i A", strtotime($roww['time_from'])) . ' - ' . date("h:i A", strtotime($roww['time_to'])) ?></th>
                              </tr>
                            <?php endwhile; ?>
                          </tbody>
                        </table>
                      </div>
                      <hr>

                    </div>
                  </div>


                </div>
            </div>

            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- End PAge Content -->
  </div>

  </div>
  <!-- End PAge Content -->
  </div>
  <!-- End Container fluid  -->
  <!-- footer -->

  <!-- End footer -->
  </div>
  <!-- End Page wrapper  -->
  </div>
  <!-- End Wrapper -->


  <!-- All Jquery -->
  <script src="admin/js/lib/jquery/jquery.min.js"></script>
  <!-- Bootstrap tether Core JavaScript -->
  <script src="admin/js/lib/bootstrap/js/popper.min.js"></script>
  <script src="admin/js/lib/bootstrap/js/bootstrap.min.js"></script>
  <!-- slimscrollbar scrollbar JavaScript -->
  <script src="admin/js/jquery.slimscroll.js"></script>
  <!--Menu sidebar -->
  <script src="admin/js/sidebarmenu.js"></script>
  <!--stickey kit -->
  <script src="admin/js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
  <!--Custom JavaScript -->
  <script src="admin/js/custom.min.js"></script>




</body>


</html>