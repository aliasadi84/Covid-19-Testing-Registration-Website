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
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <style>
      table {
        border-collapse: collapse;
        width: 100%;
        color: #588c7e;
        font-family: monospace;
        font-size: 12px;
        text-align: left;
      }
      th {
        background-color: #588c7e;
        color: white;
      }
      tr:nth-child(even){background-color: #f2f2f2;}
    </style>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
<div class="sidebar">
    <div class="logo-details">
        <div class="logo_name">WCHC Clinic</div>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
      <li>
         <a href="doctordashboard.php">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
         <span class="tooltip">Dashboard</span>
      </li>
      <li>
         <a href="addresults.php">
         <i class='bx bxs-virus'></i>
          <span class="links_name">Add Result</span>
        </a>
         <span class="tooltip">Result</span>
      </li>
     <li>
       <a href="patientlist.php">
       <i class='bx bx-user-pin'></i>
         <span class="links_name">Patient List</span>
       </a>
       <span class="tooltip">Patient List</span>
     </li>
     <li>
       <a href="staff.php">
       <i class='bx bx-plus-medical'></i>
         <span class="links_name">Staff</span>
       </a>
       <span class="tooltip">Staff</span>
     </li>
     <li>
         <a href="doctorprofile.php">
         <i class='bx bx-user'></i>
          <span class="links_name">Staff Profile</span>
        </a>
         <span class="tooltip">Staff Profile</span>
      </li>
     <li class="profile">
         <div class="profile-details">
           <div class="name_job">
           </div>
         </div>
         <!-- logout functionality -->
         <a href="logout.php?logout"><i class='bx bx-log-out' id="log_out" ></i></a>
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
                                
                              
                                echo "<tbody>";
                                echo '<tr>
                                <td>'.$patientRow['icstaff'].'</td>
                                <td>'.$patientRow['staffFirstName'].'</td>
                                <td>'.$patientRow['staffLastName'].'</td>
                                <td>'.$patientRow['staffEmail'].'</td>
                                <td>'.$patientRow['staffPhone'].'</td>
                                <td>'.$patientRow['staffDOB'].'</td>
                                <td>'.'<a href="editstaff.php?username='.$patientRow['icstaff'].'">'.'Edit'.'</a>'.'</td>
                                <td>'.'<a href="active.php?username='.$patientRow['icstaff'].'&active='.$patientRow['active'].'">'.$patientRow['active'].'</a>'.'</td>';
                            } 
                                echo "</tr>";
                           echo "</tbody>";
                       echo "</table>";
                        ?>

                        </section>

          <script>
          let sidebar = document.querySelector(".sidebar");
          let closeBtn = document.querySelector("#btn");
          let searchBtn = document.querySelector(".bx-search");

          closeBtn.addEventListener("click", ()=>{
            sidebar.classList.toggle("open");
            menuBtnChange();
          });

          searchBtn.addEventListener("click", ()=>{ 
            sidebar.classList.toggle("open");
            menuBtnChange(); 
          });

         
          function menuBtnChange() {
          if(sidebar.classList.contains("open")){
            closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
          }else {
            closeBtn.classList.replace("bx-menu-alt-right","bx-menu");
          }
          }
          </script>

    </body>
</html>