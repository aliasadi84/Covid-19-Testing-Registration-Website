<?php
session_start();
include_once '../assets/conn/dbconnect.php';
if(!isset($_SESSION['doctorSession']))
{
//if not logged into the admin side it will direct you to the index
header("Location: ../index.html");
}
$usersession = $_SESSION['doctorSession'];
//Checking the doctor ID making sure it's still there
$res=mysqli_query($con,"SELECT * FROM doctor WHERE doctorId=".$usersession);
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
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
<!--The header of the admin dashboard page, which contains the logo of WCHC clinic. The link is directed to the
the WCHC Clinic Admin Dashboard-->
<header>
    <div class="hero-image">
        <a href="doctordashboard.php"><img src="../assets/pp.png" width="50%"></a>
    </div>
</header>
<!--end of the header-->
<body>
    <!--Top navigation with all links to the staff side-->
    <ul>
      <li><a class="active" href="doctordashboard.php">Dashboard</a></li>
      <li><a href="addresults.php">Add Result</a></li>
      <li><a href="patientlist.php">Patient List</a></li>
      <li><a href="staff.php">Staff List</a></li>
      <li><a href="doctorprofile.php">Your Account</a></li>
      <li style="float:right"><a href="logout.php?logout">Log Out</a></li>
    </ul>
    <!--End of top navigation-->
  <section>
        <input type="text" name="search" id="search" placeholder="Search..." />
        <h4 style="text-align:center;">Appointment List</h4> 
            <table class="table-sortable">
                <thead>
                <!--Table heading-->
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date</th>
                        <th>Location</th>
                        <th>Car Type</th>
                        <th>Car Color</th>
                        <th>Time Slot</th>
                        <th>Status</th>
                        <th>Complete</th>
                    </tr>
                <!--End of table heading-->
                </thead>
              
                <!-- Below code is populating the bookings with the status of 'appointment booked' and 'checked-in' -->
                <?php 
                $res=mysqli_query($con,"SELECT a.*, b.*
                                        FROM patient a
                                        JOIN bookings b
                                        On a.icPatient = b.username
                                        WHERE b.status = 'checked-in'
                                        OR b.status = 'appointment booked'
                                        Order By date desc");
                    //Error checking if the data couldn't be pulled
                    if (!$res) {
                        echo '<script>';
                        echo 'alert("No data have been stored for appointments");';
                        echo 'window.location.href = "addresults.php";';
                        echo '</script>';
                    
                        die();
                    }
                echo "<tbody>";
                //while loop to list out each row of the table with relevant details.
                while ($appointment=mysqli_fetch_array($res)) {
                    
                
                  //code to block all the 'appointment booked' from being their status changed to sample collected.     
                  if ($appointment['status']=='checked-in') {
                        $status="danger";
                        $icon='remove';
                        $checked='';

                    } else {
                        $status="success";
                        $icon='ok';
                        $checked = 'disabled';
                    }
                    // Displaying the data.
                    echo "<tr>";
                        echo "<td>" . $appointment['patientFirstName'] . "</td>";
                        echo "<td>" . $appointment['patientLastName'] . "</td>";
                        echo "<td>" . date('m/d/Y', strtotime($appointment['date'])) . "</td>";
                        echo "<td>" . $appointment['location'] . "</td>";
                        echo "<td>" . $appointment['make'] . "</td>";
                        echo "<td>" . $appointment['color'] . "</td>";
                        echo "<td>" . $appointment['timeslot'] . "</td>";
                        echo "<td>" . $appointment['status'] . "</td>";
                        echo "<form method='POST'>";
                        echo "<td ><input type='checkbox' name='enable' id='enable' value='".$appointment['id']."' onclick='chkit(".$appointment['id'].",this.checked);' ".$checked."></td>";
                    echo "</tr>";
                    
                } 
            echo "</tbody>";
            echo "</table>";
            echo "<div>";
            echo "<button class='button2' type='submit' value='Submit' name='submit'>Update</button>";
            echo "</div>";
            ?>
  </section>

<!-- takes all the inputs from the checkbox, send to checkdb.php -->
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
