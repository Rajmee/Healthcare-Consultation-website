<?php
include("../connection/connect.php");
error_reporting(0);
session_start();


// sending query
mysqli_query($db,"DELETE FROM dep_cat WHERE dep_id = '".$_GET['dep_del']."'");
header("location:alldepertment.php");  

?>
