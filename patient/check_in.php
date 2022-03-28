<?php
//creating the session
      session_start();
      include_once '../assets/conn/dbconnect.php';

      if(!isset($_SESSION['patientSession']))
      {
      header("Location: ../index.php");
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
      // mysqli_query("UPDATE blogEntry SET content = $udcontent, title = $udtitle WHERE id = $id");
      $update=mysqli_query($con,"UPDATE bookings SET status='checked-in', location='$location', make='$make', color='$color', plate='$plate' WHERE id = '$app'");
      // $userRow=mysqli_fetch_array($res);
      }

   }
?>
<!DOCTYPE HTML>
<html> 
<head>  
<script type="text/javascript">
function CheckColors(val){
 var element=document.getElementById('color');
 if(val=='pick a color'||val=='Other')
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
    <script src="https://kit.fontawesome.com/95c473646d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/submit.css">
    <link rel="stylesheet" href="../assets/css/table.css">
    <link rel="stylesheet" href="../assets/css/input.css">
</head>

<header>
    <div class="hero-image">
        <a href="patient.php"><img src="../assets/pp.png" width="50%"></a>
    </div>
</header>

<body>
  <section>
  <div class="bf">

  <h3>Check-In</h3>

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
          echo "<td>" . $appointment['date'] . "</td>";
          echo "<td>" . $appointment['timeslot'] . "</td>";
          echo "<form method='POST'>";

      
      } 
          echo "</tr>";
      echo "</tbody>";
      echo "</table>";
      ?>

      <h3>Help Us Find You!</h3>

      <!--Inputs form for the car details starts here-->
      <h2>Parking</h2>
      
      <div class="parking">
        <img class="responsive" src="assets/img/draw.jpg" width="100%" height="auto">
      </div>
  
      <label for="location">Location:</label>
      <select name="location" id="location">
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
        <option value="E">E</option>
        <option value="F">F</option>
        <option value="G">G</option>
        <option value="H">H</option>
      </select><br>
      
        <h2>Car</h2>
        <input type="select" id="car" name="make" placeholder="Car Type"><br><br>
        <select name="color" id="carcolor" onchange='CheckColors(this.value);'>
        <option value="White">White</option>
        <option value="Black">Black</option>
        <option value="Silver">Silver</option>
        <option value="Red">Red</option>
        <option value="Blue">Blue</option>
        <option value="Other">Other (Type Below)</option>
        </select>
        <input type="text" name="color" id="color" style='display:none;'/><br><br>

      <h2>License Plate: </h2>
      <input type="text" id="plate" name="plate" placeholder="Plate Number"><br>
    


  </div>
  <!--input for the car details end here-->

</section>

<br>
<!--when clicked the submit button it sends the input of the car information to the php at the top inorder for it to be entered to the database-->
<button class='button2' type='submit' value='Submit' name='submit'>Check In</button>

</form>

</body>
</html>
