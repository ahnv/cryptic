<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/inc/autoload.php';
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/classes/LoginHelper.php';
$log = new LoginHelper($db);
if($event->get_event_status() == 1)
header("Location: ".SITE_URL);
?>
<!DOCTYPE html>
<html>
<head>
<title>Cryptic Hunt</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php if(!LIVE): ?>
<link href="<?php echo SSTATIC; ?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo SSTATIC; ?>css/font-awesome.min.css" rel="stylesheet">
<link rel='stylesheet' href='<?php echo SSTATIC; ?>css/style.css'>
<?php endif; ?>
<?php if(LIVE): ?>
<link rel='stylesheet' href='<?php echo SSTATIC; ?>css/app.css'>
<?php endif; ?>
</head>
<body>
<div id="wrapper">
<?php include 'inc/nav.php';?>
</div>
<div id="page-wrapper">
<section>
<div class="container-fluid">
<div id="countdown" class="row">
<!--<div class="col-sm-6 col-md-3 col-lg-3 box">
<p class="numbers days">00</p>
<br>
<p class="strings timeRefDays">Days</p>
</div>
<div class="col-sm-4 col-md-4 col-lg-4 box">
<p class="numbers hours">00</p>
<br>
<p class="strings timeRefHours">Hours</p>
</div>-->
<div class="col-sm-6 col-md-6 col-lg-6 box">
<p class="numbers minutes">00</p>
<br>
<p class="strings timeRefMinutes">Minutes</p>
</div>
<div class="col-sm-6 col-md-6 col-lg-6 box">
<p class="numbers seconds">00</p>
<br>
<p class="strings timeRefSeconds">Seconds</p>
</div>
</div>
</div>
</section>
</div>
<?php if(!LIVE): ?>
<script type="text/javascript" src="<?php echo SSTATIC; ?>js/jquery.min.js">
</script>
<script type="text/javascript" src="<?php echo SSTATIC; ?>js/bootstrap.min.js">
</script>
<script type="text/javascript" src="<?php echo SSTATIC; ?>js/sb-admin-2.js">
</script> 
<?php endif; ?>
<?php if(LIVE): ?>
<script type="text/javascript" src="<?php echo SSTATIC; ?>js/app.js">
</script> 
<?php endif; ?>
<script type="text/javascript" src="<?php echo SSTATIC; ?>js/jquery.countdown.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){(function(e){e.fn.countdown=function(t,n){function i(){eventDate=Date.parse(r.date)/1e3;currentDate=Math.floor(e.now()/1e3);if(eventDate<=currentDate){clearInterval(interval)}
seconds=eventDate-currentDate;days=Math.floor(seconds/86400);seconds-=days*60*60*24;hours=Math.floor(seconds/3600);seconds-=hours*60*60;minutes=Math.floor(seconds/60);seconds-=minutes*60;days==1?thisEl.find(".timeRefDays").text("Days"):thisEl.find(".timeRefDays").text("Days");hours==1?thisEl.find(".timeRefHours").text("Hours"):thisEl.find(".timeRefHours").text("Hours");minutes==1?thisEl.find(".timeRefMinutes").text("Minutes"):thisEl.find(".timeRefMinutes").text("Minutes");seconds==1?thisEl.find(".timeRefSeconds").text("Seconds"):thisEl.find(".timeRefSeconds").text("Seconds");if(r.format=="on"){days=String(days).length>=2?days:"0"+days;hours=String(hours).length>=2?hours:"0"+hours;minutes=String(minutes).length>=2?minutes:"0"+minutes;seconds=String(seconds).length>=2?seconds:"0"+seconds}
if(!isNaN(eventDate)){thisEl.find(".days").text(days);thisEl.find(".hours").text(hours);thisEl.find(".minutes").text(minutes);thisEl.find(".seconds").text(seconds)}else{errorMessage="Invalid date. Example: 27 March 2015 17:00:00";alert(errorMessage);console.log(errorMessage);clearInterval(interval)}}
var thisEl=e(this);var r={date:null,format:null};t&&e.extend(r,t);i();interval=setInterval(i,1e3)}})(jQuery);$(document).ready(function(){function e(){var e=new Date;e.setDate(e.getDate()+60);dd=e.getDate();mm=e.getMonth()+1;y=e.getFullYear();futureFormattedDate=mm+"/"+dd+"/"+y;return futureFormattedDate}
$("#countdown").countdown({date:"<?php echo EVENT_START_VAL?>",format:"on"})})})
</script>
</body>
</html>