<?php
//THIS PAGE DISPLAYS THE PATIENT PROFILE INFORMATION AND HERE THE PATIENT CAN MAKE CHANGES TO THEIR INFORMATION PRESENT IN THE DATABASE.
session_start();
//connection to the database
include_once '../assets/conn/dbconnect.php';

if(!isset($_SESSION['patientSession']))
{
//page directs to the  index.php if a patient session has not been started.
header("Location: ../index.php");
}
//patient username is stored into the variable '$usersession'
$usersession = $_SESSION['patientSession'];
//getting patient information by the datbase where the patient table is found through the constriction in patient username -> "WHERE icPatient = '$usersession'".
$res=mysqli_query($con,"SELECT * FROM patient WHERE icPatient = '$usersession'");
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);
?>

<?php
if (isset($_POST['submit'])) {
//variables that are gathered when the user change their information and click the update button
//getting form input for First name
$patientFirstName = $_POST['patientFirstName'];
//getting form input for Last name
$patientLastName = $_POST['patientLastName'];
//getting form input for Date of Birth
$patientDOB = $_POST['patientDOB'];
//getting form input for Gender
$patientGender = $_POST['patientGender'];
//getting form input for Phone Number
$patientPhone = $_POST['patientPhone'];
//getting form input for Email
$patientEmail = $_POST['patientEmail'];

//UPDATING the form input to the database (patient table -> "UPDATE patient") by the constriction on patient 'username' -> "WHERE icPatient = '$usersession'".
$res=mysqli_query($con,"UPDATE patient SET patientFirstName='$patientFirstName', patientLastName='$patientLastName', patientDOB='$patientDOB', patientGender='$patientGender', patientPhone=$patientPhone, patientEmail='$patientEmail' WHERE icPatient = '$usersession'");
//The page refreashes by calling the page again.
header( 'Location: profile.php' ) ;
}
?>

<?php
//php to find the gender stored in the database, in-order to display the choice in the form.
$male="";
$female="";
if ($userRow['patientGender']=='male') {
$male = "checked";
}elseif ($userRow['patientGender']=='female') {
$female = "checked";
}
?>

<!DOCTYPE html>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

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

<header>
	<!--The header of the patient profile page, which contains the logo of WCHC clinic. The link is directed to the
    the WCHC Clinic Patient Dashboard-->
    <div class="hero-image">
        <a href="patient.php"><img src="../assets/pp.png" width="50%"></a>
    </div>
</header>
    <!--end of the header-->
<title>Account</title>

<body>
  
  <div class="wrapper">
    <div class="bf">
	<!--Back button to go back to previous page (patient.php)-->
	<a href="patient.php" class="patientback"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
	<section>
	<div>
		<!--Print's out the First and Last Name of the Patient-->
		<h4><?php echo $userRow['patientFirstName']; ?> <?php echo $userRow['patientLastName']; ?></h4>
		<hr />
		<a href="patientlogout.php?logout=<?php echo $userRow['icPatient']; ?>"><button class="button3">Log Out</button></a>
		<!--logout button-->
		<a href="patientapplist.php?patientId=<?php echo $userRow['icPatient']; ?>"><button type="button" class="button3" data-toggle="modal" data-target="#myModal">Appointments</button></a>
		<!--appointment list button-->
	</div>
						
		<!-- form start -->
		<form action="<?php $_PHP_SELF ?>" method="post" >
		<!--patient profile where each input can be edited in order to change patient detail-->
			<table>
				
					<tr>
						<!--Input text field for First  Name-->
						<td>First Name</td>
						<td><input type="text" class="form-control" name="patientFirstName" value="<?php echo $userRow['patientFirstName']; ?>"  /></td>
					</tr>
					<tr>
						<!--Input text field for Last  Name-->
						<td>Last Name</td>
						<td><input type="text" class="form-control" name="patientLastName" value="<?php echo $userRow['patientLastName']; ?>"  /></td>
					</tr>

					<tr>
						<!--Input date field for Date of Birth-->
						<td>Date of Birth</td>
						<td><input type="date" class="form-control" name="patientDOB" value="<?php echo $userRow['patientDOB']; ?>"  /></td>
					</tr>
						<!--Input radio button field for Gender-->
					<tr>
						<td>Gender</td>
						<td>
							<div class="radioAlign2">
								<label><input type="radio" name="patientGender" value="male" <?php echo $male; ?>>Male</label>
							</div>
							<div class="radioAlign2">
								<label><input type="radio" name="patientGender" value="female" <?php echo $female; ?>>Female</label>
							</div>
						</td>
					</tr>
					
					<tr>
						<!--Input text field for Phone Number-->
						<td>Phone Number</td>
						<td><input type="text" class="form-control" name="patientPhone" value="<?php echo $userRow['patientPhone']; ?>"  /></td>
					</tr>
					<tr>
						<!--Input text field for Email Address-->
						<td>E-mail Address</td>
						<td><input type="text" class="form-control" name="patientEmail" value="<?php echo $userRow['patientEmail']; ?>"  /></td>
					</tr>	
				</table>
			<!--Submit button to update any of the details above to the database-->
			<button class="button3" name="submit" type="submit">Update</button>
			</form>
				
				
	
	
    </section>
	
	</div>
	
</div>
</body>
</html>
