<?php
    
    include_once '../assets/conn/dbconnect.php';
        
        // Check connection
        if (mysqli_connect_errno())
        {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        
    
        // collect value of input field
        $staffFirstName = $_REQUEST['staffFirstName'];
        $staffLastName = $_REQUEST['staffLastName'];
        $staffDOB = $_REQUEST['staffDOB'];
        $staffEmail = $_REQUEST['staffEmail'];
        $icstaff = $_REQUEST['icstaff'];
        $password = $_REQUEST['password'];
        $staffPhone = $_REQUEST['staffPhone'];
        $active = 'active';
        $check = mysqli_query($con,"SELECT * FROM staff WHERE icstaff='$icstaff'");
        $row = mysqli_num_rows($check);
        if ($row > 0) {
            echo '<script>';
            echo 'alert("The username already exist! Please try another...");';
            echo 'window.location.href = "staffCreation.php";';
            echo '</script>';

            die();
        }
        else{
        $sql = "INSERT INTO staff VALUES ('$icstaff', '$password', '$staffFirstName', '$staffLastName', '$staffPhone','$staffEmail', '$staffDOB','$active')";
            
        if(mysqli_query($con, $sql)){
            
                header("location: staff.php"); 

            } else{
                echo "ERROR: Hush! Sorry $sql. " 
                    . mysqli_error($con);
            }
        }
        mysqli_close($con);
?>
