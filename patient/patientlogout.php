<?php
session_start();
//logout session

if(!isset($_SESSION['patientSession']))
{
 header("Location: patientdashboard.php");
}
else if(isset($_SESSION['patientSession'])!="")
{
 header("Location: ../index.html");
}

if(isset($_GET['logout']))
{
 session_destroy();
 unset($_SESSION['patientSession']);
 header("Location: ../index.html");
}
?>
