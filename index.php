<?php
include_once 'assets/conn/dbconnect.php';

session_start();

if (isset($_SESSION['patientSession']) != "") {
header("Location: patient/patient.php");
}

if (isset($_POST['login']))
{

$icPatient = mysqli_real_escape_string($con,$_POST['icPatient']);
$password  = mysqli_real_escape_string($con,$_POST['password']);

$res = mysqli_query($con,"SELECT * FROM patient WHERE icPatient = '$icPatient'");
$row=mysqli_fetch_array($res,MYSQLI_ASSOC);

if ($row['password'] == $password)
{
$_SESSION['patientSession'] = $row['icPatient'];

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
    <script src="https://kit.fontawesome.com/95c473646d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="assets/css/submit.css">
    <link rel="stylesheet" href="assets/css/account.css"> 
</head>
      
<header>
    <div class="hero-image">
        <a href="https://www.waynecountyhealthy.com" ><img src="assets/img/pp.png" width="100%"></a>
    </div>
</header>

 <body>
    <div class="bf">

        <form class="form" role="form" method="POST" accept-charset="UTF-8" >
            <h1>Log In</h1>

            <label for="icPatient">Username</label><br>
            <input type="text" id="username" name="icPatient" placeholder="Username" required autofocus autocomplete><br>
            
            <label for="password">Password</label><br>
            <input type="password" id="password" name="password" placeholder="Password" required autofocus autocomplete>
            
            <h4><a href="">Forgot password?</a></h4>
           
            <button class="button3" name="login" id="login" type="submit"> Login</button><br>
           
            <a href = 'reg.html'>Register Here!</a>
    
        </form>

    </div>

</body>  
</html>