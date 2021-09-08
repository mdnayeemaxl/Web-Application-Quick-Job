<?php

$servername="localhost";
$username="root";
$password="";
$dbname="jobportal";

$conn=mysqli_connect($servername,$username,$password,$dbname);

if($conn){
	echo "connection established";
}
else{
	echo "connection not established".mysqli_connect_error();
}


?>