<?php
/*$user=getenv('CLOUDSQL_USER');
$pass=getenv('CLOUDSQL_PASSWORD');
$inst=getenv('CLOUDSQL_DSN');
$db=getenv('CLOUDSQL_DB');
$con = mysqli_connect(null,$user,$pass,$db,null,$inst);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }*/

/* NOTE FROM LAST TEAM: When connecting to Google Cloud, comment out lines 15-20 */
/* and uncomment 2-11 */

$con = mysqli_connect("localhost","root","","sourcecodester_dadb");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>
