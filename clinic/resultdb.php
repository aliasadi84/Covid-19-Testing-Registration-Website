<?php
//inputting positive result
include_once '../assets/conn/dbconnect.php';
// Get the variables.
$userid = $_GET['userid'];
$chkYesNo = $_GET['chkYesNo'];

$update = mysqli_query($con,"UPDATE bookings SET result='Positive' WHERE id=$userid");
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
$subject = "WCHC Result have been entered";
$body ="Hello " .$userDow['patientFirstName']. ",\n\nThank you for testing with Wayne County Healthy Communities! Your result for Covid-19 for your appointment at $dateofappointment during $timeslot.\n\nPlease log in to WCHC Covid-19 Portal to view result!";
$header = "From: from@email";
mail($to, $subject, $body, $header)

?>
