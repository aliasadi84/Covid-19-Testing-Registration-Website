<?php
session_start();
//connection to the database
include_once '../assets/conn/dbconnect.php';

if(!isset($_SESSION['patientSession']))
{
//if not logged into the staff side it will direct you to the index.html
header("Location: ../index.html");
}
//get's the apointment id -> $_GET['username']
$userid = $_GET['username'];
//delete from the bookings table by getting the appointment id -> "WHERE id='$userid'"
$update = mysqli_query($con,"DELETE FROM bookings WHERE id='$userid'");
//the page re-directs to patientapplist.php
header("Location: patientapplist.php");



?>