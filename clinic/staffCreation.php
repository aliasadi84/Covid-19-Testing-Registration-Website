<!-- <?php
session_start();
include_once '../assets/conn/dbconnect.php';
if(!isset($_SESSION['doctorSession']))
{
//if not logged into the admin side it will direct you to the index
header("Location: ../index.html");
}
$usersession = $_SESSION['doctorSession'];
//Checking the doctor ID making sure it's still there
$res=mysqli_query($con,"SELECT * FROM doctor WHERE doctorId=".$usersession);
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);
?> -->

<!DOCTYPE HTML>

<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <!--css design files-->
    <script src="https://kit.fontawesome.com/95c473646d.js" crossorigin="anonymous"></script>
    <!--fontawesome link that connects fontawesome with the page-->
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/loginButton.css">
    <!--end of css deesign files-->
</head>

<!--The header of the registration page, which contains the logo of WCHC clinic. The link is directed to the
Main Page of the WCHC Clinic Website-->
<header>
    <div class="hero-image">
        <a href="doctordashboard.php"><img src="../assets/pp.png" width="50%"></a>
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
        <form method="post" action="staffconnection.php" autocomplete="on">
            
            <!--A heading reminding the user that all fields are required-->
            Create Staff Account<br><br>
            All Fields are Required<br>

            <!--The text field to enter the First Name-->
            <label for="staffFirstName">First Name</label><br>
            <input type="text" id="staffFirstName" name="staffFirstName" placeholder="First Name" required autofocus autocomplete><br>
            <!--This text field is set to be required, autofocused, and also autocomplete-->
            <!--The text field to enter the Last Name-->
            <label for="staffLastName">Last Name</label><br>
            <!--This text field is set to be required, autofocused, and also autocomplete-->
            <input type="text" id="staffLastName" name="staffLastName" placeholder="Last Name" required autofocus autocomplete><br>
            <!--This is a section to enter the gender of the patient, it uses radio button as a way to choose gender-->
            <!-- <label>Gender Assigned at Birth</label><br> -->
            <!--The selection to choose 'Male' for gender option-->

            <div class="radioAlign">
            <!-- <input type="radio" id="male" name="patientGender" value="male">
            <label for="male">Male</label><br> -->
            <!--The selection to choose 'Female' for gender option-->
            <!-- <input type="radio" id="female" name="patientGender" value="female">
            <label for="female">Female</label><br> -->
            </div>

            <!--This is a section to enter the date of birth of the patient, it uses date type as a way to choose Date of Birth-->
            <label for="staffDOB">Date of Birth</label><br>
            <!--Choose the date for the date of birth-->
            <input type="date" id="staffDOB" name="staffDOB" placeholder="Date of Birth" required autofocus autocomplete><br>
 


           <!--This is a section to enter the race of the patient, it uses dropdown as a way to choose Race-->
           <!-- <label for="race">Race/Ethnicity</label><br>
            <select id = "race" name="race">
              <option value="Race/Ethnicity"  selected disabled hidden>Race/Ethnicity</option>
	          <option value="white">White</option>
              <option value="arab">Arab</option>
	          <option value="asian">Asian</option>
              <option value="black">Black/African American</option>
              <option value="indo">Indo-Aryan</option>
              <option value="other">Other</option>
            </select> -->
            

            <!--This is a section to enter the Email Address of the patient, it uses a text field as a way to enter the Email Address-->
            <label for="staffEmail">E-Mail Address</label><br>
            <!--This text field is set to be required, autofocused, and also autocomplete-->
            <input type="email" id="staffEmail" name="staffEmail" placeholder="E-Mail Address" required autofocus autocomplete><br>
            
            <!--This is a section to enter the Phone Number of the patient, it uses a text field as a way to enter the Phone Number-->
            
            <label for="staffPhone">Phone Number</label><br>
            <!--This text field is set to be required, autofocused, and also autocomplete-->
            <input type="tel" id="staffPhone" name="staffPhone" placeholder="Phone Number" required autofocus autocomplete>
            
            <!--This is a section to enter the Phone Number of the patient, it uses a text field as a way to enter the Phone Number-->
            <br><label for="icstaff">Username</label><br>
            <!--This text field is set to be required and autofocused-->
            <input type="icstaff" id="icstaff" name="icstaff" placeholder="Username" required autofocus><br>

            <!--This is a section to enter the Phone Number of the patient, it uses a text field as a way to enter the Phone Number-->
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
          <button class="button3" type="submit" onclick="validatePassword()">Register</button>
          
    </form>
    <!--The form ends here-->
    </div>
    <!--div class 'bf' ends here-->
    
    </body>
    <!--body for the registration page ends here-->

</html>

<!--All the input's of the registration is sent to 'connection.php' which is located at the same directory as this file.
    In 'connection.php' these inputs will be entered to the database after checking if the username exists.-->
