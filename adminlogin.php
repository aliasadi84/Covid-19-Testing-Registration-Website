<?php
//connection to the database
include_once 'assets/conn/dbconnect.php';

session_start();
//If a clinic session is already running without loging out from the clinic session,
//it will be directed toward doctordashboard.php(file) in clinic(folder).
if (isset($_SESSION['doctorSession']) != "") {
header("Location: clinic/doctordashboard.php");
}
if (isset($_POST['login']))
{
$doctorId = mysqli_real_escape_string($con,$_POST['doctorId']);
//clinc staff username
$password  = mysqli_real_escape_string($con,$_POST['password']);
//clinic staff password
$res = mysqli_query($con,"SELECT * FROM doctor WHERE doctorId = '$doctorId'");
//check and get if the username is present in the database.
$row=mysqli_fetch_array($res,MYSQLI_ASSOC);
//if statement check if password matches with what is present for the username.
if ($row['password'] == $password)
{
$_SESSION['doctorSession'] = $row['doctorId'];
//error checking
?>
<script type="text/javascript">
alert('Login Success');
</script>
<?php
header("Location: clinic/doctordashboard.php");
} else {
?>
<script type="text/javascript">
    alert("Wrong input");
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
        <form class="form" role="form" method="POST" accept-charset="UTF-8">
            <!--The text field to enter the Username-->
            <label>username</label><br>
            <input name="doctorId" type="text" placeholder="Doctor ID" required><br>
            <!--The text field to enter the Password-->
            <label>password</label><br>
            <input name="password" type="password" placeholder="Password" required><br><br>
            <!--Log-in button to submit the form-->
            <button class="button3" type="submit" name="login">Login</button>
        </form>
    </div>

</body>
</html>