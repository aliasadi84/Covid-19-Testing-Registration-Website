<?php
//connection to the database
session_start();
include_once '../assets/conn/dbconnect.php';

if(!isset($_SESSION['patientSession']))
{
//if not logged into the staff side it will direct you to the index.html
header("Location: ../index.html");
}
//patient username is stored into the variable '$session'
$session= $_SESSION['patientSession'];

//gets the date and time of the appointment
if (isset($_GET['date']) && isset($_GET['timeslot'])) {
	$date =$_GET['date'];
	$timeslot = $_GET['timeslot'];
}

if (isset($_POST['appointment'])) {
//to check if the appointment slot is already taken
$check = mysqli_query($con,"SELECT * FROM bookings WHERE date ='$date' AND timeslot='$timeslot'");
$row = mysqli_num_rows($check);
if ($row > 0) {
	echo '<script>';
	echo 'alert("A appointment exists for the given timeslot, please choose another timeslot!");';
	echo 'window.location.href = "appo.php";';
	echo '</script>';

	die();
} else {
//gets the input of question 2
$isolating = mysqli_real_escape_string($con,$_POST['isolating']);
//gets the input of question 3
$contact = mysqli_real_escape_string($con,$_POST['contact']);
//gets the input of question 4
$travel = mysqli_real_escape_string($con,$_POST['travel']);
//gets the input of question 5
$vaccinated = mysqli_real_escape_string($con,$_POST['vaccinated']);
//status variable is set to 'appointment booked'
$status = "appointment booked";
//gets the input of question 1 taking into symptom checkbox inputs
$checkbox1=$_POST['symp'];  
$chk="";
 //below code to get the inputs for the checkbox
foreach($checkbox1 as $chk1)  
   {  
      $chk .= $chk1.",";  
   }  

if($in_ch==1)  
   {  
      echo'<script>alert("Inserted Successfully")</script>';  
   }  

else  
   {  
      echo'<script>alert("Failed To Insert")</script>';  
   }
//all the data collected from the form is enterd into the database
$query = "INSERT INTO bookings (  username , symp, isolating , contact , travel , vaccinated, status, date, timeslot)
VALUES ( '$session', '$chk', '$isolating', '$contact', '$travel', '$vaccinated', '$status', '$date', '$timeslot') "; 


$result = mysqli_query($con,$query);
//error handeling
if( $result )
{
?>
<script type="text/javascript">
alert('Appointment made successfully.');
</script>
<?php
//if the appointment is made the page directs to appointment confimation page
header("Location: appconfirmation.php?&date=$date&timeslot=$timeslot");
}
else
{
?>
<script type="text/javascript">
alert('Appointment booking fail. Please try again.');
</script>
<?php
header("Location: appo.php");
}
}
}
?>
<!DOCTYPE HTML>

<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<!--css design files-->
    <script src="https://kit.fontawesome.com/95c473646d.js" crossorigin="anonymous"></script>
	<!--fontawesome link that connects fontawesome with the page-->
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/button.css">
	<link rel="stylesheet" href="../assets/css/submit.css">
	<link rel="stylesheet" href="../assets/css/table.css">
	<link rel="stylesheet" href="../assets/css/input.css">
	<!--end of css design files-->
</head>
<!--The header of the appointment page, which contains the logo of WCHC clinic. The link is directed to the
the WCHC Clinic Staff Dashboard-->
<header>
    <div class="hero-image">
        <a href="patient.php"><img src="../assets/pp.png" width="50%"></a>
    </div>
</header>
<!--end of the header-->

<header>
	<h1>Appointment</h1>
