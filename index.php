<?php
//connection to the database
include_once 'assets/conn/dbconnect.php';

session_start();
//If a patient session is already running without a loging out from the patient session,
//it will be directed toward patient.php(file) in patient(folder).
if (isset($_SESSION['patientSession']) != "") {
header("Location: patient/patient.php");
}

if (isset($_POST['login']))
{
//gets all the input during a form submission
$icPatient = mysqli_real_escape_string($con,$_POST['icPatient']);
//patient username input
$password  = mysqli_real_escape_string($con,$_POST['password']);
//patient password input
$res = mysqli_query($con,"SELECT * FROM patient WHERE icPatient = '$icPatient'");
$row=mysqli_fetch_array($res,MYSQLI_ASSOC);
//check and get if the username is present in the database.
//if statement check if password matches with what is present for the username.
if ($row['password'] == $password)
{
$_SESSION['patientSession'] = $row['icPatient'];
//error checking
?>

<script type="text/javascript">
alert('Login Success');
</script>

<?php
header("Location: patient/patient.php");
} else {
?>

<script>
alert('wrong input ');
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
    <link rel="stylesheet" href="assets/css/submit.css">
    <link rel="stylesheet" href="assets/css/account.css">
    <!--end of css design files-->
</head>
<!--The header of the registration page, which contains the logo of WCHC clinic. The link is directed to the
Main Page of the WCHC Clinic Website-->
<header>
    <div class="hero-image">
        <a href="https://www.waynecountyhealthy.com" ><img src="assets/img/pp.png" width="100%"></a>
        <!--The image is located inside the assets(folder) -> img(folder) -> pp.png -->    
    </div>
</header>
<!--end of the header-->
 <body>
    <div class="bf">

        <form class="form" role="form" method="POST" accept-charset="UTF-8" >
            <h1>Log In</h1>
            <!--The text field to enter the Username-->
            <label for="icPatient">Username</label><br>
            <input type="text" id="username" name="icPatient" placeholder="Username" required autofocus autocomplete><br>
            <!--The text field to enter the Password-->
            <label for="password">Password</label><br>
            <input type="password" id="password" name="password" placeholder="Password" required autofocus autocomplete>
            <!--The link to forgot password-->
            <h4><a href="">Forgot password?</a></h4>
            <!--Log-in button to submit the form-->
            <button class="button3" name="login" id="login" type="submit"> Login</button><br>
            <!--The link to register user-->
            <a href = 'reg.html'>Register Here!</a>
    
        </form>

    </div>

</body>  
</html>