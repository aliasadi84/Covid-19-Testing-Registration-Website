<?php
//connection to the database
include_once 'assets/conn/dbconnect.php';

session_start();
if(!isset($_SESSION['forgotSession']))
{
header("Location: ../index.php");
}
$usersession = $_SESSION['forgotSession'];
//If a patient session is already running without a loging out from the patient session,
//it will be directed toward patient.php(file) in patient(folder).

if (isset($_POST['change']))
{
//gets all the input during a form submission
$password = mysqli_real_escape_string($con,$_POST['password']);
$insert_code = "UPDATE patient SET password = '$password' WHERE icPatient = '$usersession'";
$run_query =  mysqli_query($con, $insert_code);
$res = mysqli_query($con,"SELECT * FROM patient WHERE icPatient = '$usersession'");
$row=mysqli_fetch_array($res,MYSQLI_ASSOC);
//check and get if the username is present in the database.
//if statement check if password matches with what is present for the username.

if ($row['password'] == $password)
{
?>

<script type="text/javascript">
alert('Password has been renewed. Please try logging in!');
</script>

<?php
header("Location: patientLogin.php");
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
    <link rel="stylesheet" href="assets/css/loginButton.css">
    <!--end of css deesign files-->
</head>

<!--The header of the registration page, which contains the logo of WCHC clinic. The link is directed to the
Main Page of the WCHC Clinic Website-->
<header>
    <div class="hero-image">
        <a href="index.html"><img src="assets/pp.png" width="50%"></a>
    </div>
</header>
<!--end of the header-->


<!--This script is used to validate the Passwords before registering the account.-->
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
                //if the value for password and confirm password is a match. No error message will pop up and will be directed to registering their accont.
				confirm_password.setCustomValidity('');
			}	
			confirm_password.onkeyup = checkMatching;
		}
    
    </script>
    <!--end of the password validation script-->

    <!--header stating that it is a Registration page-->
      
    <!--end of the header-->

    <!--body of the page is beginning here-->
    <body>
    
    <!--A div class 'bf' is created to contain all the rest of the page content in a box-->
    <div class="bf">

        <!--The form for registration starts here, upon submission of this form it is first incorperates
        the password validation and then is send to connection.php to register the account-->
        <form class="form" role="form" method="POST" accept-charset="UTF-8" >
            
            <!--A heading reminding the user that all fields are required-->
            <h1>Enter New Password:</h1>
            <h4>All Fields are Required</h4>
            <h5>Requires at least 8 characters, including at least one uppercase, one number, and one special character</h5><br>
            <label for="password">Password</label><br>
            <!--This text field is set to be required-->
            <input type="password" id="password" name="password" placeholder="Password" required><br>

            <!--This is a section to enter the Phone Number of the patient, it uses a text field as a way to enter the Phone Number-->
            <label for="password">Confirm Password</label><br>
            <!--This text field is set to be required-->
            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Re-enter Password" required><br>
        
        
        <br>
          <!--By clicking the submit button, it will check if all required fields have an input and also is sent
              to validate if the password meets requirement and also if the password and confirm password is a match.-->
              <button class="button3" type="submit" name="change" onclick="validatePassword()">Register</button><br>
          
    </form>
    <!--The form ends here-->
    </div>
    <!--div class 'bf' ends here-->
    
    </body>
    <!--body for the registration page ends here-->

</html>