<?php
//connection to the database
include_once 'assets/conn/dbconnect.php';

session_start();

//if the patient has not verified using verification code, the page is directed toward the main page. 
if(!isset($_SESSION['forgotSession']))
{
header("Location: ../index.php");
}
$usersession = $_SESSION['forgotSession'];


if (isset($_POST['change']))
{
//gets all the input during a form submission
$password = mysqli_real_escape_string($con,$_POST['password']);
$insert_code = "UPDATE patient SET password = '$password' WHERE icPatient = '$usersession'";
$run_query =  mysqli_query($con, $insert_code);
$res = mysqli_query($con,"SELECT * FROM patient WHERE icPatient = '$usersession'");
$row=mysqli_fetch_array($res,MYSQLI_ASSOC);
//get user details of the patient.
//if-else statement to check if password matches with what is present in the database for the username.

if ($row['password'] == $password)
{
?>

<script type="text/javascript">
alert('Password has been renewed!');
</script>

<?php
header("Location: confirmchangepass.html");
} else {
?>

<script>
alert('Password cannot be renewed. Please try again!');
</script>

<?php
}
}
?>
<!DOCTYPE HTML>

<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <!--css design files-->
    <script src="https://kit.fontawesome.com/95c473646d.js" crossorigin="anonymous"></script>
    <!--fontawesome link that connects fontawesome with the page-->
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/button.css">
    <!--end of css deesign files-->
</head>

<!--The header of the change_password page, which contains the logo of WCHC clinic. The link is directed to the
Main Page of the WCHC Clinic Website-->
<header>
    <div class="hero-image">
        <a href="index.html"><img src="assets/pp.png" width="50%"></a>
    </div>
</header>
<!--end of the header-->


<!--This script is used to validate the Passwords before changing the password.-->
<script type="text/javascript">
		
	
    function validatePassword() {
			var password = document.getElementById("password")
            //Validates if the password contains at least 8 characters with at least 1 uppercase letter [A-Z], 1 lowercase letter[a-z], 1 digit[0-9]
            if (password.value.match(/[a-z]/g) && password.value.match(/[A-Z]/g) && password.value.match(/[0-9]/g) && password.value.match(/[^a-zA-Z\d]/g) && password.value.length >= 8) {
                //if the password requirement is valid there wont be any error message that pop up and it will call for the function checkmatching()
                password.setCustomValidity('');
				checkMatching();
			}
            else {
                //if the password is not valid an error message pop-up and the password should be checked again after a change
                password.setCustomValidity("Password doesn't meet minimum requirements");
				password.onchange = validatePassword;
			}				
			
		}

		function checkMatching() { 
			var confirm_password = document.getElementById("confirmPassword");
            //Validates if the password and confirm password is a match.
			if (password.value != confirm_password.value) {
                //if the value for password and confirm password is not a match. A error message pop-up stating that the passwor is not a match.
				confirm_password.setCustomValidity("Passwords don't match");
			} 
			else {
                //if the value for password and confirm password is a match. No error message will pop up and will be directed to changing password of their account.
				confirm_password.setCustomValidity('');
			}	
			confirm_password.onkeyup = checkMatching;
		}
    
    </script>

    <body>
    
    <!--A div class 'bf' is created to contain all the rest of the page content in a box-->
    <div class="bf">

        <!--The form for changing password starts here, upon submission of this form it is first incorperates
        the password validation and then the password is changed-->
        <form class="form" role="form" method="POST" accept-charset="UTF-8" >
            
            <h1>Change Password</h1>
            <!--A heading reminding the password requirement-->
            <h5>Requires at least 8 characters, including at least one uppercase, one number, and one special character</h5><br>
            <label for="password">Password</label><br>
            <!--This text field is set to be required-->
            <input type="password" id="password" name="password" placeholder="Password" required><br>

            <label for="password">Confirm Password</label><br>
            <!--This text field is set to be required-->
            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Re-enter Password" required><br>
        
        
        <br>
          <!--By clicking the submit button, it will check if all required fields have an input and also is sent
              to validate if the password meets requirement and also if the password and confirm password is a match.-->
              <button class="button3" type="submit" name="change" onclick="validatePassword()">Update</button><br>
          
    </form>
    <!--The form ends here-->
    </div>
    <!--div class 'bf' ends here-->
    
    </body>
    <!--body for the registration page ends here-->

</html>
