<?php
$mysqli = new mysqli('localhost', 'root', '', 'sourcecodester_dadb');
if(isset($_GET['q'])){
    $date = $_GET['q'];
    $stmt = $mysqli->prepare("select * from bookings where date = ? ");
    $stmt->bind_param('s', $date);
    $bookings = array();
    if($stmt->execute()){
        $result = $stmt->get_result();
    }
}

$duration = 10;
$cleanup = 0;
$start = "09:00";
$end = "15:00";
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
    <script src="https://kit.fontawesome.com/95c473646d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/button.css">
</head>

  <body>
    <div class="container">
        <h1 class="text-center">Book for Date: <?php echo date('F d, Y', strtotime($date)); ?></h1><hr>
        <div class="row">
        <div class="col-md-12">
        <?php echo(isset($msg))?$msg:""; ?>
        </div>
        <?php $timeslots = timeslots($duration, $cleanup, $start, $end); 
            $res = "SELECT * FROM bookings WHERE date ='$date'";
            $result = $mysqli -> query($res);
            
            if (!$res) {
                die("Error running $sql: " . mysqli_error());
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
        
                

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script>
    $(".book").click(function(){
        var timeslot = $(this).attr('data-timeslot');
        $("#slot").html(timeslot);
        $("#timeslot").val(timeslot);
        $("#myModal").modal("show");
    });
    </script>
</body>

</html>
