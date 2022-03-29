<?php
session_start();
include_once '../assets/conn/dbconnect.php';
if(!isset($_SESSION['staffSession']))
//if your not login it will take you to the staff login
{
header("Location: ../adminlogin.php");
}
$usersession = $_SESSION['staffSession'];
$res=mysqli_query($con,"SELECT * FROM staff WHERE icstaff = '$usersession'");
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

<!-- Sidebar that needs to be changed -->
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
       <a href="patientlist.php">
       <i class='bx bx-user-pin'></i>
         <span class="links_name">Patient List</span>
       </a>
       <span class="tooltip">Patient List</span>
     </li>
     <li>
         <a href="addresults.php">
         <i class='bx bxs-virus'></i>
          <span class="links_name">Add Result</span>
        </a>
         <span class="tooltip">Result</span>
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
           <!--<img src="profile.jpg" alt="profileImg">-->
           <div class="name_job">

           </div>
         </div>
         <a href="logout.php?logout"><i class='bx bx-log-out' id="log_out" ></i></a>
     </li>
    </ul>
  </div>
  <section class="home-section">


                            <h2>
                            Staff Profile
                            <!-- code it dispalying the data -->
                            </h2><br><br>
 
                                    <h4><?php echo $userRow['staffFirstName']; ?> <?php echo $userRow['staffLastName']; ?></h4>

                                <hr />
                                        
                                        
                                        <table>
                                            <tbody>
                                                
                                                
                                                <tr>
                                                    <td>Username</td>
                                                    <td><?php echo $userRow['icstaff']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Contact Number</td>
                                                    <td><?php echo $userRow['staffPhone']; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Email</td>
                                                    <td><?php echo $userRow['staffEmail']; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Birthdate</td>
                                                    <td><?php echo $userRow['staffDOB']; ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table><br><br><br>

                                        



<!-- Sidebar code that needs to be removed -->
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
