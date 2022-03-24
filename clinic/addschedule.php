<?php
session_start();
include_once '../assets/conn/dbconnect.php';
if(!isset($_SESSION['doctorSession']))
{
//if not logged into the admin side it will direct you to the index
header("Location: ../index.php");
}
$usersession = $_SESSION['doctorSession'];
$res=mysqli_query($con,"SELECT * FROM doctor WHERE doctorId=".$usersession);
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);
// insert




if (isset($_POST['submit'])) {
//date of the month
//inputting the date into the database
$date = mysqli_real_escape_string($con,$_POST['date']);
//Start time
//inputting the date into the database
$starttime     = mysqli_real_escape_string($con,$_POST['starttime']);
//end time inputting the data into the database
$endtime     = mysqli_real_escape_string($con,$_POST['endtime']);
//Checking to make sure if it's avaliable or not
$bookavail         = mysqli_real_escape_string($con,$_POST['bookavail']);

//Inserting the data into the daabase
$query = " INSERT INTO doctorschedule (  scheduleDate, startTime, endTime,  bookAvail)
VALUES ( '$date', '$starttime', '$endtime', '$bookavail' ) ";

$result = mysqli_query($con, $query);


//error handeling 
if( $result )
{
?>
<script type="text/javascript">
alert('Schedule added successfully.');
</script>
<?php
}
else
{
?>
<script type="text/javascript">
alert('Added fail. Please try again.');
</script>
<?php
}

}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <style>
      


      /* The main table and it's css */
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
           <div class="name_job">

           </div>
         </div>
         <a href="logout.php?logout"><i class='bx bx-log-out' id="log_out" ></i></a>
     </li>
    </ul>
  </div>
  <section class="home-section">

                           <h2>Clinic Schedule</h2>

                            <h3 class="panel-title">Add Schedule</h3>
                        </div>

                <!-- The buttons on the top of the table -->
                <form class="form-horizontal" method="post">
                    <label>Date</label>
                    <input id="date" name="date" type="date" required/>

                     <label>Start Time</label>
                    <input id="starttime" name="starttime" type="time" required/>
                    <label>End Time</label>
                    <input id="endtime" name="endtime" type="time" required/>
                    <label>Availabilty</label>
                    <select  id="bookavail" name="bookavail" required>
                    <option value="available">
                        available
                    </option>
                    </select>
                                   <button class="btn btn-primary " name="submit" type="submit">
                                    Submit
                                   </button>

                                </form>
                

                            <h3>List of Appointments</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>scheduleId</th>
                                    <th>scheduleDate</th>
                                    <th>scheduleDay</th>
                                    <th>startTime</th>
                                    <th>endTime</th>
                                    <th>bookAvail</th>
                                </tr>
                            </thead>
                            




                            <!-- Pulling and displaying the data from the database -->
                            <?php 
                            $result=mysqli_query($con,"SELECT * FROM doctorschedule");
                            

                 
                            while ($doctorschedule=mysqli_fetch_array($result)) {
                                
                              
                                echo "<tbody>";
                                echo "<tr>";
                                    echo "<td>" . $doctorschedule['scheduleId'] . "</td>";
                                    echo "<td>" . $doctorschedule['scheduleDate'] . "</td>";
                                    echo "<td>" . $doctorschedule['scheduleDay'] . "</td>";
                                    echo "<td>" . $doctorschedule['startTime'] . "</td>";
                                    echo "<td>" . $doctorschedule['endTime'] . "</td>";
                                    echo "<td>" . $doctorschedule['bookAvail'] . "</td>";
                                    echo "<form method='POST'>";
                                    echo "<td >
                            </td>";
                               
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





<!-- Code to make the sidebar pretty, needs to be removed to be more on theme -->
</section>
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