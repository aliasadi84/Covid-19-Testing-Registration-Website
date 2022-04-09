<?php
//connection to the database
include_once 'assets/conn/dbconnect.php';

session_start();
//If a clinic session is already running without loging out from the clinic session,
//it will be directed toward doctordashboard.php(file) in clinic(folder).
if (isset($_SESSION['staffSession']) != "") {
header("Location: staff/doctordashboard.php");
}
if (isset($_POST['login']))
{
$icstaff = mysqli_real_escape_string($con,$_POST['icstaff']);
//clinc staff username
$password  = mysqli_real_escape_string($con,$_POST['password']);
//clinic staff password
$res = mysqli_query($con,"SELECT * FROM staff WHERE icstaff = '$icstaff'");
//check and get if the username is present in the database.
$row=mysqli_fetch_array($res,MYSQLI_ASSOC);
//if statement check if password matches with what is present for the username.
if ($row['password'] == $password && $row['active'] == 'active')
{
$_SESSION['staffSession'] = $row['icstaff'];
//error checking
//If a clinic session is already running without loging out from the clinic session,
//it will be directed toward doctordashboard.php(file) in clinic(folder).
?>
<script type="text/javascript">
alert('Login Success');
</script>
<?php
header("Location: staff/doctordashboard.php");
} else {
?>
<script type="text/javascript">
    alert("Account deactivated or information entered is incorrect. Please try again.");
</script>
<?php
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
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/button.css">
    <link rel="stylesheet" href="assets/css/account.css">
    <!--end of css design files-->
</head>
<!--The header of the registration page, which contains the logo of WCHC clinic. The link is directed to the
Main Page of the WCHC Clinic Website-->   
<header>
    <div class="hero-image">
        <a href="index.html" ><img src="assets/pp.png" width="50%"></a>
        <!--The image is located inside the assets(folder) -> img(folder) -> pp.png --> 
    </div>
</header>
<!--end of the header-->
      

<body>
    <div class="bf">
    <a href="clinicloginselect.html" class="patientback"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
        <h2>Clinic Staff Login</h2>
        <form class="form" role="form" method="POST" accept-charset="UTF-8">
            <!--The text field to enter the Username-->
            <label>Username</label><br>
            <input name="icstaff" type="text" placeholder="Staff ID" required><br>
            <!--The text field to enter the Password-->
            <label>Password</label><br>
            <input name="password" type="password" placeholder="Password" required><br><br>
            <!--Log-in button to submit the form-->
            <button class="button3" type="submit" name="login">Login</button>
        </form>
    </div>

</body>
</html>
