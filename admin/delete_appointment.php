<?php
include("../connection/connect.php");
error_reporting(0);
session_start();


// sending query
mysqli_query($db,"DELETE FROM appointment_list WHERE id = '".$_GET['appointment_del']."'");
header("location:all_appointment.php");
