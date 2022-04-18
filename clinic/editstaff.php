<?php
session_start();
include_once '../assets/conn/dbconnect.php';

if(!isset($_SESSION['doctorSession']))
{
//if not logged into the admin side it will direct you to the index.html
header("Location: ../index.html");
}
if (isset($_GET['username'])) {
	$usersession =$_GET['username'];
}

$res=mysqli_query($con,"SELECT * FROM staff WHERE icstaff = '$usersession'");
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);
?>

<?php
if (isset($_POST['submit'])) {
//variables that are gathered when the user change their information
$staffFirstName = $_POST['staffFirstName'];
$staffLastName = $_POST['staffLastName'];
$staffDOB = $_POST['staffDOB'];
$staffPhone = $_POST['staffPhone'];
$staffEmail = $_POST['staffEmail'];
$res=mysqli_query($con,"UPDATE staff SET staffFirstName='$staffFirstName', staffLastName='$staffLastName', staffDOB='$staffDOB', staffPhone=$staffPhone, staffEmail='$staffEmail' WHERE icstaff = '$usersession'");

header( 'Location: staff.php' ) ;
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
	<link rel="stylesheet" href="table.css">
	<link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/input.css">
	<!--end of css design files-->
</head>
<!--The header of the edit staff page, which contains the logo of WCHC clinic. The link is directed to the
the WCHC Clinic Admin Dashboard-->
<header>
    <div class="hero-image">
        <a href="doctordashboard.php"><img src="../assets/pp.png" width="50%"></a>
    </div>
</header>
<!--end of the header-->

<title>Account</title>

<body>
  
  <div class="wrapper">
    <div class="bf">
	<section>
	<div>
		<h4><?php echo $userRow['staffFirstName']; ?> <?php echo $userRow['staffLastName']; ?></h4>
		<hr />
	</div>
						
		<!-- form start -->
		<form action="<?php $_PHP_SELF ?>" method="post" >
		<!--patient profile where each input can be edited in order to change patient detail-->
			<table>
				
					<tr>
						<td>First Name</td>
						<td><input type="text" class="form-control" name="staffFirstName" value="<?php echo $userRow['staffFirstName']; ?>"  /></td>
					</tr>
					<tr>
						<td>Last Name</td>
						<td><input type="text" class="form-control" name="staffLastName" value="<?php echo $userRow['staffLastName']; ?>"  /></td>
					</tr>

					<tr>
						<td>Date of Birth</td>
						<td><input type="date" class="form-control" name="staffDOB" value="<?php echo $userRow['staffDOB']; ?>"  /></td>
					</tr>
					<tr>
						<td>Phone Number</td>
						<td><input type="text" class="form-control" name="staffPhone" value="<?php echo $userRow['staffPhone']; ?>"  /></td>
					</tr>
					<tr>
						<td>E-mail Address</td>
						<td><input type="text" class="form-control" name="staffEmail" value="<?php echo $userRow['staffEmail']; ?>"  /></td>
					</tr>	
				</table>
			<button class="button3" name="submit" type="submit">Update</button>
			</form>
	
    </section>
	
	</div>
	
</div>
</body>
</html>
