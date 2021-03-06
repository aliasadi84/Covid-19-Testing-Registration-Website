<?php
//connection to the database
include_once 'assets/conn/dbconnect.php';

session_start();
//If a clinic session is already running without loging out from the clinic session,
//it will be directed toward doctordashboard.php(file) in clinic(folder).
if (isset($_SESSION['AdminSession']) != "") {
header("Location: clinic/doctordashboard.php");
}
if (isset($_POST['login']))
{
$AdminId = mysqli_real_escape_string($con,$_POST['AdminId']);
//clinc staff username
$password  = mysqli_real_escape_string($con,$_POST['password']);
//clinic staff password
$res = mysqli_query($con,"SELECT * FROM admin WHERE AdminId = '$AdminId'");
//check and get if the username is present in the database.
$row=mysqli_fetch_array($res,MYSQLI_ASSOC);
//if statement check if password matches with what is present for the username.
if ($row['password'] == $password)
{
$_SESSION['AdminSession'] = $row['AdminId'];
//error checking
echo '<script>';
echo 'window.location.href = "clinic/doctordashboard.php";';
echo '</script>';
} else {
    echo '<script>';
    echo 'alert("Username or password incorrect. Please try again.");';
    echo 'window.location.href = "adminlogin.php";';
    echo '</script>';
}
}
?>

<!DOCTYPE HTML>

<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <script src="https://kit.fontawesome.com/95c473646d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/button.css">
    <link rel="stylesheet" href="assets/css/account.css">
</head>

<header>
    <div class="hero-image">
        <a href="index.html"><img src="assets/pp.png" width="50%"></a>
    </div>
</header>
<!--end of the header-->
      

<body>
    <div class="bf">
    <a href="clinicloginselect.html" class="patientback"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
        <h2>Administrator Login</h2>
        <form class="form" role="form" method="POST" accept-charset="UTF-8">
            <!--The text field to enter the Username-->
            <label>Username</label><br>
            <input name="AdminId" type="text" placeholder="Admin Username" required><br>
            <!--The text field to enter the Password-->
            <label>Password</label><br>
            <input name="password" type="password" placeholder="Password" required><br><br>
            <!--Log-in button to submit the form-->
            <button class="button3" type="submit" name="login">Login</button>
        </form>
    </div>

</body>
</html>
