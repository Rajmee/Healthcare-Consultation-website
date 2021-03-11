<?php

include("connection/connect.php");
error_reporting(0);
session_start();
// if (strlen($_SESSION['user_id']) == 0) {
//   header('location:login.php');
// } else {
if (isset($_POST['update'])) {
  $form_id = $_GET['form_id'];
  $status = $_POST['status'];
  $remark = $_POST['remark'];
  $query = mysqli_query($db, "insert into appointment_remark(frm_id,status,remark) values('$form_id','$status','$remark')");
  $sql = mysqli_query($db, "update appointment_list set status='$status' where o_id='$form_id'");

  echo "<script>alert('form details updated successfully');</script>";
}

if (isset($_POST["Submit2"])) {
  // Get parameters
  // $file = urldecode($_REQUEST["file"]); // Decode URL-encoded string

  // $prescr = mysqli_query($db, "select * FROM appointment_remark where frm_id='" . $_GET['newform_id'] . "'");
  $prescr = mysqli_query($db, "select * FROM appointment_remark where frm_id='" . $_GET['newform_id'] . "'");
  $pr = mysqli_fetch_array($prescr);
  $imgname = $pr['img'];

  if (preg_match('/^[^.][-a-z0-9_.]+[a-z]$/i', $imgname)) {

  $filepath = "admin/Res_img/pres/" . $imgname;

  // Process download
      if (file_exists($filepath)) 
      {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        flush(); // Flush system output buffer
        readfile($filepath);
        die();
      } 
      else 
      {
        http_response_code(404);
        die();
      }
  }
  else 
  {
      die("Prescription has not yet been uploaded!!!");
  }
}

?>
<script language="javascript" type="text/javascript">
  function f2() {
    window.close();
  }
  ser

  function f3() {
    window.print();
  }
</script>

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
      width: 650px;
      border-collapse: collapse;
      margin: auto;
      margin-top: 50px;
    }

    /* Zebra striping */
    tr:nth-of-type(odd) {
      background: #eee;
    }

    th {
      background: #004684;
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
  </style>
</head>

<body>

  <div style="margin-left:50px;">
    <form name="updateticket" id="updatecomplaint" method="post">




      <table border="0" cellspacing="0" cellpadding="0">

        <?php

        $ret1 = mysqli_query($db, "select * FROM appointment_list where id='" . $_GET['newform_id'] . "'");
        $ro = mysqli_fetch_array($ret1);
        $prescr = mysqli_query($db, "select * FROM appointment_remark where frm_id='" . $_GET['newform_id'] . "'");
        $pr = mysqli_fetch_array($prescr);
        $ret2 = mysqli_query($db, "select * FROM users where u_id='" . $ro['patient_id'] . "'");

        $sql = "SELECT * FROM appointment_remark WHERE frm_id='" . $_GET['newform_id'] . "'";
        $queryImg = mysqli_query($db, $sql);
        while ($rows = mysqli_fetch_array($queryImg)); {
          $imgname = $rows['img'];
        }

        while ($row = mysqli_fetch_array($ret2)) {
        ?>
          <tr>
            <td colspan="2"><b><?php echo $row['f_name']; ?>'s profile</b></td>

          </tr>


          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr height="50">
            <td><b>Appointment Date:</b></td>
            <td><?php echo htmlentities($ro['schedule']); ?></td>
          </tr>

          <tr height="50">
            <td><b>First name:</b></td>
            <td><?php echo htmlentities($row['f_name']); ?></td>
          </tr>
          <tr height="50">
            <td><b>Last name:</b></td>
            <td><?php echo htmlentities($row['l_name']); ?></td>
          </tr>



          <tr height="50">
            <td><b>Patient email:</b></td>
            <td><?php echo htmlentities($row['email']); ?></td>
          </tr>


          <tr height="50">
            <td><b>Patient phone:</b></td>
            <td><?php echo htmlentities($row['phone']); ?></td>
          </tr>
          <tr height="50">
            <td><b>Doctor Name:</b></td>
            <td><?php echo htmlentities($ro['doc_name']); ?></td>
          </tr>
          <tr height="150">
            <td><b>Notepad:</b></td>
            <td><?php echo htmlentities($pr['remark']); ?></td>
          </tr>

          <tr height="150">
            <td><b>Prescription:</b></td>
            <td colspan="2">
              <input name="Submit2" type="submit" class="btn btn-success" value="Download" onClick="" style="cursor: pointer;" />
            </td>

          </tr>


          <tr height="50">
            <td><b>Status:</b></td>
            <td><?php if ($row['status'] == 1) {
                  echo "<div class='btn btn-success'>Active</div>";
                } else {
                  echo "<div class='btn btn-danger'>Block</div>";
                }
                ?></td>
          </tr>

          <tr>

            <td colspan="2">
              <input name="submit" type="submit" class="btn btn-danger" value="Close this window " onClick="return f2();" style="cursor: pointer;" />
            </td>
          </tr>

        <?php }


        ?>


      </table>
    </form>
  </div>

</body>

</html>


<?php  ?>