<?php
session_start();
include_once '../assets/conn/dbconnect.php';

if(!isset($_SESSION['patientSession']))
{
header("Location: ../index.php");
}
$usersession = $_SESSION['patientSession'];

$res=mysqli_query($con,"SELECT * FROM patient WHERE icPatient = '$usersession'");
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);
?>

<?php
if (isset($_POST['submit'])) {
//variables that are gathered when the user change their information
$patientFirstName = $_POST['patientFirstName'];
$patientLastName = $_POST['patientLastName'];
$patientDOB = $_POST['patientDOB'];
$patientGender = $_POST['patientGender'];
$patientPhone = $_POST['patientPhone'];
$patientEmail = $_POST['patientEmail'];
$res=mysqli_query($con,"UPDATE patient SET patientFirstName='$patientFirstName', patientLastName='$patientLastName', patientDOB='$patientDOB', patientGender='$patientGender', patientPhone=$patientPhone, patientEmail='$patientEmail' WHERE icPatient = '$usersession'");

header( 'Location: profile.php' ) ;
}
?>

<?php
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
    <script src="https://kit.fontawesome.com/95c473646d.js" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/loginButton.css">
    <link rel="stylesheet" href="../assets/css/table.css">
    <link rel="stylesheet" href="../assets/css/input.css">
</head>

<header>
    <div class="hero-image">
        <a href="https://www.waynecountyhealthy.com"><img src="../assets/pp.png" width="50%"></a>
    </div>
</header>
<title>Account</title>

<body>
  
  <div class="wrapper">
    <div class="bf">
	<section>
	<div>
		<h4><?php echo $userRow['patientFirstName']; ?> <?php echo $userRow['patientLastName']; ?></h4>
		<hr />
		<!--logout button-->
		<a href="patientlogout.php?logout=<?php echo $userRow['icPatient']; ?>"><button class="button3">Log Out</button></a>
        	<!--appointment list button-->
        	<a href="patientapplist.php?patientId=<?php echo $userRow['icPatient']; ?>"><button type="button" class="button3" data-toggle="modal" data-target="#myModal">Appointments</button></a>
	</div>
						
	<!-- form start -->
	<form action="<?php $_PHP_SELF ?>" method="post" >
	<!--patient profile where each input can be edited in order to change patient detail-->
	<table>
		<tr>
						<td>First Name</td>
						<td><input type="text" class="form-control" name="patientFirstName" value="<?php echo $userRow['patientFirstName']; ?>"  /></td>
					</tr>
					<tr>
						<td>Last Name</td>
						<td><input type="text" class="form-control" name="patientLastName" value="<?php echo $userRow['patientLastName']; ?>"  /></td>
					</tr>

					<tr>
						<td>Date of Birth</td>
						<td><input type="date" class="form-control" name="patientDOB" value="<?php echo $userRow['patientDOB']; ?>"  /></td>
					</tr>
					<!-- radio button -->
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
					<!-- radio button end -->
					
					<tr>
						<td>Phone Number</td>
						<td><input type="text" class="form-control" name="patientPhone" value="<?php echo $userRow['patientPhone']; ?>"  /></td>
					</tr>
					<tr>
						<td>E-mail Address</td>
						<td><input type="text" class="form-control" name="patientEmail" value="<?php echo $userRow['patientEmail']; ?>"  /></td>
					</tr>		
	</table>
            </form>
                <button class="button3" name="submit" type="submit">Update</button>
    </section>
	</div>
</div>
</body>
</html>
