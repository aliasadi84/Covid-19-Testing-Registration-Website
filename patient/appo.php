<?php
session_start();
//connect to the database
include_once '../assets/conn/dbconnect.php';
if(!isset($_SESSION['patientSession']))
{
header("Location: patient.php");
}

$usersession = $_SESSION['patientSession'];

//checks is the patient username exists
$res=mysqli_query($con,"SELECT * FROM patient WHERE icPatient = '$usersession'");

if ($res===false) {
	echo mysql_error();
} 

$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);
?>


<!DOCTYPE HTML>

<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<script src="https://kit.fontawesome.com/95c473646d.js" crossorigin="anonymous"></script>
	<!--css files-->
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="assets/css/button.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
	<section id="promo-1" class="content-block">

		<h2> Choose you appointment</h2>
		<!--Input the date for the appointment which is sent to the script below to populate available appointments-->
		<input type="date" id="date" name="date" onchange="showUser(this.value)"/>


		<script>

		function showUser(str) {
		
		if (str == "") {
		document.getElementById("txtHint").innerHTML = "No data to be shown";
		return;
		} 

		else {

		if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
		} 
		
		else {
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}

		xmlhttp.onreadystatechange = function() {

		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
		}
		};
        //the input date is sent to getschedule.php to populate available appointments
		xmlhttp.open("GET","getschedule.php?q="+str,true);
		console.log(str);
		xmlhttp.send();
		}
		}

		</script>
		
		
		<!-- table appointment start -->

			<div class="row">
				<div class="col-xs-12 col-md-8">
					<div id="txtHint"></div>
				</div>
			</div>

		<!-- </div> -->
		<!-- table appointment end -->
	</section>
	</div>
	</div>
  
</body>
</html>
