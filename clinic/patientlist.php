<?php
session_start();
include_once '../assets/conn/dbconnect.php';
if(!isset($_SESSION['doctorSession']))
{
//if not logged into the admin side it will direct you to the index.html
header("Location: ../index.html");
}
$usersession = $_SESSION['doctorSession'];
//Checking the admin ID making sure it's still there
$res=mysqli_query($con,"SELECT * FROM doctor WHERE doctorId=".$usersession);
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <!--css design files-->
    <script src="https://kit.fontawesome.com/95c473646d.js" crossorigin="anonymous"></script>
    <!--fontawesome link that connects fontawesome with the page-->
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/button.css">
    <link rel="stylesheet" href="table.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/input.css">
    <!--end of css design files-->
</head>
<!--The header of the patientlist page, which contains the logo of WCHC clinic. The link is directed to the
the WCHC Clinic Admin Dashboard-->
<header>
    <div class="hero-image">
        <a href="doctordashboard.php"><img src="../assets/pp.png" width="50%"></a>
    </div>
</header>
<!--end of the header-->
<body>
<ul>
      <!--Top navigation with all links to the admin side-->
      <li><a href="doctordashboard.php">Dashboard</a></li>
      <li><a href="addresults.php">Add Result</a></li>
      <li><a class="active" href="patientlist.php">Patient List</a></li>
      <li><a href="staff.php">Staff List</a></li>
      <li><a  href="doctorprofile.php" >Your Account</a></li>
      <li style="float:right"><a href="logout.php?logout">Log Out</a></li>
    </ul>
    <!--End of top navigation-->
  <section class="home-section">
    <table>
        <thead>
        <!--Table heading-->
        <th colspan="8"><h2>Patient List</h2></th>
            <tr>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Gender</th>
                <th>Birthdate</th>
                <th>Race</th>
            <!--End of table heading-->
            </tr>
        </thead>

        <!-- Below code is populating the patient details-->
        <?php 
        $result=mysqli_query($con,"SELECT * FROM patient");
        
        echo "<tbody>";
        //displaying the data from the datebase     
        while ($patientRow=mysqli_fetch_array($result)) {

            echo "<tr>";
                echo "<td>" . $patientRow['icPatient'] . "</td>";
                echo "<td>" . $patientRow['patientFirstName'] . "</td>";
                echo "<td>" . $patientRow['patientLastName'] . "</td>";
                echo "<td>" . $patientRow['patientEmail'] . "</td>";
                echo "<td>" . $patientRow['patientPhone'] . "</td>";
                echo "<td>" . $patientRow['patientGender'] . "</td>";
                echo "<td>" . $patientRow['patientDOB'] . "</td>";
                echo "<td>" . $patientRow['race'] . "</td>";
                echo "<form method='POST'>";
                echo "<td class='text-center'><a href='#' id='".$patientRow['icPatient']."' class='delete'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
                </td>";
            echo "</tr>";
        } 
        echo "</tbody>";
        echo "</table>";
    ?>

    </section>

</body>
</html>
