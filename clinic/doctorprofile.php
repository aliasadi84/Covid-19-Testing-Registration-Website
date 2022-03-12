<?php
session_start();
include_once '../assets/conn/dbconnect.php';
// include_once 'connection/server.php';
if(!isset($_SESSION['doctorSession']))
{
header("Location: ../index.php");
}
$usersession = $_SESSION['doctorSession'];
$res=mysqli_query($con,"SELECT * FROM doctor WHERE doctorId=".$usersession);
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);


if (isset($_POST['submit'])) {
//variables
$doctorFirstName = $_POST['doctorFirstName'];
$doctorLastName = $_POST['doctorLastName'];
$doctorPhone = $_POST['doctorPhone'];
$doctorEmail = $_POST['doctorEmail'];
$doctorAddress = $_POST['doctorAddress'];

$res=mysqli_query($con,"UPDATE doctor SET doctorFirstName='$doctorFirstName', doctorLastName='$doctorLastName', doctorPhone='$doctorPhone', doctorEmail='$doctorEmail', doctorAddress='$doctorAddress' WHERE doctorId=".$_SESSION['doctorSession']);
// $userRow=mysqli_fetch_array($res);

header( 'Location: doctorprofile.php' ) ;

}





?>
<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!--<title> Responsive Sidebar Menu  | CodingLab </title>-->
    <link rel="stylesheet" href="style.css">
    <!-- Boxicons CDN Link -->
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
       <a href="addschedule.php">
       <i class='bx bxs-calendar' ></i>
         <span class="links_name">Schedule</span>
       </a>
       <span class="tooltip">Schedule</span>
     </li>
     <li>
       <a href="patientlist.php">
       <i class='bx bx-user-pin'></i>
         <span class="links_name">Patient List</span>
       </a>
       <span class="tooltip">Patient List</span>
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
                            </h2><br><br>
 
                                    <h4><?php echo $userRow['doctorFirstName']; ?> <?php echo $userRow['doctorLastName']; ?></h4>

                                <hr />
                                        
                                        
                                        <table>
                                            <tbody>
                                                
                                                
                                                <tr>
                                                    <td>Doctor ID</td>
                                                    <td><?php echo $userRow['doctorId']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Contact Number</td>
                                                    <td><?php echo $userRow['doctorPhone']; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Email</td>
                                                    <td><?php echo $userRow['doctorEmail']; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Birthdate</td>
                                                    <td><?php echo $userRow['doctorDOB']; ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table><br><br><br>

                                        <form action="<?php $_PHP_SELF ?>" method="post" >
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td>First Name:</td>
                                                        <td><input type="text" class="form-control" name="doctorFirstName" value="<?php echo $userRow['doctorFirstName']; ?>"  /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Last Name</td>
                                                        <td><input type="text" class="form-control" name="doctorLastName" value="<?php echo $userRow['doctorLastName']; ?>"  /></td>
                                                    </tr>
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    <tr>
                                                        <td>Phone number</td>
                                                        <td><input type="text" class="form-control" name="doctorPhone" value="<?php echo $userRow['doctorPhone']; ?>"  /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email</td>
                                                        <td><input type="text" class="form-control" name="doctorEmail" value="<?php echo $userRow['doctorEmail']; ?>"  /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="submit" name="submit" class="btn btn-info" value="Update Info"></td>
                                                        </tr>
                                                    </tbody>
                                                    
                                                </table>
                                                
                                                
                                                
                                            </form>


    </section>
       
        <!-- jQuery -->

        <!-- Latest compiled and minified JavaScript -->
         <!-- script for jquery datatable start-->
        <!-- Include Date Range Picker -->
        <script>
          let sidebar = document.querySelector(".sidebar");
          let closeBtn = document.querySelector("#btn");
          let searchBtn = document.querySelector(".bx-search");

          closeBtn.addEventListener("click", ()=>{
            sidebar.classList.toggle("open");
            menuBtnChange();//calling the function(optional)
          });

          searchBtn.addEventListener("click", ()=>{ // Sidebar open when you click on the search iocn
            sidebar.classList.toggle("open");
            menuBtnChange(); //calling the function(optional)
          });

          // following are the code to change sidebar button(optional)
          function menuBtnChange() {
          if(sidebar.classList.contains("open")){
            closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
          }else {
            closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the iocns class
          }
          }
          </script>

    </body>
</html>