<?php
include_once '../assets/conn/dbconnect.php';
// Get the variables.
$username = $_GET['username'];
$active = $_GET['active'];
if ($active == 'active'){
    $update = mysqli_query($con,"UPDATE staff SET active='inactive' WHERE icstaff='$username'");
    header("Location: staff.php");
}
else {
    $update = mysqli_query($con,"UPDATE staff SET active='active' WHERE icstaff='$username'");
    header("Location: staff.php");
}

?>