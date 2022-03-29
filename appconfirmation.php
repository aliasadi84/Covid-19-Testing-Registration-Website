<?php

session_start();
include_once '../assets/conn/dbconnect.php';

if(!isset($_SESSION['patientSession']))
{
header("Location: ../index.php");
}
$usersession = $_SESSION['patientSession'];

$res=mysqli_query($con,"SELECT * FROM patient WHERE icPatient = '$usersession'");

$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);

?>



<!DOCTYPE html>

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
<header>
    <div class="hero-image">
        <a href="../index.php" ><img src="assets/img/pp.png" width="100%"></a>
        <!--The image is located inside the assets(folder) -> img(folder) -> pp.png -->    
    </div>
</header>
<main>
<h1>Your appointment has been scheduled!</h1><br>
<?php
    echo "<h1>Your appointment will be on " .  $appdate  . " at " $apptime . "</h1>"
    echo "<h1>An confirmation email has be sent to " . $useremail . "</h1>""
    // Change the variable names as needed
?>
</main>
</html>