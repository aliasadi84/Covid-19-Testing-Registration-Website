<?php
include_once '../assets/conn/dbconnect.php';
//inputting positive result
//Get the variables username and checked.
$userid = $_GET['userid'];
$chkYesNo = $_GET['chkYesNo'];

//updates ther result as 'positive' and the result status as 'result entered'
$update = mysqli_query($con,"UPDATE bookings SET result='Positive' WHERE id=$userid");
$update = mysqli_query($con,"UPDATE bookings SET status='result entered' WHERE id=$userid");

//code to get the patient details for the send email function.
$res=mysqli_query($con,"SELECT * FROM bookings WHERE id=$userid");
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);
$userdetail=$userRow['username'];
$res=mysqli_query($con,"SELECT * FROM patient WHERE icPatient='$userdetail'");
$userDow=mysqli_fetch_array($res,MYSQLI_ASSOC);

$dateofappointment = $userRow['date'];
$dateofappointment = date('m/d/Y',strtotime($dateofappointment));
$timeslot = $userRow['timeslot'];

//send email functionality notifying the patient that their result has been entered
$to = $userDow['patientEmail'];
$subject = "Test Results Available";
$body ="Hello " .$userDow['patientFirstName']. ",\n\nThank you for testing with Wayne County Healthy Communities! The results of your COVID test on " . date('m/d/Y', strtotime($dateofappointment)) . " are now available.\n\nPlease log in to WCHC COVID-19 Portal to view results.";
$header = "From: from@email";
mail($to, $subject, $body, $header)

?>
