<?php
session_start();
//connect to the database
include_once '../assets/conn/dbconnect.php';
date_default_timezone_set('America/Detroit');
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
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/button.css">
</head>

<header>
    <div class="hero-image">
        <a href="patient.php"><img src="../assets/pp.png" width="50%"></a>
    </div>
</header>
        
<body>
	<section>
    <div class="bf">
	<section id="promo-1" class="content-block">
	<a href="patient.php" class="patientback"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
		<h2> Choose your appointment</h2>
		<!--Input the date for the appointment which is sent to the script below to populate available appointments-->
		<input type="date" id="date" name="date" min="<?php echo date("Y-m-d"); ?>" max="<?php echo date("Y-m-d", strtotime("+14 days")); ?>" onchange="showUser(this.value)"/>
        <!--php in the input limit the date to 14 days-->
		<!-- NOTE FROM TIM: What does this script section actually do? -->
		<script>
			const picker = document.getElementById('date');
			var removeDays = [];
			picker.addEventListener('input', function(e){
			//error checking for clinic holidays and sundays.
			var dateObj = new Date(this.value);
			var day = new Date(this.value).getUTCDay();
			var mlk = new Date(<?php $currentYear = date("Y"); echo date("Y, n, d, H, i, s", strtotime("third monday of january $currentYear")) ?>);
			var memorial = new Date(<?php $currentYear = date("Y"); echo date("Y, n, d, H, i, s", strtotime("last monday of may $currentYear")) ?>);
			var thanksgiving = new Date(<?php $currentYear = date("Y"); echo date("Y, n, d, H, i, s", strtotime("november $currentYear fourth thursday")) ?>);
			var labor = new Date(<?php $currentYear = date("Y"); echo date("Y, n, d, H, i, s", strtotime("september $currentYear first monday")) ?>);
			var mlk = mlk.getFullYear() + "-" + mlk.getMonth() + "-" + mlk.getDate();
			var memorial = memorial.getFullYear() + "-" + memorial.getMonth() + "-" + memorial.getDate();
			var thanksgiving = thanksgiving.getFullYear() + "-" + thanksgiving.getMonth() + "-" + thanksgiving.getDate();
			var labor = labor.getFullYear() + "-" + labor.getMonth() + "-" + labor.getDate();
			var ymd = dateObj.getUTCFullYear() + "-" + (dateObj.getUTCMonth() + 1) + "-" + dateObj.getUTCDate();
			var ymdmonth = dateObj.getMonth() + 1 ;
			var ymddate = dateObj.getDate()+1 ;
			var newyear = (dateObj.getFullYear()+1) + "-1-1";
			var newyear1 = dateObj.getFullYear() + "-1-1";
			var newyeareve = dateObj.getFullYear() + "-12-31";
			var christmas = dateObj.getFullYear() + "-12-25";
			var christmaseve = dateObj.getFullYear() + "-12-24";
			var independence = dateObj.getFullYear() + "-7-4";
			var juneteenth = dateObj.getFullYear() + "-6-19";
			removeDays.push(newyear,newyear1,newyeareve,christmas,christmaseve,independence,juneteenth,mlk,memorial,thanksgiving,labor);
			var n = removeDays.includes(ymd);
			if(n > 0){
				e.preventDefault();
				this.value = '';
				alert('Clinic is closed on this day');
			}
			else if([7,0].includes(day)){
				if (ymdmonth == 1 && ymddate > 2){
				}
				else {
					e.preventDefault();
					this.value = '';
					alert('Clinic is closed on this day');
				}
			}
			});

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
  
</body>
</html>
