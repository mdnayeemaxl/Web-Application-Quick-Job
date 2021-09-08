<?php 
function reload($new_location){
    header("Location".$new_location);}

    
function date_time(){
date_default_timezone_set("Asia/Dhaka");
$currenttime=time();
$date_time=strftime("%d-%m-%Y %H:%M:%S",$currenttime);
return $date_time;
}



?>