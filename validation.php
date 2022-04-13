<?php
//connection to the database
include_once 'assets/conn/dbconnect.php';
session_start();

//if the user has not finished the step to enter username, it will be redirected to index.html
if(!isset($_SESSION['forgotSession']))
{
header("Location: ./index.html");
}

//username of the patient is gathered.
$usersession = $_SESSION['forgotSession'];

//if the user click the re-sent button a new verification code is entered to database.
if (isset($_POST['resent']))
{
    //a new random six-digit verification code is created and stored to database.
    $code = rand(999999, 111111);
    $insert_code = "UPDATE patient SET validate = $code WHERE icPatient = '$usersession'";
    $run_query =  mysqli_query($con, $insert_code);

    //information of the patient is taken from the database.
    $rep = mysqli_query($con,"SELECT * FROM patient WHERE icPatient = '$usersession'");
    $rov=mysqli_fetch_array($rep,MYSQLI_ASSOC);

    //a mail is sent with the new verification code.
    $to = $rov['patientEmail'];
    $subject = "Reset Email";
    $body ="Hello " .$rov['patientFirstName']. ",\n\nYou have requested for a password change in your Wayne County Healthy Communities!\n\nThe verification code: $code";
    $header = "From: from@email";

    //if-else statement to verify if the validation code is sent to the patient email.
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

//if the user click the verify button the code entered is validated with what is on database.
if (isset($_POST['verify']))
{
//gets the information present for the username.
$validate = mysqli_real_escape_string($con,$_POST['validate']);
$res = mysqli_query($con,"SELECT * FROM patient WHERE icPatient = '$usersession'");
$row=mysqli_fetch_array($res,MYSQLI_ASSOC);

//if-else statement check if validation code matches with what is present in the database.

if ($row['validate'] == $validate)
{
?>

<script type="text/javascript">
alert('Validation code is valid, please continue to entering the new password.');
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
    <link rel="stylesheet" href="assets/css/loginButton.css">
    <!--end of css design files-->
</head>
<!--The header of the validation page, which contains the logo of WCHC clinic. The link is directed to the
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
            <h3>Validate</h3>
            <!--Verification code text-field-->
            <h4>Enter your verification code</h4>
            <input type="text" id="validate" name="validate" placeholder="Verification Code" required autofocus autocomplete><br><br>
            <!--Verify button-->
            <button class="button3" name="verify" id="verify" type="submit">Verify</button><br><br>
        </form>
        <form class="form" role="form" method="POST" accept-charset="UTF-8" >
            <!--Re-sent Verification code button-->
            <button class="button3" name="resent" id="resent" type="submit">Resend Code</button>
        </form>
    </div>
</body>  
</html>