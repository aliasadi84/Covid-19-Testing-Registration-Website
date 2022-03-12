<?php
include_once 'assets/conn/dbconnect.php';

session_start();
if (isset($_SESSION['doctorSession']) != "") {
header("Location: clinic/doctordashboard.php");
}
if (isset($_POST['login']))
{
$doctorId = mysqli_real_escape_string($con,$_POST['doctorId']);
$password  = mysqli_real_escape_string($con,$_POST['password']);

$res = mysqli_query($con,"SELECT * FROM doctor WHERE doctorId = '$doctorId'");

$row=mysqli_fetch_array($res,MYSQLI_ASSOC);
// echo $row['password'];
if ($row['password'] == $password)
{
$_SESSION['doctorSession'] = $row['doctorId'];
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
<script src="https://kit.fontawesome.com/95c473646d.js" crossorigin="anonymous"></script>

<link rel="stylesheet" href="main.css">
<link rel="stylesheet" href="assets/css/submit.css">
<link rel="stylesheet" href="assets/css/account.css">      <!-- account specific css -->
</head>
      
<header>
    <div class="hero-image">
        <a href="https://www.waynecountyhealthy.com" ><img src="assets/img/pp.png" width="100%"></a>
    </div>
</header>
      
<script>
    function checkLoggedIn() {
        if (loggedIn)
          window.location.href = "account.html";
        else
            window.location.href = "login.html";
    }
</script>

 <body>
    <div class="bf">
                        <form class="form" role="form" method="POST" accept-charset="UTF-8">
                            <label>username</label><br>
                            <input name="doctorId" type="text" placeholder="Doctor ID" required><br>
                            <label>password</label><br>
                            <input name="password" type="password" placeholder="Password" required><br><br>
                            <button class="button3" type="submit" name="login">Login</button>
                        </form>
                    </div>
                </div>
            <!-- end -->
        </div>
    </body>
</html>