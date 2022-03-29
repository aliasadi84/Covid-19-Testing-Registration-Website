<?php

// session_start();
// include_once '../assets/conn/dbconnect.php';
// $session= $_SESSION['patientSession'];

// $to = "recipient email";
// $subject = "Subject for the email";
// $body = "Hi test person, This is test email.";
// $header = "From: from@email";
 
// if ( mail($to, $subject, $body, $header)) {
//       echo("Success");
//    } else {
//       echo("Failed");
//    }



// $today = date("m\/d\/Y");  // todays system date
// $date_ = mktime(0, 0, 0, date("m"), date("d")+1, date("Y")); // adding specific number of days to date to get reminder of subscription expiration.
// $tomorrow = date("m/d/Y", $date_);  //formatting the date time according to your database format
// $Renewal = (string)$tomorrow;

// $ordernumber="";
// $conn = mysql_connect($dbhost, $dbuser, $dbpass); 
// if(!$conn) { 
// die('Failed to connect to server: ' . mysql_error()); 
// } 
// mysql_select_db($dbname); 
// $sql="SELECT * FROM tableName WHERE Renewal = '".$Renewal."'"; 
// $result = mysql_query($sql); 

// $email = "seniorprojectwchc@gmail.com"; 
// $emailto = $patientEmail; 
// $subject = "Customer Subscription information"; 
// $headers = "From: $email" . "\r\n"; 

// while($row=mysql_fetch_array($result)) { 
// $body .= " \n "
// ."Following are the people whoes subscription will expire tomorrow"." \n "." \n "
// ."First Name : ".$row['FirstName']." \n "
// ."Last Name : ".$row['LastName'] ." \n "
// ."Email : ".$row['Email'] ." \n "
// ."Address : ".$row['Address'] ." \n "
// ."Country : ".$row['Country'] ." \n "
// ."Phone No. : ".$row['PhoneNo'] ." \n "
// ."Product : ".$row['Product'] ." \n "
// ."Version : ".$row['Version'] ." \n "
// ."Renwal Date : ".$row['Renewal']. "\n"
// ."\n". "\n". "==============================". "\n"; 
// } 

// // send email 
// if(mysql_num_rows($result) > 0)
// {
// $send = mail($emailto, $subject . ' ' . $ordernumber, $body, $headers); 
// }
// mysql_close($conn); 


$to = "baraka22900@gmail.com";
$subject = "This is subject";

$message = "<b>This is HTML message.</b>";
$message .= "<h1>This is headline.</h1>";

$header = "From:abc@somedomain.com \r\n";
$header .= "Cc:afgh@somedomain.com \r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html\r\n";

mail($to,$subject,$message,$header);

// ini_set("SMTP","ssl://smtp.gmail.com");
// ini_set("smtp_port","465");

// if (mail($to_email, $subject, $body, $headers)) {
//     echo "Email successfully sent to $to_email...";
// } else {
//     echo "Email sending failed...";
// }
// ?>
<!-- <button type="submit" mail="form1" value="Submit">Submit</button> -->


