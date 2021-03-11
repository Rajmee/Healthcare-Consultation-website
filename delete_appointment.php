<?php
include("connection/connect.php"); //connection to db
error_reporting(0);
session_start();


// sending query
mysqli_query($db,"DELETE FROM appointment_list WHERE id = '".$_GET['appointment_del']."'"); // deletig records on the bases of ID
header("location:view_schedule.php");  //once deleted success redireted back to current page
