<?php
session_start();

if(!isset($_SESSION['staffSession']))
{
 header("Location: doctordashboard.php");
}
else if(isset($_SESSION['staffSession'])!="")
{
 header("Location: ../index.html");
}

if(isset($_GET['logout']))
{
 session_destroy();
 unset($_SESSION['staffSession']);
 header("Location: ../index.html");
}
?>
