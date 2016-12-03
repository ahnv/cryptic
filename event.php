<?php

session_start();
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/inc/autoload.php';
print_r($event->get_event_status());
//print_r(time()+19800);
?>

 <script type="text/javascript">
 function timedMsg()
  {
    var t=setInterval("change_time();",1000);
  }
 function change_time()
 {
   var d = new Date();
   var curr_hour = d.getHours();
   var curr_min = d.getMinutes();
   var curr_sec = d.getSeconds();
   if(curr_hour > 12)
     curr_hour = curr_hour - 12;
   document.getElementById('Hour').innerHTML =curr_hour+':';
    document.getElementById('Minut').innerHTML=curr_min+':';
    document.getElementById('Second').innerHTML=curr_sec;
 }
timedMsg();   
</script>

<table>
<tr>
 <td>Current time is :</td>
 <td id="Hour" style="color:green;font-size:large;"></td>
 <td id="Minut" style="color:green;font-size:large;"></td>
 <td id="Second" style="color:red;font-size:large;"></td>
<tr>
</table> 