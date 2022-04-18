<?php
session_start();
include_once '../assets/conn/dbconnect.php';
if(!isset($_SESSION['AdminSession']))
//if not logged into the staff side it will direct you to the index.html
{
header("Location: ../index.html");
}
$usersession = $_SESSION['AdminSession'];
//Checking the admin ID making sure it's still there
$res=mysqli_query($con,"SELECT * FROM admin WHERE AdminId= '$usersession'");
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);


if (isset($_POST['submit'])) {
//functionality to allow the admin to change first name, last name, phone, or email and save it into the database
$AdminFirstName = $_POST['AdminFirstName'];
$AdminLastName = $_POST['AdminLastName'];
$AdminPhone = $_POST['AdminPhone'];
$AdminEmail = $_POST['AdminEmail'];

//doing the changing
$res=mysqli_query($con,"UPDATE admin SET AdminFirstName='$AdminFirstName', AdminLastName='$AdminLastName', AdminPhone='$AdminPhone', AdminEmail='$AdminEmail' WHERE AdminId= '$usersession'");
// $userRow=mysqli_fetch_array($res);

//After update takes you to this page
header( 'Location: doctorprofile.php' ) ;

}
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
the WCHC Clinic Admin Dashboard-->
<header>
    <div class="hero-image">
        <a href="doctordashboard.php"><img src="../assets/pp.png" width="50%"></a>
    </div>
</header>
<!--end of the header-->
<body>
    <!--Top navigation with all links to the staff side-->
    <ul>
      <li><a href="doctordashboard.php">Dashboard</a></li>
      <li><a href="addresults.php">Add Result</a></li>
      <li><a href="patientlist.php">Patient List</a></li>
      <li><a href="staff.php">Staff List</a></li>
      <li><a class="active" href="doctorprofile.php">Your Account</a></li>
      <li style="float:right"><a href="logout.php?logout">Log Out</a></li>
    </ul>
    <!--End of top navigation-->
    <form action="<?php $_PHP_SELF ?>" method="post" >
        <!--Table to view staff details-->
        <table>
            <tbody>
            <th colspan="7"><h2><?php echo $userRow['AdminFirstName']; ?> <?php echo $userRow['AdminLastName'];?>  </h2></th>
                <!--Displays First name-->
                <tr>
                    <td>First Name</td>
                    <td><input type="text" class="form-control" name="AdminFirstName" value="<?php echo $userRow['AdminFirstName']; ?>"  /></td>
                </tr>
                <!--Displays Last name-->
                <tr>
                    <td>Last Name</td>
                    <td><input type="text" class="form-control" name="AdminLastName" value="<?php echo $userRow['AdminLastName']; ?>"  /></td>
                </tr>
                <!--Displays Phone Number-->
                <tr>
                    <td>Phone Number</td>
                    <td><input type="text" class="form-control" name="AdminPhone" value="<?php echo $userRow['AdminPhone']; ?>"  /></td>
                </tr>
                <!--Displays Email Address-->
                <tr>
                    <td>E-mail Address</td>
                    <td><input type="text" class="form-control" name="AdminEmail" value="<?php echo $userRow['AdminEmail']; ?>"  /></td>
                </tr>
                <!--Submit Update Info button-->
                <tr>
                    <td>
                        <input type="submit" name="submit" class="btn btn-info" value="Update Info"></td>
                </tr>
            </tbody>
                
        </table>
        <!--End of table-->
    </form>

</body>
</html>
