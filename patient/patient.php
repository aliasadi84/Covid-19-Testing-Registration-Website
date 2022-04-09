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
        <a href="patient.php"><img src="../assets/pp.png" width="50%"></a>
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
                 <button class="button1" ><i class="fa-solid fa-user"></i><pre>Account</pre></button>
            </a><br>
            <a href="appo.php?patientId=<?php echo $userRow['icPatient']; ?>">
                <button class="button1"><i class="fa-solid fa-calendar-days"></i><pre>Schedule</pre></button>
            </a><br>
            <a href="check_in.php">
                <button class="button1"><i class="fa-solid fa-car-side"></i><pre>Check-In</pre></button>
            </a><br>
            <a href="results.php">
                   <button class="button1"><i class="fa-solid fa-virus-covid"></i><pre>Results</pre></button>
            </a>
            <br>
            <br>
        </section>
      </article>


</body>
<footer id="footer">
  <section class="hours">
    <br>
    <table width="90%">
      <tr>
        <th><h3>Clinic Hours</h3></th>
      </tr>
       
       <tr>
          <td>Monday-Tuesday</td>
          <td>9:00 am - 5:30 pm</td>
        </tr> 
        <tr>
          <td>Wednesday</td>
          <td>11:00 am - 7:30 pm</td>
        </tr>
        <tr>
          <td>Thursday-Friday</td>
          <td>9:00 am - 5:30 pm</td>
        </tr> 
        <tr>
          <td>Saturday</td>
          <td>9:00 am - 1:00 pm</td>
        </tr>
        <tr>
          <td>Sunday</td>
          <td>Closed</td>
       </tr>
    </table>
    <br>
  </section>
  <section class="find">
        <table width="90%">
            <tr>
              <th><h3>Find Us!</h3></th>
            </tr>
            <tr>
                <td>Phone</td>
                <td><a href="tel:3138711926">(313) 871-1926</a></td><br>
              </tr>
            <tr>
              <td>Address</td>
              <td><a href="https://goo.gl/maps/AYQRS5F6WrYikLVj7" target="_blank">9021 Joseph Campau &bull; Hamtramck, MI 48212 &bull; USA</a></td>
            </tr>
            <tr>
              <td>Website</td>
              <td><a href="https://www.waynecountyhealthy.com/" target="_blank">www.waynecountyhealthy.com</a></td>
            </tr>
            </table>
            <br>
            <div>
            <a href="https://www.paypal.com/fundraiser/charity/2121252" target="_blank" class="fa fa-paypal"></a>
            <a href="https://www.facebook.com/WayneCountyHealthyCommunities/" target="_blank" class="fa fa-facebook"></a>
            <a href="https://www.instagram.com/waynecountyhealthycommunities/" target="_blank" class="fa fa-instagram"></a>
            <a href="https://www.linkedin.com/company/wayne-county-healhty-communities/" target="_blank" class="fa fa-linkedin"></a>
          </div>
    </section>
</footer>
</html>
