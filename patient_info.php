<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();

if (isset($_POST['submit']))           //if upload btn is pressed
{


  $fname = $_FILES['file']['name'];
  $temp = $_FILES['file']['tmp_name'];
  $fsize = $_FILES['file']['size'];
  $extension = explode('.', $fname);
  $extension = strtolower(end($extension));
  $fnew = uniqid() . '.' . $extension;

  $store = "admin/Res_img/pres/" . basename($fnew);                      // the path to store the upload image

  if ($extension == 'jpg' || $extension == 'png' || $extension == 'gif' || $extension == 'pdf' || $extension == 'doc') {
    if ($fsize >= 1000000) {


      $error =     '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>Max Image Size is 1024kb!</strong> Try different Image.
															</div>';
    } else {




      $sql = "update appointment_remark set img='$fnew' where frm_id='" . $_GET['appoint_upd'] . "'";  // store the submited data ino the database :images
      mysqli_query($db, $sql);
      move_uploaded_file($temp, $store);

      $success =     '<div class="alert alert-success alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>Congrass!</strong> Please Uploaded Successfully.
                              </div>';
      echo "<script>alert('Prescription uploaded successfully');</script>";
    }
  } elseif ($extension == '') {
    $error =     '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>select file</strong>
															</div>';
  } else {

    $error =     '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>invalid extension!</strong>png, jpg, Gif are accepted.
															</div>';
  }
}


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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:** -->
  <!--[if lt IE 9]>
    <script src="https:**oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https:**oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
  <script language="javascript" type="text/javascript">
    var popUpWin = 0;

    function popUpWindow(URLStr, left, top, width, height) {
      if (popUpWin) {
        if (!popUpWin.closed) popUpWin.close();
      }
      popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width=' + 800 + ',height=' + 600 + ',left=' + left + ', top=' + top + ',screenX=' + left + ',screenY=' + top + '');
    }
  </script>
</head>

<body class="fix-header fix-sidebar">
  <!-- Preloader - style you can find in spinners.css -->
  <div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
      <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
    </svg>
  </div>
  <!-- Main wrapper  -->
  <div id="main-wrapper">
    <!-- header header  -->
    <div class="header">

    </div>
    <div class="page-wrapper">
      <!-- Bread crumb -->
      <div class="row page-titles">
        <div class="col-md-5 align-self-center">
          <h3 class="text-primary">Dashboard</h3>
        </div>

      </div>
      <!-- End Bread crumb -->
      <!-- Container fluid  -->
      <div class="container-fluid">
        <!-- Start Page Content -->
        <div class="row">
          <div class="col-12">

            <form action='' method='post' enctype="multipart/form-data">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">View Patient Info</h4>

                  <div class="table-responsive m-t-20">
                    <table id="myTable" class="table table-bordered table-striped">

                      <tbody>
                        <?php
                        $sql = "SELECT users.*, appointment_list.* FROM users INNER JOIN appointment_list ON users.u_id=appointment_list.patient_id where id='" . $_GET['appoint_upd'] . "'";
                        $query = mysqli_query($db, $sql);
                        $rows = mysqli_fetch_array($query);



                        ?>

                        <tr>
                          <td><strong>username:</strong></td>
                          <td>
                            <center><?php echo $rows['username']; ?></center>
                          </td>
                          <td>
                            <center>
                              <div class="col-md-8">
                                <div class="form-group has-danger">
                                  <label class="control-label">Please upload the Prescription here...</label>
                                  <input type="file" name="file" id="lastName" class="form-control form-control-danger" placeholder="12n">
                                  <br>
                                  <input type="submit" name="submit" class="btn btn-success" value="Upload">
                                </div>
                              </div>
                            </center>
                          </td>


                        </tr>
                        <tr>
                          <td><strong>Doctor Name:</strong></td>
                          <td>
                            <center><?php echo $rows['doc_name']; ?></center>
                          </td>
                          <td>
                            <center>
                              <a href="javascript:void(0);" onClick="popUpWindow('prescription_data.php?newform_id=<?php echo htmlentities($rows['id']); ?>');" title="Update remark">
                                <button type="button" class="btn btn-primary">View Patient Detials</button></a>

                            </center>
                          </td>

                        </tr>
                        <tr>
                          <td><strong>Phone:</strong></td>
                          <td>
                            <center><?php echo $rows['phone']; ?></center>
                          </td>
                          <td>
                            <center>
                              <a href="view_doc_appointment.php" title="home">
                                <button type="button" class="btn btn-primary">Home</button></a>

                            </center>
                          </td>


                        </tr>
                        <tr>
                          <td><strong>Address:</strong></td>
                          <td>
                            <center><?php echo $rows['address']; ?></center>
                          </td>


                        </tr>
                        <tr>
                          <td><strong>Appointment Date:</strong></td>
                          <td>
                            <center><?php echo $rows['schedule']; ?></center>
                          </td>


                        </tr>
                        <tr>
                          <td><strong>status:</strong></td>
                          <?php
                          $status = $rows['status'];
                          if ($status == "" or $status == "NULL") {
                          ?>
                            <td>
                              <center><button type="button" class="btn btn-info" style="font-weight:bold;"><span class="fa fa-bars" aria-hidden="true"> Requesting !</button></center>
                            </td>
                          <?php
                          }
                          if ($status == "scheduling") { ?>
                            <td>
                              <center><button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin" aria-hidden="true"></span> Scheduling !</button></center>
                            </td>
                          <?php
                          }
                          if ($status == "scheduled") {
                          ?>
                            <td>
                              <center><button type="button" class="btn btn-success"><span class="fa fa-check-circle" aria-hidden="true">Scheduled</button></center>
                            </td>
                          <?php
                          }
                          ?>
                          <?php
                          if ($status == "rejected") {
                          ?>
                            <td>
                              <center><button type="button" class="btn btn-danger"> <i class="fa fa-close"></i>cancelled</button> </center>
                            </td>
                          <?php
                          }
                          ?>


                        </tr>







                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- End PAge Content -->
  </div>
  <!-- End Container fluid  -->




  <!-- footer -->
  <footer class="footer"> © 2018 All rights reserved. Template designed by <a href="https://colorlib.com">Colorlib</a></footer>
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


  <script src="admin/js/lib/datatables/datatables.min.js"></script>
  <script src="admin/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
  <script src="admin/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
  <script src="admin/js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
  <script src="admin/js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
  <script src="admin/js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
  <script src="admin/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
  <script src="admin/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
  <script src="admin/js/lib/datatables/datatables-init.js"></script>
  <script src="js/dropdown.js"></script>
</body>

</html>