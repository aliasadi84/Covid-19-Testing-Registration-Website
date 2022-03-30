<?php
session_start();
include_once '../assets/conn/dbconnect.php';
if(!isset($_SESSION['doctorSession']))
//if your not login it will take you to the admin login
{
header("Location: ../adminlogin.php");
}
$usersession = $_SESSION['doctorSession'];
$res=mysqli_query($con,"SELECT * FROM doctor WHERE doctorId=".$usersession);
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);









if (isset($_POST['submit'])) {
//functionality to allow the admin to change first name, last name, phone, or email and save it into the database
$doctorFirstName = $_POST['doctorFirstName'];
$doctorLastName = $_POST['doctorLastName'];
$doctorPhone = $_POST['doctorPhone'];
$doctorEmail = $_POST['doctorEmail'];
$doctorAddress = $_POST['doctorAddress'];

//doing the changing
$res=mysqli_query($con,"UPDATE doctor SET doctorFirstName='$doctorFirstName', doctorLastName='$doctorLastName', doctorPhone='$doctorPhone', doctorEmail='$doctorEmail', doctorAddress='$doctorAddress' WHERE doctorId=".$_SESSION['doctorSession']);
// $userRow=mysqli_fetch_array($res);

//After update takes you to this page
header( 'Location: doctorprofile.php' ) ;

}





?>
<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<!-- NOTE FROM TIM: Please remove all references to outside source code like this -->
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <script src="https://kit.fontawesome.com/95c473646d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/loginButton.css">
	<link rel="stylesheet" href="../assets/css/table.css">
	<link rel="stylesheet" href="../assets/css/input.css">
</head>

<header>
    <div class="hero-image">
        <a href="patient.php"><img src="../assets/pp.png" width="50%"></a>
    </div>
</header>
<body>
<ul>
      <li><a href="doctordashboard.php">Dashboard</a></li>
      <li><a href="addresults.php">Add Result</a></li>
      <li><a href="patientlist.php">Patient List</a></li>
      <li><a href="staff.php">Staff List</a></li>
      <li><a class="active" href="doctorprofile.php">Your Account</a></li>
      <li style="float:right"><a href="logout.php?logout">Log Out</a></li>
    </ul>
    <form action="<?php $_PHP_SELF ?>" method="post" >
        <table>
            <tbody>
            <th colspan="7"><h2><?php echo $userRow['doctorFirstName']; ?> <?php echo $userRow['doctorLastName'];?>  </h2></th>
                <tr>
                    <td>First Name</td>
                    <td><input type="text" class="form-control" name="doctorFirstName" value="<?php echo $userRow['doctorFirstName']; ?>"  /></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><input type="text" class="form-control" name="doctorLastName" value="<?php echo $userRow['doctorLastName']; ?>"  /></td>
                </tr>

                <tr>
                    <td>Phone Number</td>
                    <td><input type="text" class="form-control" name="doctorPhone" value="<?php echo $userRow['doctorPhone']; ?>"  /></td>
                </tr>
                <tr>
                    <td>E-mail Address</td>
                    <td><input type="text" class="form-control" name="doctorEmail" value="<?php echo $userRow['doctorEmail']; ?>"  /></td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="submit" class="btn btn-info" value="Update Info"></td>
                    </tr>
                </tbody>
                
            </table>

        </form>




<!-- Sidebar code that needs to be removed -->
    </section>
        <script>
          let sidebar = document.querySelector(".sidebar");
          let closeBtn = document.querySelector("#btn");
          let searchBtn = document.querySelector(".bx-search");

          closeBtn.addEventListener("click", ()=>{
            sidebar.classList.toggle("open");
            menuBtnChange();
          });

          searchBtn.addEventListener("click", ()=>{ 
            sidebar.classList.toggle("open");
            menuBtnChange();
          });

          
          function menuBtnChange() {
          if(sidebar.classList.contains("open")){
            closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
          }else {
            closeBtn.classList.replace("bx-menu-alt-right","bx-menu");
          }
          }
          </script>

    </body>
</html>