</header>
    
        
<body>
  <section>
    <div class="bf">
	<form class="form" role="form" method="POST" accept-charset="UTF-8">
		<div>Appointment Information</div>
		<!--prints out the details of the appointment chosen-->
		<div>
			Date: <?php echo date('F d, Y', strtotime($date)); ?><br>
			Time: <?php echo $timeslot ?><br>
		</div>
		<!--covid-19 questionaire starts here-->

			
		
			<p>1. Regardless of your vaccination status, have
				you experienced any of the symptoms in
				the list below in the past 48 hours?</p>
			
			
				<div class="uniAlign">
				<input type="checkbox" class= "largerCheckbox" id="symptom1" name="symp[]" value="fever or chills">
				<label for="symptom1"> Fever or chills</label><br>
				<input type="checkbox" class= "largerCheckbox" id="symptom2" name="symp[]" value="cough">
				<label for="symptom2"> Cough</label><br>
				<input type="checkbox" class= "largerCheckbox" id="symptom3" name="symp[]" value="shortness of breath or difficulty breathing">
				<label for="symptom3"> Shortness of breath or difficulty breathing</label><br>
				<input type="checkbox" class= "largerCheckbox" id="symptom4" name="symp[]" value="fatigue">
				<label for="symptom4"> Fatigue</label><br>
				<input type="checkbox" class= "largerCheckbox" id="symptom5" name="symp[]" value="muscle or body aches">
				<label for="symptom5"> Muscle or body aches</label><br>
				<input type="checkbox" class= "largerCheckbox" id="symptom6" name="symp[]" value="headache">
				<label for="symptom6"> Headache</label><br>
				<input type="checkbox" class= "largerCheckbox" id="symptom7" name="symp[]" value="new loss of taste or smell">
				<label for="symptom7"> New loss of taste or smell</label><br>
				<input type="checkbox" class= "largerCheckbox" id="symptom8" name="symp[]" value="sore throat">
				<label for="symptom8"> Sore throat</label><br>
				<input type="checkbox" class= "largerCheckbox" id="symptom9" name="symp[]" value="congestion or runny nose">
				<label for="symptom9"> Congestion or runny nose</label><br>
				<input type="checkbox" class= "largerCheckbox" id="symptom10" name="symp[]" value="nausea or vomiting">
				<label for="symptom10"> Nausea or vomiting</label><br>
				<input type="checkbox" class= "largerCheckbox" id="symptom11" name="symp[]" value="diarrhea">
				<label for="symptom11"> Diarrhea</label><br>
				</div>

			<p>2. Are you isolating or quarantining because you
			tested positive for COVID-19 or are worried
			that you may be sick with COVID-19?</p>
			
			?? <input type="radio" class= "largerRadio" id="yes_isolating" name="isolating" value="yes" required>
			?? <label for="yes_isolating"> Yes</label><br>
			?? <input type="radio" class= "largerRadio" id="no_isolating" name="isolating" value="no">
			?? <label for="no_isolating"> No</label><br>
			
		
			<p>3. Have you been in close physical contact in the last 14 days with someone who has tested positive for COVID-19?</p>
			 
			?? <input type="radio" class= "largerRadio" id="yes_contact" name="contact" value="yes" required>
			?? <label for="yes_contact"> Yes</label><br>
			?? <input type="radio" class= "largerRadio" id="no_contact" name="contact" value="no">
			?? <label for="no_contact"> No</label><br>
			
		

			<p>4. Have you traveled in the past 10 days?</p>
			
			?? <input type="radio" class= "largerRadio" id="yes_travel" name="travel" value="yes" required>
			?? <label for="yes_travel"> Yes</label><br>
			?? <input type="radio" class= "largerRadio" id="no_travel" name="travel" value="no">
			?? <label for="no_travel"> No</label><br>
			



			<p>5. Are you vaccinated for COVID-19?</p>
			?? <input type="radio" class= "largerRadio" id="yes_vaccinated" name="vaccinated" value="yes" required>
			?? <label for="yes_vaccinated"> Yes</label><br>
			?? <input type="radio" class= "largerRadio" id="no_vaccinated" name="vaccinated" value="no">
			?? <label for="no_vaccinated"> No</label><br><br>

		<!--Covid-19 questionaire ends-->
        <!--when the submit button is clicked the input will be sent to the php at the top to be entered to the database-->
	
		<input type="submit" name="appointment" id="submit" value="Create Appointment">

	</form>
	</div>
	
</section>
<br>
  
</body>
</html>
