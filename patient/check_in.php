<?php
      session_start();
      include_once '../assets/conn/dbconnect.php';

      if(!isset($_SESSION['patientSession']))
      {
      header("Location: ../index.php");
      }
      $today = date('Y-m-d');
      $statue = 'process';
      $usersession = $_SESSION['patientSession'];
      $res=mysqli_query($con,"SELECT * FROM patient WHERE icPatient = '$usersession'");
      $userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);

?>

<?php
      $res = mysqli_query($con, "SELECT a.*, b.*,c.*
      FROM patient a
      JOIN appointment b
      On a.icPatient = b.patientIc
      JOIN doctorschedule c
      On b.scheduleId=c.scheduleId
      WHERE b.patientIc ='$usersession'
      AND c.scheduleDate= '$today'
      AND b.status= '$statue'");

    if (!$res) {
      printf("Error: %s\n", mysqli_error($con));
      exit();
    }

    while ($appointment=mysqli_fetch_array($res)) {
      $app = $appointment['appId'];
    
      if (isset($_POST['submit'])) {
      //variables
      $location = $_POST['location'];
      $make = $_POST['make'];
      $color = $_POST['color'];
      $plate = $_POST['plate'];
      // mysqli_query("UPDATE blogEntry SET content = $udcontent, title = $udtitle WHERE id = $id");
      $update=mysqli_query($con,"UPDATE appointment SET status='checked-in', location='$location', make='$make', color='$color', plate='$plate' WHERE appId = '$app'");
      // $userRow=mysqli_fetch_array($res);
      }

   }
?>
<!DOCTYPE HTML>

<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
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
    <script src="https://kit.fontawesome.com/95c473646d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="assets/css/submit.css">
</head>

<header>
    <div class="hero-image">
        <a href="patient.php" ><img src="assets/img/pp.png" width="100%"></a>
    </div>
</header>

<body>
  <section>
  <div class="bf">

  <h3>Check-In</h3>

  <table>
  <thead>
      <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Contact No.</th>
          <th>Email</th>
          <th>Day</th>
          <th>Date</th>
          <th>Start</th>
          <th>End</th>
          <th>Status</th>
          <th>Complete</th>
      </tr>
  </thead>

  <?php 
        $res = mysqli_query($con, "SELECT a.*, b.*,c.*
        FROM patient a
        JOIN appointment b
        On a.icPatient = b.patientIc
        JOIN doctorschedule c
        On b.scheduleId=c.scheduleId
        WHERE b.patientIc ='$usersession'
        AND c.scheduleDate= '$today'
        AND b.status= '$statue'");
        if (!$res) {
          printf("Error: %s\n", mysqli_error($con));
          exit();
      }
      while ($appointment=mysqli_fetch_array($res)) {
      
      if ($appointment['status']=='process') {
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
          echo "<td>" . $appointment['patientFirstName'] . "</td>";
          echo "<td>" . $appointment['patientLastName'] . "</td>";
          echo "<td>" . $appointment['patientPhone'] . "</td>";
          echo "<td>" . $appointment['patientEmail'] . "</td>";
          echo "<td>" . $appointment['scheduleDay'] . "</td>";
          echo "<td>" . $appointment['scheduleDate'] . "</td>";
          echo "<td>" . $appointment['startTime'] . "</td>";
          echo "<td>" . $appointment['endTime'] . "</td>";
          echo "<td>" . $appointment['status'] . "</td>";
          echo "<form method='POST'>";

      
      } 
          echo "</tr>";
      echo "</tbody>";
      echo "</table>";
      ?>

      <h2>Instruction: </h2>
      <p>Help Us Find You!</p>
      
      <h2>Parking</h2>
      <img src="assets/img/draw.jpg" width="800px" height="400px"><br><br>
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
      </select><br><br>
      
     <div id="vehicle" class="info">
        <h2>Car</h2>
        <input type="text" id="car" name="make" value="Car Type"><br><br>
        <select name="color" id="carcolor">
        <option value="Red">Red</option>
        <option value="Orange">Orange</option>
        <option value="Yellow">Yellow</option>
        <option value="Green">Green</option>
        <option value="Blue">Blue</option>
        <option value="Purple">Purple</option>
        </select><br><br>

      <h2>License Plate: </h2>
      <input type="text" id="plate" name="plate" value="Plate Number"><br><br>
    
     </div>

  </div>

</section>

<br>
<button class='button2' type='submit' value='Submit' name='submit'>Update</button>

</form>

</body>
</html>