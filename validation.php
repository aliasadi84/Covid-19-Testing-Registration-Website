<?php
//connection to the database
include_once 'assets/conn/dbconnect.php';

session_start();
if(!isset($_SESSION['forgotSession']))
{
header("Location: ../index.php");
}
$usersession = $_SESSION['forgotSession'];
//If a patient session is already running without a loging out from the patient session,
//it will be directed toward patient.php(file) in patient(folder).
if (isset($_POST['resent']))
{
    $code = rand(999999, 111111);
    //patient username input
    $insert_code = "UPDATE patient SET validate = $code WHERE icPatient = '$usersession'";
    $run_query =  mysqli_query($con, $insert_code);
    $rep = mysqli_query($con,"SELECT * FROM patient WHERE icPatient = '$usersession'");
    $rov=mysqli_fetch_array($rep,MYSQLI_ASSOC);

    $to = $rov['patientEmail'];
    $subject = "Reset Email";
    $body ="Hello " .$rov['patientFirstName']. ",\n\nYou have requested for a password change in your Wayne County Healthy Communities!\n\nThe verification code: $code";
    $header = "From: from@email";
    if (mail($to, $subject, $body, $header))
    { ?>
        <script>
        alert('Validation code has been resent. Please find the code in your email.');
        </script>
    <?php
    }
    else
    { ?>
        <script>
        alert('Validation code could not be sent. Please try again.');
        </script>
    <?php
    }
}

if (isset($_POST['verify']))
{
//gets all the input during a form submission
$validate = mysqli_real_escape_string($con,$_POST['validate']);
//patient username input
$res = mysqli_query($con,"SELECT * FROM patient WHERE icPatient = '$usersession'");
$row=mysqli_fetch_array($res,MYSQLI_ASSOC);
//check and get if the username is present in the database.
//if statement check if password matches with what is present for the username.

if ($row['validate'] == $validate)
{
?>

<script type="text/javascript">
alert('Username is valid, please continue to the next process.');
</script>

<?php
header("Location: change_password.php");
} else {
?>

<script>
alert('Validation code is invalid. Please try again.');
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
    <a href="patientLogin.php" class="patientback"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
        <form class="form" role="form" method="POST" accept-charset="UTF-8" >
            <h3>Validate</h3>
            <h4>Enter your verification code</h4>
            <input type="text" id="validate" name="validate" placeholder="Verification Code" required autofocus autocomplete><br><br>

            <button class="button3" name="verify" id="verify" type="submit">Verify</button><br><br>
        </form>
        <form class="form" role="form" method="POST" accept-charset="UTF-8" >
            <button class="button3" name="resent" id="resent" type="submit">Resend Code</button>
        </form>
    </div>
</body>  
</html>
