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
  <input type="text" name="search" id="search" placeholder="Search..." />         
  <h4 style="text-align:center;">Add Results</h4> 
  <table class="table-sortable">
                <thead>
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
                        echo '<script>';
                        echo 'alert("No data have been stored to enter result");';
                        echo 'window.location.href = "addresults.php";';
                        echo '</script>';
                    
                        die();
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
function chkit(uid, chk) 
{
  //takes all the inputs from the radio button, send to resultdb.php to enter the positive result.
  var confirmAction = confirm("Are you sure you want to select a positive test reusult?");
  if (confirmAction === true)
  {
   
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
  else {
    alert("No result has been selected");
    
  }
  return confirmAction;
}

//takes all the inputs from the checkbox, send to nresultdb.php to enter the negetive results
function chki(uid, chk) 
{   
  var confirmAction = confirm("Are you sure you want to select a negative test reusult?");
  if (confirmAction === true)
   {
    chk = (chk==true ? "1" : "0");
   var url = "nresultdb.php?userid="+uid+"&chkYesNo="+chk;
   if(window.XMLHttpRequest) 
   {
      req = new XMLHttpRequest();
   } else if(window.ActiveXObject) 
   {
      req = new ActiveXObject("Microsoft.XMLHTTP");
   }
   // Use get instead of post.
   req.open("GET", url, true);
   req.send(null);
  }
  else{
    alert("No result has been selected");
  }
  return confirmAction;
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
