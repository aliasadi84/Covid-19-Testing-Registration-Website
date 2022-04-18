<?php

//require_once __DIR__ . '/vendor/autoload.php';
ini_set('allow_url_fopen',1);
switch (@parse_url($_SERVER['REQUEST_URI'])['path']) {
    case '/':
        require 'index.html';
        break;
    case '/index':
        require 'index.html';
        break;
    case '/index.html':
        require 'index.html';
        break;
    case '/adminlogin':
        require 'adminlogin.php';
        break;
     case '/clinicloginselect.html':
        require 'clinicloginselect.html';
        break;
    case '/forgot_password.php':
        require 'forgot_password.php';
        break;
     case '/patientLogin.php':
        require 'patientLogin.php';
        break;
    case '/reg.html':
        require 'reg.html';
        break;
    case '/regconfirmation.html':
        require 'regconfirmation.html';
        break;
    case '/stafflogin.php':
        require 'stafflogin.php';
        break;
    case '/validation.php':
        require 'validation.php';
        break;
    case '/change_password.php':
        require 'change_password.php';
        break;
    case '/confirmchangepass.html':
        require 'confirmchangepass.html';
        break;
    case '/getuser.php':
        require 'getuser.php';
        break;


    case '/patient/patient.php':
        require 'patient/patient.php';
        break;
    case '/patient/profile.php':
        require 'patient/profile.php';
        break;
    case '/patient/patientapplist.php':
        require 'patient/patientapplist.php';
        break;
    case '/patient/patientlogout.php':
        require 'patient/patientlogout.php';
        break;
    case '/patient/appo.php':
        require 'patient/appo.php';
        break;
    case '/patient/getschedule.php':
        require 'patient/forgot_password.php';
        break;
    case '/patient/appointment.php':
        require 'patient/appointment.php';
        break;
    case '/patient/appconfirmation.php':
        require 'patient/appconfirmation.php';
        break;
    case '/patient/check_in.php':
        require 'patient/check_in.php';
        break;
    case '/patient/cancelappt.php':
        require 'patient/cancelappt.php';
        break;
    case '/patient/cancelconf.html':
        require 'patient/cancelconf.html';
        break;
    case '/patient/checkinconf.html':
        require 'patient/checkinconf.html';
        break;
    case '/patient/results.php':
        require 'patient/results.php';
        break;
    
    
    case '/staff/addresults.php':
        require 'staff/addresults.php';
        break;
    case '/staff/checkdb.php':
        require 'staff/checkdb.php';
        break;
    case '/staff/doctordashboard.php':
        require 'staff/doctordashboard.php';
        break;
    case '/staff/doctorprofile.php':
        require 'patient/patientlogout.php';
        break;
    case '/staff/logout.php':
        require 'staff/logout.php';
        break;
    case '/staff/nresultdb.php':
        require 'staff/nresultdb.php';
        break;
    case '/staff/patientlist.php':
        require 'staff/patientlist.php';
        break;
    case '/staff/resultdb.php':
        require 'staff/resultdb.php';
        break;



    case '/clinic/active.php':
        require 'clinic/active.php';
        break;
    case '/clinic/addresults.php':
        require 'clinic/addresults.php';
        break;
    case '/clinic/checkdb.php':
        require 'clinic/checkdb.php';
        break;
    case '/clinic/doctordashboard.php':
        require 'clinic/doctordashboard.php';
        break;
    case '/clinic/doctorprofile.php':
        require 'clinic/doctorprofile.php';
        break;
    case '/clinic/editstaff.php':
        require 'clinic/editstaff.php';
        break;
    case '/clinic/logout.php':
        require 'clinic/logout.php';
        break;
    case '/clinic/nresultdb.php':
        require 'clinic/nresultdb.php';
        break;
    case '/clinic/patientlist.php':
        require 'clinic/patientlist.php';
        break;
    case '/clinic/resultdb.php':
        require 'clinic/resultdb.php';
        break;
    case '/clinic/staff.php':
        require 'clinic/staff.php';
        break;
    case '/clinic/staffconnection.php':
        require 'clinic/staffconnection.php';
        break;
    case '/clinic/staffCreation.php':
        require 'clinic/staffCreation.php';
        break;
    case '/clinic/staffpatientlist.php':
        require 'clinic/staffpatientlist.php';
        break;
    
    
    default:
        http_response_code(404);
        echo @parse_url($_SERVER['REQUEST_URI'])['path'];
        exit('Not Found');
}


?>
