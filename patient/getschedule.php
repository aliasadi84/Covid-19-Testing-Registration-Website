<?php
$mysqli = new mysqli('localhost', 'root', '', 'sourcecodester_dadb');
//get's the chosen date from appo.php
if(isset($_GET['q'])){
    $date = $_GET['q'];
    $stmt = $mysqli->prepare("select * from bookings where date = ? ");
    $stmt->bind_param('s', $date);
    $bookings = array();
    if($stmt->execute()){
        $result = $stmt->get_result();
    }
}
date_default_timezone_set('America/Detroit');
//make sure the start time is 20 minute after the current time if the date is equal to todays date.
$today = date('Y-m-d');
if ($today == $date && date("H") >= 9 ){

    $ba = date ('i');
    $ba = ($ba % 10) - 20;
    $start = date ('H:i', strtotime("-$ba minute"));
    $start = date ("$start", strtotime("+20 minute"));
    $duration = 10;
    $cleanup = 0;
    $end = "15:00";
}
else{
    $duration = 10;
    $cleanup = 0;
    $start = "09:00";
    $end = "15:00";
}
//populate timeslots
function timeslots($duration, $cleanup, $start, $end){
    $start = new DateTime($start);
    $end = new DateTime($end);
    $interval = new DateInterval("PT".$duration."M");
    $cleanupInterval = new DateInterval("PT".$cleanup."M");
    $slots = array();
    for($intStart = $start; $intStart<$end; $intStart->add($interval)->add($cleanupInterval)){
        $endPeriod = clone $intStart;
        $endPeriod->add($interval);
        if($endPeriod>$end){
            break;
        }
        
        $slots[] = $intStart->format("g:iA")." - ". $endPeriod->format("g:iA");
        
    }
    return $slots;
}



?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <!--css design files-->
    <script src="https://kit.fontawesome.com/95c473646d.js" crossorigin="anonymous"></script>
    <!--fontawesome link that connects fontawesome with the page-->
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/button.css">
    <!--end of css design files-->
</head>

  <body>
    <div class="container">
        <!--new date is displayed-->
        <h1 class="text-center">Book for Date: <?php echo date('F d, Y', strtotime($date)); ?></h1><hr>
        <div class="row">
        <div class="col-md-12">
        <?php echo(isset($msg))?$msg:"";?>
        </div>
        <!--Remove any timeslots that are already booked-->
        <?php $timeslots = timeslots($duration, $cleanup, $start, $end); 
            $res = "SELECT * FROM bookings WHERE date ='$date'";
            $result = $mysqli -> query($res);
            
            if (!$res) {
                echo '<script>';
                echo 'alert("No data have been stored for set date");';
                echo 'window.location.href = "getschedule.php";';
                echo '</script>';
        
                die();
            }
        
        
            while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
                $ti = $row['timeslot'];
                $y = count($timeslots) - 1;
                for ($x = 0; $x <= $y; $x++) {

                    if ($timeslots[$x] == $ti) {
                        $y = $y - 1;
                        unset($timeslots[$x]);
                        $timeslots = array_values($timeslots);
                    }
                    }
            }
        //display timeslots that are available
        foreach($timeslots as $ts){
        ?>
        <div class="col-md-2">
            <div class="form-group">
            <?php if(in_array($ts, $bookings)){ ?>
            <button class="btn btn-danger"><?php echo $ts; ?></button>
            <?php }else{ ?>
                <a href='appointment.php?&date=<?php echo $date; ?>&timeslot=<?php echo $ts; ?>'><button class="btn btn-success book" data-timeslot="<?php echo $ts; ?>"><?php echo $ts; ?></button></a>
            <?php }  ?>
            </div>
        </div>
        <?php } ?>
        </div>
        </div>
        
                
</body>

</html>

