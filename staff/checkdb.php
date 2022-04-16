<?php
include_once '../assets/conn/dbconnect.php';
// Get the variables appointment id.
$userid = $_GET['userid'];
$chkYesNo = $_GET['chkYesNo'];
//updates the status and result field in the database according to checkbox selected in doctor dashboard.
$update = mysqli_query($con,"UPDATE bookings SET status='sample collected' WHERE id=$userid");
$update = mysqli_query($con,"UPDATE bookings SET result='processing' WHERE id=$userid");

?>