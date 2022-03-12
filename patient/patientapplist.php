<?php
session_start();
include_once '../assets/conn/dbconnect.php';
$session=$_SESSION[ 'patientSession'];
$res=mysqli_query($con, "SELECT a.*, b.*,c.* FROM patient a
	JOIN appointment b
		On a.icPatient = b.patientIc
	JOIN doctorschedule c
		On b.scheduleId=c.scheduleId
	WHERE b.patientIc ='$session'");
	if (!$res) {
		die( "Error running $sql: " . mysqli_error());
	}
	$userRow=mysqli_fetch_array($res);
?>
<!DOCTYPE html>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<noscript><link rel="stylesheet" href="css/noscript.css" /></noscript>
<!-- below: css files listed -->
    <link rel="stylesheet" href="main.css" />  
    <link rel="stylesheet" href="assets/css/nav.css">     <!-- navigation bar specific css -->
    <link rel="stylesheet" href="assets/css/account.css">      <!-- account specific css -->
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
    <meta charset="utf-8">
    <meta name="viewport"
       content="width=device-width,
       initial-scale=1">
    <title>Account</title>
       
      <!-- Header/ Nav Bar -->
	  <header>
    <div class="hero-image">
        <a href="https://www.waynecountyhealthy.com" ><img src="assets/img/pp.png" width="100%"></a>
    </div>
</header>

<body>

  <header>



    </header>
  
  <div class="wrapper">
     <div class="bf">
<?php



echo "<h1>Your appointment list. </h1>";
echo "<table>";
echo "<thead>";
echo "<tr>";
echo "<th>scheduleDate </th>";
echo "<th>startTime </th>";
echo "<th>endTime </th>";
echo "</tr>";
echo "</thead>";
$res = mysqli_query($con, "SELECT a.*, b.*,c.*
		FROM patient a
		JOIN appointment b
		On a.icPatient = b.patientIc
		JOIN doctorschedule c
		On b.scheduleId=c.scheduleId
		WHERE b.patientIc ='$session'");

if (!$res) {
die("Error running $sql: " . mysqli_error());
}


while ($userRow = mysqli_fetch_array($res)) {
echo "<tbody>";
echo "<tr>";
echo "<td>" . $userRow['scheduleDate'] . "</td>";
echo "<td>" . $userRow['startTime'] . "</td>";
echo "<td>" . $userRow['endTime'] . "</td>";
echo "<td><a href='invoice.php?appid=".$userRow['appId']."' target='_blank'><span class='glyphicon glyphicon-print' aria-hidden='true'></span></a> </td>";
}

echo "</tr>";
echo "</tbody>";
echo "</table>";

?>
	</div>
</div>
</div>
</div>
<!-- display appoinment end -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>