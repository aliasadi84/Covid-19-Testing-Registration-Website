<?php
//inputting positive result
include_once '../assets/conn/dbconnect.php';
// Get the variables.
$userid = $_GET['userid'];
$chkYesNo = $_GET['chkYesNo'];

$update = mysqli_query($con,"UPDATE bookings SET result='positive' WHERE id=$userid");
$update = mysqli_query($con,"UPDATE bookings SET status='result entered' WHERE id=$userid");

?>