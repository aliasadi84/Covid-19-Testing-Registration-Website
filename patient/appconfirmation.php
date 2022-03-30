<?php

session_start();
include_once '../assets/conn/dbconnect.php';

if(!isset($_SESSION['patientSession']))
{
header("Location: ../index.php");
}
$usersession = $_SESSION['patientSession'];

if (isset($_GET['date']) && isset($_GET['timeslot'])) {
	$date =$_GET['date'];
	$timeslot = $_GET['timeslot'];
}

$res=mysqli_query($con,"SELECT * FROM patient WHERE icPatient = '$usersession'");
// Add additional SQL query to pull from appointments table

$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);



$to = $userRow['patientEmail'];
$subject = "Appointment Confirmation Email";
$body ="Hello " .$userRow['patientFirstName']. ",\n\nThank you for scheduling an appointment with Wayne County Healthy Communities! You have scheduled an appointment for $date from $timeslot.\n\nWe look forward to seeing you!";
$header = "From: from@email";
mail($to, $subject, $body, $header)
?>  




<!DOCTYPE html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <script src="https://kit.fontawesome.com/95c473646d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/loginButton.css">
	<link rel="stylesheet" href="../assets/css/submit.css">
	<link rel="stylesheet" href="../assets/css/table.css">
	<link rel="stylesheet" href="../assets/css/input.css">
</head>

<header>
    <div class="hero-image">
        <a href="patient.php"><img src="../assets/pp.png" width="50%"></a>
    </div>
</header>
<main>
    <div class="bf">
        Your appointment has been scheduled!</h1><br>

        Your appointment will be on <?php echo date('m/d/Y', strtotime($date));?> from <?php echo $timeslot?>
        <br><br>A confirmation email has be sent to <?php echo $userRow['patientEmail'] ?>.
        <br><br><a href="patientapplist.php">Click here to view your appointments!</a>
    </div>
<!-- Change the variable names as needed -->

</main>
</html>
