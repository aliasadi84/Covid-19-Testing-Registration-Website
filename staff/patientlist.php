<?php
session_start();
include_once '../assets/conn/dbconnect.php';
if(!isset($_SESSION['staffSession']))
{
//if not logged in it will take you to the below location
header("Location: ../stafflogin.php");
}
$usersession = $_SESSION['staffSession'];
$res=mysqli_query($con,"SELECT * FROM staff WHERE icstaff = '$usersession'");
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);





?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <script src="https://kit.fontawesome.com/95c473646d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/button.css">
	  <link rel="stylesheet" href="table.css">
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
      <li><a class="active" href="patientlist.php">Patient List</a></li>
      <li><a href="doctorprofile.php">Your Account</a></li>
      <li style="float:right"><a href="logout.php?logout">Log Out</a></li>
    </ul>
  <section class="home-section">
                        <table>
                            <thead>
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
                                </tr>
                            </thead>
                            
                            <?php 
                            $result=mysqli_query($con,"SELECT * FROM patient");
                            

                            //displaying the data from the datebase     
                            while ($patientRow=mysqli_fetch_array($result)) {
                                
                              
                                echo "<tbody>";
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
                               
                            } 
                                echo "</tr>";
                           echo "</tbody>";
                       echo "</table>";
                       echo "<div>";
                       
                        echo "</div>";
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
