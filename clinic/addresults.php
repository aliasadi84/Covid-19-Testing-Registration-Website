<?php
session_start();
include_once '../assets/conn/dbconnect.php';
if(!isset($_SESSION['doctorSession']))
{
//if not logged into the admin side it will direct you to the index
header("Location: ../adminlogin.php");
}
$usersession = $_SESSION['doctorSession'];
//Checking the doctor ID making sure it's still there
$res=mysqli_query($con,"SELECT * FROM doctor WHERE doctorId=".$usersession);
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);


//html needs to be redone
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
       <a href="patientlist.php">
       <i class='bx bx-user-pin'></i>
         <span class="links_name">Patient List</span>
       </a>
     </li>
     <li>
       <a href="addresults.php">
       <i class='bx bx-user-pin'></i>
         <span class="links_name">Add Result</span>
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
  <section class="home-section"><br>
              
    
            <h3>Add Result List</h3>

            <table>
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Contact No.</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Positive</th>
                        <th>Negetive</th>
                    </tr>
                </thead>
              
                
                
               <!-- Below code is populating the appointment table -->
               <!-- First code block is pulling the data and comparing the data -->
                <?php 
                $res=mysqli_query($con,"SELECT a.*, b.*
                                        FROM patient a
                                        JOIN bookings b
                                        On a.icPatient = b.username
                                        WHERE b.status = 'sample collected'
                                        OR b.status = 'result entered'
                                        Order By id desc");
                      if (!$res) {
                        printf("Error: %s\n", mysqli_error($con));
                        exit();
                    }
                    $cal= 0;
                while ($appointment=mysqli_fetch_array($res)) {
                    
                
                  //code for the check in box    
                  if ($appointment['status']=='sample collected') {
                        $status="danger";
                        $icon='remove';
                        $checked='';

                    } else {
                        $status="success";
                        $icon='ok';
                        $checked = 'disabled';
                    }
                    $cal= $cal+1;
                    // Displaying the data,
                    $test1 = $appointment['date'];
                    $test1 = date('m/d/Y',strtotime($test1));
                    echo "<tbody>";
                    echo "<tr>";
                        echo "<td>" . $appointment['patientFirstName'] . "</td>";
                        echo "<td>" . $appointment['patientLastName'] . "</td>";
                        echo "<td>" . $appointment['patientPhone'] . "</td>";
                        echo "<td>" . $appointment['patientEmail'] . "</td>";
                        echo "<td>" . $test1 . "</td>";
                        echo "<td>" . $appointment['timeslot'] . "</td>";
                        echo "<td>" . $appointment['status'] . "</td>";
                        echo "<form method='POST'>";
                        echo "<td ><input type='radio' name='enable".$cal."' id='enable".$cal."' value='".$appointment['id']."' onclick='chkit(".$appointment['id'].",this.checked);' ".$checked."></td>";
                        echo "<td ><input type='radio' name='enable".$cal."' id='enable".$cal."' value='".$appointment['id']."' onclick='chki(".$appointment['id'].",this.checked);' ".$checked."></td>";
                
                    
                } 
                    echo "</tr>";
                echo "</tbody>";
            echo "</table>";
            echo "<div>";
            echo "<div>";
            echo "<button type='submit' value='Submit' name='submit'>Update</button>";
            echo "</div>";
            echo "</div>";
            ?>
  </section>
                    <!-- panel end -->

<!-- takes all the inputs from the checkbox, send to resultdb.php to enter the positive result -->
<script type="text/javascript">
function chkit(uid, chk) {
   chk = (chk==true ? "1" : "0");
   var url = "resultdb.php?userid="+uid+"&chkYesNo="+chk;
   if(window.XMLHttpRequest) {
      req = new XMLHttpRequest();
   } else if(window.ActiveXObject) {
      req = new ActiveXObject("Microsoft.XMLHTTP");
   }
   // Use get instead of post.
   req.open("GET", url, true);
   req.send(null);
}
//takes all the inputs from the checkbox, send to nresultdb.php to enter the negetive results
function chki(uid, chk) {
   chk = (chk==true ? "1" : "0");
   var url = "nresultdb.php?userid="+uid+"&chkYesNo="+chk;
   if(window.XMLHttpRequest) {
      req = new XMLHttpRequest();
   } else if(window.ActiveXObject) {
      req = new ActiveXObject("Microsoft.XMLHTTP");
   }
   // Use get instead of post.
   req.open("GET", url, true);
   req.send(null);
}
</script>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
        
        
        
        
        
        
      
          </div>


          <!-- This is sidebar code to make it pretty, needs to removed to bettwr fit the theme -->
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
