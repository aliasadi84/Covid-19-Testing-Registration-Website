<?php
session_start();
include_once '../assets/conn/dbconnect.php';
if(!isset($_SESSION['staffSession']))
{
//if not logged into the staff side it will direct you to the stafflogin.php
header("Location: ../stafflogin.php");
}
$usersession = $_SESSION['staffSession'];
//Checking the staff ID making sure it's still there
$res=mysqli_query($con,"SELECT * FROM staff WHERE icstaff = '$usersession'");
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);


//html needs to be redone
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <script src="https://kit.fontawesome.com/95c473646d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/button.css">
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
      <li><a class="active" href="doctordashboard.php">Dashboard</a></li>
      <li><a href="addresults.php">Add Result</a></li>
      <li><a href="patientlist.php">Patient List</a></li>
      <li><a href="doctorprofile.php">Your Account</a></li>
      <li style="float:right"><a href="logout.php?logout">Log Out</a></li>
    </ul>
  <section>
            <table>
                <thead>
                <th colspan="9"><h2>Appointment List</h2></th>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <!--<th>Contact No.</th>
                        <th>Email</th>-->
                        <th>Date</th>
                        <th>Location</th>
                        <th>Car Type</th>
                        <th>Car Color</th>
                        <th>Time Slot</th>
                        <th>Status</th>
                        <th>Complete</th>
                    </tr>
                </thead>
              
                
                
               <!-- Below code is populating the appointment table -->
               <!-- First code block is pulling the data and comparing the data -->
                <?php 
                $res=mysqli_query($con,"SELECT a.*, b.*
                                        FROM patient a
                                        JOIN bookings b
                                        On a.icPatient = b.username
                                        Order By id desc");
                      if (!$res) {
                        printf("Error: %s\n", mysqli_error($con));
                        exit();
                    }
                while ($appointment=mysqli_fetch_array($res)) {
                    
                
                  //code for the check in box    
                  if ($appointment['status']=='checked-in') {
                        $status="danger";
                        $icon='remove';
                        $checked='';

                    } else {
                        $status="success";
                        $icon='ok';
                        $checked = 'disabled';
                    }
                    // Displaying the data, 
                    echo "<tbody>";
                    echo "<tr>";
                        echo "<td>" . $appointment['patientFirstName'] . "</td>";
                        echo "<td>" . $appointment['patientLastName'] . "</td>";
                        /*echo "<td>" . $appointment['patientPhone'] . "</td>";
                        echo "<td>" . $appointment['patientEmail'] . "</td>";*/
                        echo "<td>" . date('m/d/Y', strtotime($appointment['date'])) . "</td>";
                        echo "<td>" . $appointment['location'] . "</td>";
                        echo "<td>" . $appointment['make'] . "</td>";
                        echo "<td>" . $appointment['color'] . "</td>";
                        echo "<td>" . $appointment['timeslot'] . "</td>";
                        echo "<td>" . $appointment['status'] . "</td>";
                        echo "<form method='POST'>";
                        echo "<td ><input type='checkbox' name='enable' id='enable' value='".$appointment['id']."' onclick='chkit(".$appointment['id'].",this.checked);' ".$checked."></td>";

                    
                } 
                    echo "</tr>";
                echo "</tbody>";
            echo "</table>";
            echo "<div>";
            echo "<div>";
            echo "<button class='button2' type='submit' value='Submit' name='submit'>Update</button>";
            echo "</div>";
            echo "</div>";
            ?>
  </section>
                    <!-- panel end -->

<!-- takes all the inputs from the checkbox, send to checkdatabase.php -->
<script type="text/javascript">
function chkit(uid, chk) {
   chk = (chk==true ? "1" : "0");
   var url = "checkdb.php?userid="+uid+"&chkYesNo="+chk;
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
