<?php
session_start();
include_once '../assets/conn/dbconnect.php';
if(!isset($_SESSION['doctorSession']))
{
//if not logged in it will take you to the below location
header("Location: ../index.php");
}
$usersession = $_SESSION['doctorSession'];
$res=mysqli_query($con,"SELECT * FROM doctor WHERE doctorId=".$usersession);
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);





?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <script src="https://kit.fontawesome.com/95c473646d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/loginButton.css">
    <link rel="stylesheet" href="css/table.css">
    <link rel="stylesheet" href="css/input.css">
   </head>
   <header>
    <div class="hero-image">
        <a href="patient.php"><img src="../assets/pp.png" width="50%"></a>
    </div>
</header>
<body>
<!-- Sidebar code needs to be changed -->
<div class="sidebar">
    <ul class="nav-list">
      <li>
         <a href="doctordashboard.php">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
      </li>
      <li>
       <a href="addresults.php">
       <i class='bx bx-user-pin'></i>
         <span class="links_name">Add Result</span>
       </a>
     </li>
     <li>
       <a href="patientlist.php">
       <i class='bx bx-user-pin'></i>
         <span class="links_name">Patient List</span>
       </a>
     </li>
     <li>
         <a href="staff.php">
         <i class='bx bx-user'></i>
          <span class="links_name">Staff</span>
        </a>
      </li>
     <li>
         <a href="doctorprofile.php">
         <i class='bx bx-user'></i>
          <span class="links_name">Profile</span>
        </a>
      </li>
     <li class="profile">
         <div class="profile-details">
           <!--<img src="profile.jpg" alt="profileImg">-->
           <div class="name_job">
           </div>
         </div>
         <a href="logout.php?logout"><i class='bx bx-log-out' id="log_out" >Log Out</i></a>
     </li>
    </ul>
  </div>
  <section class="home-section">

                            <h2>
                            Staff List
                            </h2>
                            <a href='staffCreation.php'><button>Add Staff (+)</button></a>
                        <table>
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Date of Birth</th>
                                    <th>Edit<th>
                                    <th>Active/Inactive</th>

                                </tr>
                            </thead>
                            
                            <?php 
                            $result=mysqli_query($con,"SELECT * FROM staff");
                            

                            //displaying staff data from the datebase     
                            while ($patientRow=mysqli_fetch_array($result)) {
                                $test1 = $patientRow['staffDOB'];
                                $test1 = date('m/d/Y',strtotime($test1));
                                echo "<tbody>";
                                echo '<tr>
                                <td>'.$patientRow['icstaff'].'</td>
                                <td>'.$patientRow['staffFirstName'].'</td>
                                <td>'.$patientRow['staffLastName'].'</td>
                                <td>'.$patientRow['staffEmail'].'</td>
                                <td>'.$patientRow['staffPhone'].'</td>
                                <td>'.$test1.'</td>
                                <td>'.'<a href="editstaff.php?username='.$patientRow['icstaff'].'">'.'Edit'.'</a>'.'</td>
                                <td>'.'<a href="active.php?username='.$patientRow['icstaff'].'&active='.$patientRow['active'].'">'.$patientRow['active'].'</a>'.'</td>';
                            } 
                                echo "</tr>";
                           echo "</tbody>";
                       echo "</table>";
                        ?>

                        </section>

    </body>
</html>
