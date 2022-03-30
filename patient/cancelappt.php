<?php
//inputting positive result
include_once '../assets/conn/dbconnect.php';
// Get the variables.
$userid = $_GET['username'];

$update = mysqli_query($con,"DELETE FROM bookings WHERE id='$userid'");
header("Location: patientapplist.php");



?>