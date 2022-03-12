<?php
session_start();
// include_once '../connection/server.php';
include_once '../assets/conn/dbconnect.php';
if(!isset($_SESSION['patientSession']))
{
header("Location: ../index.php");
}
$usersession = $_SESSION['patientSession'];

$res=mysqli_query($con,"SELECT * FROM patient WHERE icPatient = '$usersession'");
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);
?>
<!-- update -->
<?php
if (isset($_POST['submit'])) {
//variables
$patientFirstName = $_POST['patientFirstName'];
$patientLastName = $_POST['patientLastName'];
$patientDOB = $_POST['patientDOB'];
$patientGender = $_POST['patientGender'];
$patientPhone = $_POST['patientPhone'];
$patientEmail = $_POST['patientEmail'];
// mysqli_query("UPDATE blogEntry SET content = $udcontent, title = $udtitle WHERE id = $id");
$res=mysqli_query($con,"UPDATE patient SET patientFirstName='$patientFirstName', patientLastName='$patientLastName', patientDOB='$patientDOB', patientGender='$patientGender', patientPhone=$patientPhone, patientEmail='$patientEmail' WHERE icPatient = '$usersession'");
// $userRow=mysqli_fetch_array($res);
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
<noscript><link rel="stylesheet" href="css/noscript.css" /></noscript>
<!-- below: css files listed -->
    <link rel="stylesheet" href="main.css" />  
    <link rel="stylesheet" href="assets/css/nav.css">     <!-- navigation bar specific css -->
    <link rel="stylesheet" href="assets/css/account.css">      <!-- account specific css -->
    <meta charset="utf-8">
    <meta name="viewport"
       content="width=device-width,
       initial-scale=1">
    <title>Account</title>
       
      <!-- Header/ Nav Bar -->
	  <header>
    <div class="hero-image">
        <a href="https://www.waynecountyhealthy.com" ><img src="assets/img/pp.png" width="100%"></a>
    </div>
</header>

<body>

  <header>



    </header>
  
  <div class="wrapper">
     <div class="bf">
			<section style="padding-bottom: 50px; padding-top: 50px;">
				<div class="row">
					<!-- start -->
					<!-- USER PROFILE ROW STARTS-->
					<div class="row">
						<div class="col-md-3 col-sm-3">
							
							<div class="user-wrapper">
								<div class="description">
									<h4><?php echo $userRow['patientFirstName']; ?> <?php echo $userRow['patientLastName']; ?></h4>
									<hr />
									<a href="patientlogout.php?logout=<?php echo $userRow['icPatient']; ?>"><button>Log Out</button></a>
									<a href="patientapplist.php?patientId=<?php echo $userRow['icPatient']; ?>"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Your Appointment's</button></a>
								</div>
							</div>
						</div>
						
						<div class="col-md-9 col-sm-9  user-wrapper">
							<div class="description">
								<hr />
								
								<div class="panel panel-default">
									<div class="panel-body">
										
										
										<table class="table table-user-information" align="center">
											<tbody>
												
												
												<tr>
													<td>PatientDOB</td>
													<td><?php echo $userRow['patientDOB']; ?></td>
												</tr>
												<tr>
													<td>PatientGender</td>
													<td><?php echo $userRow['patientGender']; ?></td>
												</tr>
												<tr>
													<td>PatientPhone</td>
													<td><?php echo $userRow['patientPhone']; ?>
													</td>
												</tr>
												<tr>
													<td>PatientEmail</td>
													<td><?php echo $userRow['patientEmail']; ?>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								
							</div>
							
						</div>
					</div>
					<!-- USER PROFILE ROW END-->
					<!-- end -->
					<div class="col-md-4">
						
						<!-- Large modal -->
						
						<!-- Modal -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<div class="modal-dialog" role="document">
								<div class="modal-content">

									<div class="modal-body"><br><br>
										<!-- form start -->
										<form action="<?php $_PHP_SELF ?>" method="post" >
											<table class="table table-user-information">
												<tbody>
													<tr>
														<td>First Name:</td>
														<td><input type="text" class="form-control" name="patientFirstName" value="<?php echo $userRow['patientFirstName']; ?>"  /></td>
													</tr>
													<tr>
														<td>Last Name</td>
														<td><input type="text" class="form-control" name="patientLastName" value="<?php echo $userRow['patientLastName']; ?>"  /></td>
													</tr>
													
													<!-- radio button -->
													<!-- radio button end -->
													<tr>
														<td>DOB</td>
														<!-- <td><input type="text" class="form-control" name="patientDOB" value="<?php echo $userRow['patientDOB']; ?>"  /></td> -->
														<td>
															<div class="form-group ">
																
																<div class="input-group">
																	<div class="input-group-addon">
																		<i class="fa fa-calendar">
																		</i>
																	</div>
																	<input class="form-control" id="patientDOB" name="patientDOB" placeholder="MM/DD/YYYY" type="text" value="<?php echo $userRow['patientDOB']; ?>"/>
																</div>
															</div>
														</td>
														
													</tr>
													<!-- radio button -->
													<tr>
														<td>Gender</td>
														<td>
															<div class="radio">
																<label><input type="radio" name="patientGender" value="male" <?php echo $male; ?>>Male</label>
															</div>
															<div class="radio">
																<label><input type="radio" name="patientGender" value="female" <?php echo $female; ?>>Female</label>
															</div>
														</td>
													</tr>
													<!-- radio button end -->
													
													<tr>
														<td>Phone number</td>
														<td><input type="text" class="form-control" name="patientPhone" value="<?php echo $userRow['patientPhone']; ?>"  /></td>
													</tr>
													<tr>
														<td>Email</td>
														<td><input type="text" class="form-control" name="patientEmail" value="<?php echo $userRow['patientEmail']; ?>"  /></td>
													</tr>
													<tr>
														<td>
															<input type="submit" name="submit" class="btn btn-info" value="Update Info"></td>
														</tr>
													</tbody>
													
												</table>
												
												
												
											</form>
											<!-- form end -->
    </section>
    <br>
</body>