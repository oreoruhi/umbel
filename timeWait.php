<?php
include('functions/connect.php');
session_start();
session_destroy();

$id=$_GET['id'];

$timestamp = time();
$diff = 1800; //<-Time of countdown in seconds.  ie. 3600 = 1 hr. or 86400 = 1 day.

//MODIFICATION BELOW THIS LINE IS NOT REQUIRED.
$hld_diff = $diff;
if(isset($_SESSION['ts'])) {
	$slice = ($timestamp - $_SESSION['ts']);	
	$diff = $diff - $slice;
}

if(!isset($_SESSION['ts']) || $diff > $hld_diff || $diff < 0) {
	$diff = $hld_diff;
	$_SESSION['ts'] = $timestamp;
}

$diff;

$hours = floor($diff / 3600) . ' : ';
$diff = $diff % 3600;
$minutes = floor($diff / 60) . ' : ';
$diff = $diff % 60;
$seconds = $diff;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="The Team Pabebe" content="">

    <title>Wait for delivery</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Comfortaa" />
    <script src="js/jquery-1.11.0.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sb-admin-2.js"></script>
  </head>
  <body>

    <div class="col-lg-6" style="
            width: 600px;
            margin: 50px 0 0 -280px;
            left: 50%;">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <center>Waiting for your order?</center>
                        </div>
                        <div class="panel-body">
                           
                           <?php
                           $sql="SELECT client_order.*, branch.* 
                           FROM client_order 
                           LEFT JOIN branch
                           ON (client_order.b_id = branch.b_ID)
                           WHERE client_order.co_ID = '$id'";
                           $result=mysqli_query($con, $sql);
                           $row=mysqli_fetch_assoc($result);
                           if($row['co_status'] == 'Received'){
                            ?>
                            <center><div style="font-family: 'Pacifico', Helvetica, sans-serif; font-size: 20px;">Your order has been successfully delivered! Thanks you for supporting our  products and services!</div></center>
                            <br><center><a href = 'index.php'><button type="button" class="btn btn-primary btn-lg btn-block">Shop again?</button></a></center>
                            <?php
                           } else if($row['co_status'] == 'Delivering'){
                            ?>
                            <center><p class="text-muted">Your order is being handled by <b>"<?php echo $row['b_name'];?>"</b>. <br>Remaining time until your order arrives: </p></center><br>
                            <center><div id="strclock" style="font-family: 'Pacifico', Helvetica, sans-serif; font-size: 50px;"></div></center>
                            <center><p class="text-muted">Be sure to give this code to the delivery man: <b><?php
                             echo $id; ?></b></p></center>
                            <?php
                           } else {
                            ?>
                            <center><div style="font-family: 'Pacifico', Helvetica, sans-serif; font-size: 50px;">Your product has not been successfully delivered. We apologize for the inconvenience.</div></center>
                            <?php
                           }
                           ?>
                           
                            

                            

                        </div>
                    </div>
                </div>
    </body>
    </html>

<script type="text/javascript">
 var hour = <?php echo floor($hours); ?>;
 var min = <?php echo floor($minutes); ?>;
 var sec = <?php echo floor($seconds); ?>

function countdown() {
 if(sec <= 0 && min > 0) {
  sec = 59;
  min -= 1;
 }
 else if(min <= 0 && sec <= 0) {
  min = 0;
  sec = 0;
 }
 else {
  sec -= 1;
 }
 
 if(min <= 0 && hour > 0) {
  min = 59;
  hour -= 1;
 }
 
 var pat = /^[0-9]{1}$/;
 sec = (pat.test(sec) == true) ? '0'+sec : sec;
 min = (pat.test(min) == true) ? '0'+min : min;
 hour = (pat.test(hour) == true) ? '0'+hour : hour;
 
 document.getElementById('strclock').innerHTML = hour+":"+min+":"+sec;
 setTimeout("countdown()",1000);
 }
 countdown();
</script>