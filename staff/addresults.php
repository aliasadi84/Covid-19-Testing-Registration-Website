<?php
session_start();
include_once '../assets/conn/dbconnect.php';
if(!isset($_SESSION['staffSession']))
{
//if not logged into the staff side it will direct you to the stafflogin.php
header("Location: ../stafflogin.php");
}
$usersession = $_SESSION['staffSession'];
//Getting the staff detail.
$res=mysqli_query($con,"SELECT * FROM staff WHERE icstaff = '$usersession'");
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
<!--The header of the add result page, which contains the logo of WCHC clinic. The link is directed to the
the WCHC Clinic Staff Dashboard-->
<header>
    <div class="hero-image">
        <a href="doctordashboard.php"><img src="../assets/pp.png" width="50%"></a>
    </div>
</header>
<!--end of the header-->

<body>
  <!--Top navigation with all links to the staff side-->
    <ul>
      <li><a href="doctordashboard.php">Dashboard</a></li>
      <li><a class="active" href="addresults.php">Add Result</a></li>
      <li><a href="patientlist.php">Patient List</a></li>
      <li><a href="doctorprofile.php">Your Account</a></li>
      <li style="float:right"><a href="logout.php?logout">Log Out</a></li>
    </ul>
   <!--End of top navigation--> 
  <section class="home-section">
            
            <table>
                <thead>
                <th colspan="7"><h2>Add Results</h2></th>
                <!--Table heading-->
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Positive</th>
                        <th>Negative</th>
                    </tr>
                    <!--End of table heading-->
                </thead>
                <tbody>
                
                
               <!-- Below code is populating the bookings with the status of 'result entered' and 'sample collected'-->
                <?php 
                $res=mysqli_query($con,"SELECT a.*, b.*
                                        FROM patient a
                                        JOIN bookings b
                                        On a.icPatient = b.username
                                        WHERE b.status = 'sample collected'
                                        OR b.status = 'result entered'
                                        Order By date desc");
                      //Error checking if the data couldn't be pulled                  
                      if (!$res) {
                        printf("Error: %s\n", mysqli_error($con));
                        exit();
                    }
                $cal= 0; //variable set to differentiate the 'radio button name' to allow multiple result to be entered in a streatch.
                //while loop to list out each row of the table with relevant details.
                while ($appointment=mysqli_fetch_array($res)) {
                    
                
                  //code to block all the 'result entered' from entering a new result.  
                  if ($appointment['status']=='sample collected') {
                        $status="danger";
                        $icon='remove';
                        $checked='';

                    } else {
                        $status="success";
                        $icon='ok';
                        $checked = 'disabled';
                    }
                    $cal= $cal+1;//'$cal' is incremented evry time the while loop loops back.
                    // Displaying the data
                    echo "<tr>";
                        echo "<td>" . $appointment['patientFirstName'] . "</td>";
                        echo "<td>" . $appointment['patientLastName'] . "</td>";
                        echo "<td>" . date('m/d/Y', strtotime($appointment['date'])) . "</td>";
                        echo "<td>" . $appointment['timeslot'] . "</td>";
                        echo "<td>" . $appointment['status'] . "</td>";
                        echo "<form method='POST'>";
                        // '$cal' is used here to have a different name and id during every loop.
                        echo "<td ><input type='radio' name='enable".$cal."' id='enable".$cal."' value='".$appointment['id']."' onclick='chkit(".$appointment['id'].",this.checked);' ".$checked."></td>";
                        echo "<td ><input type='radio' name='enable".$cal."' id='enable".$cal."' value='".$appointment['id']."' onclick='chki(".$appointment['id'].",this.checked);' ".$checked."></td>";
                    echo "</tr>";
                    
                } 
            echo "</tbody>";
            echo "</table>";
            echo "<div>";
            echo "<div>";
            echo "<button class='button2' type='submit' value='Submit' name='submit'>Update</button>";
            echo "</div>";
            echo "</div>";
            ?>
  </section>


<script type="text/javascript">

//takes all the inputs from the radio button, send to resultdb.php to enter the positive result.
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

//takes all the inputs from the radio button, send to nresultdb.php to enter the negetive results.
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

    </body>
</html>
