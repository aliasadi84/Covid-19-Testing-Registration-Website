<?php
session_start();
include_once '../assets/conn/dbconnect.php';
if(!isset($_SESSION['AdminSession']))
{
//if not logged in it will take you to the below location
header("Location: ../index.html");
}
$usersession = $_SESSION['AdminSession'];
$res=mysqli_query($con,"SELECT * FROM admin WHERE AdminId= '$usersession'");
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <script src="https://kit.fontawesome.com/95c473646d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/button.css">
    <link rel="stylesheet" href="table.css">
    <link rel="stylesheet" href="../assets/css/table.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/input.css">
</head>

<header>
    <div class="hero-image">
        <a href="doctordashboard.php"><img src="../assets/pp.png" width="50%"></a>
    </div>
</header>
<body>
<ul>
      <li><a  href="doctordashboard.php">Dashboard</a></li>
      <li><a href="addresults.php">Add Result</a></li>
      <li><a href="patientlist.php">Patient List</a></li>
      <li><a class="active" href="staff.php">Staff List</a></li>
      <li><a href="doctorprofile.php">Your Account</a></li>
      <li style="float:right"><a href="logout.php?logout">Log Out</a></li>
    </ul>
  <section class="home-section">
      
    <input type="text" name="search" id="search" placeholder="Search..." />
    <h4 style="text-align:center;">Staff List</h4> 
    <br><a href='staffCreation.php'><button class="button2">Add Staff (+)</button></a>
    <table class="table-sortable">
        <thead>
            <tr>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Date of Birth</th>
                <th>Edit<th>
                <th>Active</th>

            </tr>
        </thead>
        
        <?php 
        $result=mysqli_query($con,"SELECT * FROM staff");
        if (!$result) {
          echo '<script>';
          echo 'alert("No data have been stored for staff");';
          echo 'window.location.href = "patientlist.php";';
          echo '</script>';
      
          die();
      }
        echo "<tbody>";
        //displaying staff data from the datebase     
        while ($patientRow=mysqli_fetch_array($result)) {
            echo '<tr>
            <td>'.$patientRow['icstaff'].'</td>
            <td>'.$patientRow['staffFirstName'].'</td>
            <td>'.$patientRow['staffLastName'].'</td>
            <td>'.$patientRow['staffEmail'].'</td>
            <td>'.$patientRow['staffPhone'].'</td>
            <td>'.$patientRow['staffDOB'].'</td>
            <td>'.'<a href="editstaff.php?username='.$patientRow['icstaff'].'">'.'Edit'.'</a>'.'</td>
            <td>'.'<a href="active.php?username='.$patientRow['icstaff'].'&active='.$patientRow['active'].'">'.$patientRow['active'].'</a>'.'</td>';
            echo "</tr>";
          } 
        echo "</tbody>";
    echo "</table>";
    ?>

    </section>
    <script>
        const searchInput = document.getElementById("search");
        const rows = document.querySelectorAll("tbody tr");
        console.log(rows);
        searchInput.addEventListener("keyup", function (event) {
        const q = event.target.value.toLowerCase();
        rows.forEach((row) => {
          row.querySelector("td").textContent.toLowerCase().startsWith(q)
            ? (row.style.display = "table-row")
            : (row.style.display = "none");
        });
      });
    </script>
    <script src="tablesort.js"></script>
    </body>
</html>
