<?php
session_start();
//connection to the database
include_once '../assets/conn/dbconnect.php';
if(!isset($_SESSION['patientSession']))
{
//if not logged into the patient side it will direct you to the index.html
header("Location: ../index.html");
}
//patient username is stored into the variable '$session'
$session=$_SESSION[ 'patientSession'];
//gets all the appointments of the patient
$res=mysqli_query($con,"SELECT * FROM patient WHERE icPatient = '$session'");
        if (!$res) {
            echo '<script>';
            echo 'alert("No data have been stored for entering results");';
            echo 'window.location.href = "addresults.php";';
            echo '</script>';
        
            die();
        }
	$userRow=mysqli_fetch_array($res);
?>
<!DOCTYPE html>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <!--css design files-->
    <link rel="stylesheet" href="assets/css/main.css" />  
    <link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet" href="assets/css/account.css">

    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <script src="https://kit.fontawesome.com/95c473646d.js" crossorigin="anonymous"></script>
    <!--fontawesome link that connects fontawesome with the page-->
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/button.css">
	<link rel="stylesheet" href="../assets/css/table.css">
	<link rel="stylesheet" href="../assets/css/input.css">
    <!--end of css design files-->
    </head>
    <!--The header of the patient appointment list page, which contains the logo of WCHC clinic. The link is directed to the
    the WCHC Clinic Staff Dashboard-->
    <header>
        <div class="hero-image">
            <a href="patient.php"><img src="../assets/pp.png" width="50%"></a>
        </div>
    </header>
    <!--end of the header-->

<body>
  
  <div class="wrapper">
    <!--displays appointment list-->
    <?php
    echo "<h1>" . $userRow['patientFirstName'] . "'s Appointment List</h1>";
    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Date </th>";
    echo "<th>Time Slot</th>";
    echo "<th>Status</th>";
    echo "<th>Cancel</th>";
    echo "</tr>";
    echo "</thead>";
    $res = mysqli_query($con, "SELECT a.*, b.*
        FROM patient a
        JOIN bookings b
        On a.icPatient = b.username
        WHERE b.username ='$session'
        Order By date desc");

    if (!$res) {
        echo '<script>';
        echo 'alert("No data have been stored for appointment");';
        echo 'window.location.href = "patientapplist.php";';
        echo '</script>';

        die();
    }

    echo "<tbody>";
    while ($userRow = mysqli_fetch_array($res)) {
    if ($userRow['status'] != 'result entered'){
    echo "<tr>";
    echo "<td>" . date('F d, Y', strtotime($userRow['date'])) . "</td>";
    echo "<td>" . $userRow['timeslot'] . "</td>";
    echo "<td>" . $userRow['status'] . "</td>";
    if ($userRow['status'] == 'appointment booked'){
        echo '<td>'.'<a href="cancelappt.php?username='.$userRow['id'].'">Cancel</a>'.'</td>';
    }
    if ($userRow['status'] != 'appointment booked'){
        echo "<td><a>Not available</a></td>";
    }
    echo "</tr>";
    }}
    echo "</tbody>";
    echo "</table>";

    ?>
	</div>

</body>
</html>

