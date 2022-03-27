<?php
session_start();
include_once '../assets/conn/dbconnect.php';
$session=$_SESSION[ 'patientSession'];
$res=mysqli_query($con, "SELECT a.*, b.* FROM patient a
	JOIN bookings b
		On a.icPatient = b.username
	WHERE b.username ='$session'");
	if (!$res) {
		die( "Error running $sql: " . mysqli_error());
	}
	$userRow=mysqli_fetch_array($res);
?>
<!DOCTYPE html>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />  
    <link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet" href="assets/css/account.css">

	<style>
      table {
        border-collapse: collapse;
        width: 100%;
        color: #588c7e;
        font-family: monospace;
        font-size: 16px;
        text-align: left;
      }
      th {
        background-color: #588c7e;
        color: white;
      }
      tr:nth-child(even){background-color: #f2f2f2;}
    </style>

    <title>Account</title>
       
      <!-- Header/ Nav Bar -->
	  <header>
    <div class="hero-image">
        <a href="https://www.waynecountyhealthy.com" ><img src="assets/img/pp.png" width="100%"></a>
    </div>
    </header>

<body>
  
  <div class="wrapper">
    <?php


    //populates the appointments that you have booked
	  // NOTE FROM TIM: I would recommend changing "Your Appointment List" to say "<user-first-name>'s Appointment List" like we have on the homepage
    echo "<h1>Your Appointment List</h1>";
    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Date </th>";
    echo "<th>Time Slot</th>";
    echo "</tr>";
    echo "</thead>";
    $res = mysqli_query($con, "SELECT a.*, b.*
        FROM patient a
        JOIN bookings b
        On a.icPatient = b.username
        WHERE b.username ='$session'");

    if (!$res) {
    die("Error running $sql: " . mysqli_error());
    }


    while ($userRow = mysqli_fetch_array($res)) {
    echo "<tbody>";
    echo "<tr>";
    echo "<td>" . $userRow['date'] . "</td>";
    echo "<td>" . $userRow['timeslot'] . "</td>";
    }

    echo "</tr>";
    echo "</tbody>";
    echo "</table>";

    ?>
	</div>

</body>
</html>

