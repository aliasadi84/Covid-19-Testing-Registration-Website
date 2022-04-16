<?php
//THIS PAGE DISPLAYS THE RESULTS OF TEST'S THE PATIENT HAS TAKEN.
session_start();
//connection to the database
include_once '../assets/conn/dbconnect.php';
if(!isset($_SESSION['patientSession']))
{
//page directs to the  index.html if a patient session has not been started.
header("Location: ../index.html");
}
//patient username is stored into the variable '$session'
$session=$_SESSION[ 'patientSession'];
//the code below gets the patient result by matching username in bookings table and username in patient table -> "On a.icPatient = b.username"
//while setting the username in patient side with the varible taken from '$session' -> "WHERE b.username ='$session'"
$res=mysqli_query($con, "SELECT a.*, b.* FROM patient a
	JOIN bookings b
	On a.icPatient = b.username
	WHERE b.username ='$session'
    Order By date desc");

//if there are no results found in the database for the patient an alert maessage is given to notify them that -> "alert('There are no results available at the present');"
	if (!$res) {
		?>
        <script>
            alert('There are no results available at the present');
        </script>
        <?php
	}
	$userRow=mysqli_fetch_array($res);
?>
<!DOCTYPE html>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<head>
    <!--css design files-->
    <link rel="stylesheet" href="assets/css/main.css" />  
    <link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet" href="assets/css/account.css">
    <script src="https://kit.fontawesome.com/95c473646d.js" crossorigin="anonymous"></script>
    <!--fontawesome link that connects fontawesome with the page-->
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/button.css">
	<link rel="stylesheet" href="../assets/css/table.css">
	<link rel="stylesheet" href="../assets/css/input.css">
    <!--end of css design files-->
</head>

	<!--The header of the patient profile page, which contains the logo of WCHC clinic. The link is directed to the
    the WCHC Clinic Patient Dashboard-->
<header>
    <div class="hero-image">
        <a href="patient.php"><img src="../assets/pp.png" width="50%"></a>
    </div>
</header>
    <!--end of the header-->

<body>
    <?php
    //populates the results that are entered
    echo "<table>";
    echo "<thead>";
    echo "<th colspan='7'><h2>" . $userRow['patientFirstName'] . "'s Results</h2></th><br>";
    echo "<tr>";
    echo "<th>Date </th>";
    echo "<th>Time Slot</th>";
    echo "<th>Result</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    
    while ($userRow = mysqli_fetch_array($res)) {
    if($userRow['status'] == 'result entered'){
    echo "<tr>";
    echo "<td>" . date('F d, Y', strtotime($userRow['date'])) . "</td>";
    echo "<td>" . $userRow['timeslot'] . "</td>";
    echo "<td>" . $userRow['result'] . "</td>";
    echo "</tr>";
    }}
    echo "</tbody>";
    echo "</table>";
    ?>
	

</body>
</html>
