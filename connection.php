<?php
    
    include_once 'assets/conn/dbconnect.php';
        
        // Check connection
        if (mysqli_connect_errno())
        {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        
    
        // collect value of input field
        $patientFirstName = $_REQUEST['patientFirstName'];
        $patientLastName = $_REQUEST['patientLastName'];
        $patientGender = $_REQUEST['patientGender'];
        $patientDOB = $_REQUEST['patientDOB'];
        $race = $_REQUEST['race'];
        $patientEmail = $_REQUEST['patientEmail'];
        $icPatient = $_REQUEST['icPatient'];
        $password = $_REQUEST['password'];
        $patientPhone = $_REQUEST['patientPhone'];
        
        $sql = "INSERT INTO patient VALUES ('$icPatient', '$password', '$patientFirstName', '$patientLastName', '$patientDOB', '$patientGender','$patientPhone', '$patientEmail', '$race', NULL)";
            
        if(mysqli_query($con, $sql)){
            
                header("location: regconfirmation.html"); 

            } else{
                echo "ERROR: Hush! Sorry $sql. " 
                    . mysqli_error($con);
            }
        
        mysqli_close($con);
?>
