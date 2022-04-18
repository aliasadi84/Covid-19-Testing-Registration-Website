<?php

  session_start();
  //connection to the database
  include_once '../assets/conn/dbconnect.php';

  if(!isset($_SESSION['patientSession']))
  {
  //if not logged into the patient side it will direct you to the index.php
  header("Location: ../index.html");
  }
  
  date_default_timezone_set('America/New_York');
  $today = date('Y-m-d');
  $statue = 'appointment booked';
  $usersession = $_SESSION['patientSession'];
  $res=mysqli_query($con,"SELECT * FROM patient WHERE icPatient = '$usersession'");
  $userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);

?>

<?php
//checking the appointments that have been made for that day
      $res = mysqli_query($con, "SELECT a.*, b.*
      FROM patient a
      JOIN bookings b
      On a.icPatient = b.username
      WHERE b.username ='$usersession'
      AND b.date= '$today'
      AND b.status= '$statue'");

    if (!$res) {
      printf("Error: %s\n", mysqli_error($con));
      exit();
    }

    //inputting car information into the database
    while ($appointment=mysqli_fetch_array($res)) {
      $app = $appointment['id'];
    
      if (isset($_POST['submit'])) {
      //variables
      $location = $_POST['location'];
      $make = $_POST['make'];
      $color = $_POST['color'];
      $plate = $_POST['plate'];
      date_default_timezone_set('America/Detroit');
      //current time of the day
      $present_time = date('H:i');
      //gets the appointment slots from database
      $timeslots = $appointment['timeslot'];
      //gets the start time be it's format
      $newA = current(explode(" ", $timeslots));
      //format the time in military time
      $time_in_24_hour_format  = date('H:i', strtotime("$newA"));
      //the start time limit 15 minute before the start time of the appointment
      $start = strtotime("-15 minutes", strtotime($time_in_24_hour_format));
      $start = date('H:i', $start);
      //the start time limit 5 minute after the start time of the appointment
      $end = strtotime("+5 minutes", strtotime($time_in_24_hour_format));
      $end = date('H:i', $end);
      //the colon is taken off to make it a number.
      $present_time  = str_replace(array(':'), '',$present_time);
      $start = str_replace(array(':'), '',$start);
      $end = str_replace(array(':'), '',$end);
      //if-else statement to limit the appointment to be only checked-in during 15 minutes before and 5 minutes afte appointment start time.
      if ($present_time >= $start && $present_time <= $end){
      $update=mysqli_query($con,"UPDATE bookings SET status='checked-in', location='$location', make='$make', color='$color', plate='$plate' WHERE id = '$app'");
      header("Location: checkinconf.html");
      }
      }

   }
?>
<!DOCTYPE HTML>
<html> 
<head>  
<script type="text/javascript">
function CheckColors(val){
 var element=document.getElementById('carcolor');
 if(val=='Other')
   element.style.display='block';
 else  
   element.style.display='none';
}

</script> 
</head>
</html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <!--css design files-->
    <script src="https://kit.fontawesome.com/95c473646d.js" crossorigin="anonymous"></script>
    <!--fontawesome link that connects fontawesome with the page-->
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/button.css">
    <link rel="stylesheet" href="../assets/css/table.css">
    <link rel="stylesheet" href="../assets/css/input.css">
    <!--end of css design files-->
</head>
<!--The header of the check_in page, which contains the logo of WCHC clinic. The link is directed to the
Main Page of the WCHC Clinic Website-->
<header>
    <div class="hero-image">
        <a href="patient.php"><img src="../assets/pp.png" width="50%"></a>
    </div>
</header>
<!--end of the header-->
<body>
  <div class="bf">

  <h3>Check-In</h3>
  <h5>You will not be able to check in if you don't have an appointment scheduled today.</h5>

  <table>
  <thead>
      <tr>
          <th>Date</th>
          <th>Time</th>
      </tr>
  </thead>
  <!--php below populates the information of the appointment that needs to be checked-in-->
  <?php 
        $res = mysqli_query($con, "SELECT a.*, b.*
        FROM patient a
        JOIN bookings b
        On a.icPatient = b.username
        WHERE b.username ='$usersession'
        AND b.date = '$today'
        AND b.status = '$statue'");
        if (!$res) {
          printf("Error: %s\n", mysqli_error($con));
          exit();
      }
      while ($appointment=mysqli_fetch_array($res)) {
      date_default_timezone_set('America/Detroit');
      $present_time = date('H:i');
      $timeslots = $appointment['timeslot'];
      $newA = current(explode(" ", $timeslots));
      $time_in_24_hour_format  = date('H:i', strtotime("$newA"));
      $start = strtotime("-15 minutes", strtotime($time_in_24_hour_format));
      $start = date('H:i', $start);
      $end = strtotime("+5 minutes", strtotime($time_in_24_hour_format));
      $end = date('H:i', $end);
      $present_time  = str_replace(array(':'), '',$present_time);
      $start = str_replace(array(':'), '',$start);
      $end = str_replace(array(':'), '',$end);
      if ($present_time >= $start && $present_time <= $end){
      if ($appointment['status']=='appointment booked') {
          $status="danger";
          $icon='remove';
          $checked='';

      } else {
          $status="success";
          $icon='ok';
          $checked = 'disabled';
      }
      echo "<tbody>";
      echo "<tr>";
          //appointment details is populated
          echo "<td>" . date('F d, Y', strtotime($appointment['date'])) . "</td>";
          echo "<td>" . $appointment['timeslot'] . "</td>";
          echo "<form method='POST'>";

      
      
      }} 
          echo "</tr>";
      echo "</tbody>";
      echo "</table>";
      ?>

      <h3>Help Us Find You!</h3>

      <!--Inputs form for the car details starts here-->
        <h2>Parking</h2>
      
      <div class="parking">
        <img class="responsive" src="../assets/draw.png" width="100%" height="auto">
      </div>
  
      <label for="location">Location:</label>
      <select name="location" id="location">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
        <option value="24">24</option>
        <option value="25">25</option>
        <option value="26">26</option>
        <option value="27">27</option>
        <option value="28">28</option>
        <option value="29">29</option>
        <option value="30">30</option>
        <option value="30">31</option>
      </select><br>
      
        <h2>Car</h2>
        <input type="text" id="car" name="make" placeholder="Car Type"><br><br>

        <select name="color" id="color" onchange='CheckColors(this.value);'>
        <option default selected disabled>Car Color</option>
        <option value="White">White</option>
        <option value="Black">Black</option>
        <option value="Silver">Silver</option>
        <option value="Red">Red</option>
        <option value="Blue">Blue</option>
        <option value="Other">Other (Type Below)</option>
        </select>
        <input type="text" name="color" id="carcolor" style='display:none;'/><br><br>

      <h2>License Plate</h2>
      <input type="text" id="plate" name="plate" placeholder="Plate Number">
  </div>
  <!--input for the car details end here-->
<!--when clicked the submit button it sends the input of the car information to the php at the top inorder for it to be entered to the database-->
<button class='button2' type='submit' value='Submit' name='submit'>Check In</button>
<h2></h2>
</form>

</body>
</html>
