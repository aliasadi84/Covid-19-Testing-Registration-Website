<?php
//main page in the patient side
session_start();
include_once '../assets/conn/dbconnect.php';
if(!isset($_SESSION['patientSession']))
{
header("Location: ../index.php");
}
$usersession = $_SESSION['patientSession'];

$res=mysqli_query($con,"SELECT * FROM patient WHERE icPatient = '$usersession'");

if ($res===false) {
	echo mysql_error();
} 

$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);
?>
<!DOCTYPE HTML>

<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <script src="https://kit.fontawesome.com/95c473646d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/button.css">
</head>

<header>
    <div class="hero-image">
        <a href="https://www.waynecountyhealthy.com"><img src="../assets/pp.png" width="50%"></a>
    </div>
</header>

<body>

    <?php
                echo "<h1>Welcome to the COVID-19 Testing Portal, " . $userRow['patientFirstName'] . "!</h1>";  
    ?>
    </div>

    <article>
        <section>
	<a href="profile.php?patientId=<?php echo $userRow['icPatient']; ?>">
                 <button class="button" ><i class="fa-solid fa-user"></i><pre>Account</pre></button>
            </a><br>
            <a href="appo.php?patientId=<?php echo $userRow['icPatient']; ?>">
                <button class="button"><i class="fa-solid fa-calendar-days"></i><pre>Schedule</pre></button>
            </a><br>
            <a href="check_in.php">
                <button class="button"><i class="fa-solid fa-car-side"></i><pre>Check-In</pre></button>
            </a><br>
            <a href="results.php">
                   <button class="button"><i class="fa-solid fa-virus-covid"></i><pre>Results</pre></button>
            </a>
            <br>
            
        </section>
      </article>


</body>
</html>
