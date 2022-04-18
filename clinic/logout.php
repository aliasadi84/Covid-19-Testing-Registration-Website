<?php
//log-out session
session_start();

if(!isset($_SESSION['AdminSession']))
{
 header("Location: doctordashboard.php");
}
else if(isset($_SESSION['AdminSession'])!="")
{
 header("Location: ../index.html");
}

if(isset($_GET['logout']))
{
 session_destroy();
 unset($_SESSION['AdminSession']);
 header("Location: ../index.html");
}
?>