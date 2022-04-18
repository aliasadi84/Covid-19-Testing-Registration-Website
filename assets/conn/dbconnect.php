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

/* NOTE FROM LAST TEAM: When connecting to Google Cloud, comment out lines 16-21 */
/* and uncomment 2-11 */

$con = mysqli_connect("localhost","root","","wchc_database");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>
