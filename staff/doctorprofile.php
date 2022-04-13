<?php
session_start();
include_once '../assets/conn/dbconnect.php';


//if not logged into the staff side it will direct you to the stafflogin.php
if(!isset($_SESSION['staffSession']))
{
header("Location: ../stafflogin.php");
}
$usersession = $_SESSION['staffSession'];
//Checking the staff ID making sure it's still there
$res=mysqli_query($con,"SELECT * FROM staff WHERE icstaff = '$usersession'");
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);

?>

<!DOCTYPE html>
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
<!--The header of the doctorprofile page, which contains the logo of WCHC clinic. The link is directed to the
the WCHC Clinic Staff Dashboard-->
<header>
    <div class="hero-image">
        <a href="doctordashboard.php"><img src="../assets/pp.png" width="50%"></a>
    </div>
</header>
<!--end of the header-->
<body>
    <!--Top navigation with all links to the staff side-->
    <ul>
      <li><a  href="doctordashboard.php">Dashboard</a></li>
      <li><a href="addresults.php">Add Result</a></li>
      <li><a href="patientlist.php">Patient List</a></li>
      <li><a class="active" href="doctorprofile.php">Your Account</a></li>
      <li style="float:right"><a href="logout.php?logout">Log Out</a></li>
    </ul>
    <!--End of top navigation-->
    <!--Table to view staff details-->
        <table>
            <tbody>
            <th colspan="7"><h2><?php echo $userRow['staffFirstName']; ?> <?php echo $userRow['staffLastName'];?>  </h2></th>
                <tr>
                    <td>First Name</td>
                    <td><input type="text" class="form-control" name="staffFirstName" value="<?php echo $userRow['staffFirstName']; ?>"  /></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><input type="text" class="form-control" name="staffLastName" value="<?php echo $userRow['staffLastName']; ?>"  /></td>
                </tr>

                <tr>
                    <td>Phone Number</td>
                    <td><input type="text" class="form-control" name="staffPhone" value="<?php echo $userRow['staffPhone']; ?>"  /></td>
                </tr>
                <tr>
                    <td>E-mail Address</td>
                    <td><input type="text" class="form-control" name="staffEmail" value="<?php echo $userRow['staffEmail']; ?>"  /></td>
                </tr>
            </tbody>
                
        </table>
    <!--End of table-->




    </body>
</html>
