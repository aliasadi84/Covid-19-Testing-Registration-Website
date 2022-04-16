<?php
include_once '../assets/conn/dbconnect.php';
// Get the variables staff username and active/inactive status.
$username = $_GET['username'];
$active = $_GET['active'];
//if-else statement to change status, if the status is active then the status will be made inactive vice-versa
if ($active == 'active'){
    $update = mysqli_query($con,"UPDATE staff SET active='inactive' WHERE icstaff='$username'");
    header("Location: staff.php");
}
else {
    $update = mysqli_query($con,"UPDATE staff SET active='active' WHERE icstaff='$username'");
    header("Location: staff.php");
}

?>