<?php
include_once '../assets/conn/dbconnect.php';
// Get the variables.
$userid = $_GET['userid'];
$chkYesNo = $_GET['chkYesNo'];

$update = mysqli_query($con,"UPDATE bookings SET status='sample collected' WHERE id=$userid");
$update = mysqli_query($con,"UPDATE bookings SET result='processing' WHERE id=$userid");

?>