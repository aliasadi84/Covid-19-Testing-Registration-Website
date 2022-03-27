<?php
$mysqli = new mysqli('localhost:3308', 'root', '', 'sourcecodester_dadb');
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
        
        $slots[] = $intStart->format("H:iA")." - ". $endPeriod->format("H:iA");
        
    }
    
    return $slots;
}


?>
<!doctype html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main.css">
  </head>

  <body>
    <div class="container">
        <h1 class="text-center">Book for Date: <?php echo date('m/d/Y', strtotime($date)); ?></h1><hr>
        <div class="row">
        <div class="col-md-12">
        <?php echo(isset($msg))?$msg:""; ?>
        </div>
        <?php $timeslots = timeslots($duration, $cleanup, $start, $end); 
            foreach($timeslots as $ts){
        ?>
        <div class="col-md-2">
            <div class="form-group">
            <?php if(in_array($ts, $bookings)){ ?>
            <button class="btn btn-danger"><?php echo $ts; ?></button>
            <?php }else{ ?>
            <button class="btn btn-success book" data-timeslot="<?php echo $ts; ?>"><a href='appointment.php?&date=<?php echo $date; ?>&timeslot=<?php echo $ts; ?>'><?php echo $ts; ?></a></button>
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