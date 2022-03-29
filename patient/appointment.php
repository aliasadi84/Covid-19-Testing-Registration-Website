<?php
session_start();
include_once '../assets/conn/dbconnect.php';
$session= $_SESSION['patientSession'];

if (isset($_GET['date']) && isset($_GET['timeslot'])) {
	$date =$_GET['date'];
	$timeslot = $_GET['timeslot'];
}


	
//The survey answers into the database
if (isset($_POST['appointment'])) {
$isolating = mysqli_real_escape_string($con,$_POST['isolating']);
$contact = mysqli_real_escape_string($con,$_POST['contact']);
$travel = mysqli_real_escape_string($con,$_POST['travel']);
$vaccinated = mysqli_real_escape_string($con,$_POST['vaccinated']);
$status = "appointment booked";
$checkbox1=$_POST['symp'];  
$chk="";
 
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
$query = "INSERT INTO bookings (  username , symp, isolating , contact , travel , vaccinated, status, date, timeslot)
VALUES ( '$session', '$chk', '$isolating', '$contact', '$travel', '$vaccinated', '$status', '$date', '$timeslot') "; 




//email needs to be connected, Salem part imma do that soon
$scheduleres=mysqli_query($con,$sql);

$receiver = "joseph.pezhathinal1@gmail.com";
$subject = "Email Test via PHP using Localhost";
$body = "Hi, there...This is a test email send from Localhost.";
$sender = "From:seniorprojectwchc@gmail.com";
if(mail($receiver, $subject, $body, $sender)){
    echo "Email sent successfully to $receiver";
}else{
    echo "Sorry, failed while sending mail!";
}

if ($scheduleres) {
	$btn= "disable";
} 


$result = mysqli_query($con,$query);
//error handeling
if( $result )
{
?>
<script type="text/javascript">
alert('Appointment made successfully.');
</script>
<?php
header("Location: patientapplist.php");
}
else
{
	echo mysqli_error($con);
?>
<script type="text/javascript">
alert('Appointment booking fail. Please try again.');
</script>
<?php
header("Location: patient.php");
}
//dapat dari generator end
}
?>
<!DOCTYPE HTML>

<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<!--css files-->
	<script src="https://kit.fontawesome.com/95c473646d.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="assets/css/button.css">
</head>

<header>
    <div class="hero-image">
    <a href="https://www.waynecountyhealthy.com" ><img src="assets/img/pp.png" width="100%"></a>
    </div>
</header>

<header>
	<h1>Appointment</h1>
</header>
    
        
<body>
  <section>
    <div class="bf">
    <div class="center">
	
	
	<form class="form" role="form" method="POST" accept-charset="UTF-8">
		<div>Appointment Information</div>
		<!--prints out the details of the appointment chosen-->
		<div>
			Date: <?php echo $date ?><br>
			Time: <?php echo $timeslot ?><br>
		</div>
		<!--covid-19 questionaire starts here-->

		<div class="form-group">
			<p>1. Regardless of your vaccination status, have
				you experienced any of the symptoms in
				the list below in the past 48 hours?
			</p>

			<input type="checkbox" class= "largerCheckbox" id="symptom1" name="symp[]" value="fever or chills">
			<label for="symptom1"> Fever or chills</label><br><br>
			<input type="checkbox" class= "largerCheckbox" id="symptom2" name="symp[]" value="cough">
			<label for="symptom2"> Cough</label><br><br>
			<input type="checkbox" class= "largerCheckbox" id="symptom3" name="symp[]" value="shortness of breath or difficulty breathing">
			<label for="symptom3"> Shortness of breath or difficulty breathing</label><br><br>
			<input type="checkbox" class= "largerCheckbox" id="symptom4" name="symp[]" value="fatigue">
			<label for="symptom4"> Fatigue</label><br><br>
			<input type="checkbox" class= "largerCheckbox" id="symptom5" name="symp[]" value="muscle or body aches">
			<label for="symptom5"> Muscle or body aches</label><br><br>
			<input type="checkbox" class= "largerCheckbox" id="symptom6" name="symp[]" value="headache">
			<label for="symptom6"> Headache</label><br><br>
			<input type="checkbox" class= "largerCheckbox" id="symptom7" name="symp[]" value="new loss of taste or smell">
			<label for="symptom7"> New loss of taste or smell</label><br><br>
			<input type="checkbox" class= "largerCheckbox" id="symptom8" name="symp[]" value="sore throat">
			<label for="symptom8"> Sore throat</label><br><br>
			<input type="checkbox" class= "largerCheckbox" id="symptom9" name="symp[]" value="congestion or runny nose">
			<label for="symptom9"> Congestion or runny nose</label><br><br>
			<input type="checkbox" class= "largerCheckbox" id="symptom10" name="symp[]" value="nausea or vomiting">
			<label for="symptom10"> Nausea or vomiting</label><br><br>
			<input type="checkbox" class= "largerCheckbox" id="symptom11" name="symp[]" value="diarrhea">
			<label for="symptom11"> Diarrhea</label><br>
		</div>

		<div class="form-group">
			<p>2. Are you isolating or quarantining because you
			tested positive for COVID-19 or are worried
			that you may be sick with COVID-19?</p>
			  <input type="radio" class= "largerRadio" id="yes_isolating" name="isolating" value="yes">
			  <label for="yes_isolating"> Yes</label><br><br>
			  <input type="radio" class= "largerRadio" id="no_isolating" name="isolating" value="no">
			  <label for="no_isolating"> No</label><br>
		</div>

		<div class="form-group">
			<p>3. Have you been in close physical contact in the last 14 days with:</p>
			  <input type="radio" class= "largerRadio" id="yes_contact" name="contact" value="yes">
			  <label for="yes_contact"> Yes</label><br><br>
			  <input type="radio" class= "largerRadio" id="no_contact" name="contact" value="no">
			  <label for="no_contact"> No</label><br>
		</div>

		<div class="form-group">
			<p>4. Have you traveled in the past 10 days?</p>
			  <input type="radio" class= "largerRadio" id="yes_travel" name="travel" value="yes">
			  <label for="yes_travel"> Yes</label><br><br>
			  <input type="radio" class= "largerRadio" id="no_travel" name="travel" value="no">
			  <label for="no_travel"> No</label><br>
		</div>

		<div class="form-group">
		<p>5. Are you vaccinated for COVID-19?</p>
		  <input type="radio" class= "largerRadio" id="yes_vaccinated" name="vaccinated" value="yes">
		  <label for="yes_vaccinated"> Yes</label><br><br>
		  <input type="radio" class= "largerRadio" id="no_vaccinated" name="vaccinated" value="no">
		  <label for="no_vaccinated"> No</label><br><br>
		</div>
		<!--Covid-19 questionaire ends-->
        <!--when the submit button is clicked the input will be sent to the php at the top to be entered to the database-->
		<div class="form-group">
			<input type="submit" name="appointment" id="submit" class="btn btn-primary" value="Make Appointment">
		</div>
     
	</form>

	</div>
	</div>
</section>
  
</body>
</html>