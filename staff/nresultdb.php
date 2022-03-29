<?php
include_once '../assets/conn/dbconnect.php';
// Get the variables.
//enters all negetive result into database
$userid = $_GET['userid'];
$chkYesNo = $_GET['chkYesNo'];

$update = mysqli_query($con,"UPDATE bookings SET result='negetive' WHERE id=$userid");
$update = mysqli_query($con,"UPDATE bookings SET status='result entered' WHERE id=$userid");

?>