<?php
//THIS PAGE DISPLAYS A CONFIRMATION OF THE BOOKED APPOINTMENT
session_start();
//connection to the database
include_once '../assets/conn/dbconnect.php';

if(!isset($_SESSION['patientSession']))
{
//if not logged into the staff side it will direct you to the index.html
header("Location: ../index.html");
}
//patient username is stored into the variable '$usersession'
$usersession = $_SESSION['patientSession'];
//gets the date and time of the appointment
if (isset($_GET['date']) && isset($_GET['timeslot'])) {

	$date =$_GET['date'];
	$timeslot = $_GET['timeslot'];
}
//user information is pulled from the database (patient table) by constiction in patient username -> "WHERE icPatient = '$usersession'"
$res=mysqli_query($con,"SELECT * FROM patient WHERE icPatient = '$usersession'");
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);


//send mail to the patient to state that the appointment is booked.
//the 'to:' Email Address which is the patient email
$to = $userRow['patientEmail'];
//the 'subject:' content of the email
$subject = "Appointment Confirmation Email";
//the 'body:' content of the email. ".$userRow['patientFirstName']." states the first name of the patient, "$date" states date of the appointment, & "$timeslot" states the start - end time of the appointment.
$body ="Hello " .$userRow['patientFirstName']. ",\n\nThank you for scheduling an appointment with Wayne County Healthy Communities! You have scheduled an appointment for $date from $timeslot.\n\nWe look forward to seeing you!";
$header = "From: from@email";
mail($to, $subject, $body, $header)
?>  




<!DOCTYPE html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <!--css design files-->
    <script src="https://kit.fontawesome.com/95c473646d.js" crossorigin="anonymous"></script>
    <!--fontawesome link that connects fontawesome with the page-->
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/loginButton.css">
	<link rel="stylesheet" href="../assets/css/submit.css">
	<link rel="stylesheet" href="../assets/css/table.css">
	<link rel="stylesheet" href="../assets/css/input.css">
    <!--end of css design files-->
</head>

<!--The header of the appointment confirmation page, which contains the logo of WCHC clinic. The link is directed to the
the WCHC Clinic Staff Dashboard-->
<header>
    <div class="hero-image">
        <a href="patient.php"><img src="../assets/pp.png" width="50%"></a>
    </div>
</header>
<!--end of the header-->
<!--Appointment confirmation after a appointment is booked.-->

<body>
<main>

    <div class="bf">
        <h1>Your appointment has been scheduled!</h1><br>
        <!--Apppointment and patient information is displayed-->
        <!--Displays the date of the appointment booked -> "echo date('m/d/Y', strtotime($date))"-->
        <!--Displays the email of the patient -> "echo $userRow['patientEmail']"-->
        <p>Your appointment will be on <?php echo date('m/d/Y', strtotime($date));?> from <?php echo $timeslot?>
        <br><br>A confirmation email has be sent to <?php echo $userRow['patientEmail'] ?>.
         <!--The link takes you to the list of appointments in patientapplist.php-->
        <br><br><a href="patientapplist.php">Click here to view your appointments!</a></p>
    </div>

</main>
</body>
</html>
