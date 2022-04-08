<?php
//connection to the database
include_once 'assets/conn/dbconnect.php';

session_start();
//If a patient session is already running without a loging out from the patient session,
//it will be directed toward patient.php(file) in patient(folder).

if (isset($_POST['login']))
{
//gets all the input during a form submission
$icPatient = mysqli_real_escape_string($con,$_POST['icPatient']);
$code = rand(999999, 111111);
//patient username input
$insert_code = "UPDATE patient SET validate = $code WHERE icPatient = '$icPatient'";
$run_query =  mysqli_query($con, $insert_code);
$res = mysqli_query($con,"SELECT * FROM patient WHERE icPatient = '$icPatient'");
$row=mysqli_fetch_array($res,MYSQLI_ASSOC);
//check and get if the username is present in the database.
//if statement check if password matches with what is present for the username.

if (isset($row['icPatient']) == $icPatient)
{
$_SESSION['forgotSession'] = $row['icPatient'];
//error checking
$to = $row['patientEmail'];
$subject = "Reset Password";
$body ="Hello " .$row['patientFirstName']. ",\n\nYou have requested for a password change in your Wayne County Healthy Communities!\n\nThe verification code: $code";
$header = "From: from@email";
mail($to, $subject, $body, $header)
?>

<script type="text/javascript">
alert('Username is valid, please continue to the next process.');
</script>

<?php
header("Location: validation.php");
} else {
?>

<script>
alert('Username is invalid. Please try again.');
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
    <link rel="stylesheet" href="assets/css/loginButton.css">
    <!--end of css design files-->
</head>
<!--The header of the registration page, which contains the logo of WCHC clinic. The link is directed to the
Main Page of the WCHC Clinic Website-->
<header>
    <div class="hero-image">
        <a href="index.html"><img src="assets/pp.png" width="50%"></a>
    </div>
</header>
<!--end of the header-->
 <body>
    <div class="bf">
        
        <form class="form" role="form" method="POST" accept-charset="UTF-8" >
            <h3>Forgot Password</h3>
            <h4>Enter your username</h4>
            <input type="text" id="username" name="icPatient" placeholder="Username" required autofocus autocomplete><br><br>
            <h5>Once you enter your username, an email will be sent to your email address with a verification code. Enter that code on the next page.</h5>
            <button class="button3" name="login" id="login" type="submit">Continue</button><br>
        </form>
    </div>
</body>  
</html>
