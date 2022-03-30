<?php
include_once '../assets/conn/dbconnect.php';
//inputting negetive result
// Get the variables.
$userid = $_GET['userid'];
$chkYesNo = $_GET['chkYesNo'];

$update = mysqli_query($con,"UPDATE bookings SET result='negetive' WHERE id=$userid");
$update = mysqli_query($con,"UPDATE bookings SET status='result entered' WHERE id=$userid");

$res=mysqli_query($con,"SELECT * FROM bookings WHERE id=$userid");
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);
$userdetail=$userRow['username'];
$res=mysqli_query($con,"SELECT * FROM patient WHERE icPatient='$userdetail'");
$userDow=mysqli_fetch_array($res,MYSQLI_ASSOC);

$dateofappointment = $userRow['date'];
$dateofappointment = date('m/d/Y',strtotime($dateofappointment));
$timeslot = $userRow['timeslot'];



$to = $userDow['patientEmail'];
$subject = "COVID Test Results Available";
$body ="Hello " .$userDow['patientFirstName']. ",\n\nThank you for testing with Wayne County Healthy Communities! The results of your COVID test on " . date('m/d/Y', strtotime($dateofappointment)) . " are now available.\n\nPlease log in to WCHC COVID-19 Portal to view results.";
$header = "From: from@email";
mail($to, $subject, $body, $header)
?>
