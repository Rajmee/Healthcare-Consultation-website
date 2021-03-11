<?php
include("../connection/connect.php");
error_reporting(0);
session_start();


// sending query
mysqli_query($db,"DELETE FROM doclist WHERE doc_id = '".$_GET['doc_del']."'");
header("location:all_doctors.php");
