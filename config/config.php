<?php 

$db = new mysqli('localhost','root','','yh');

if($db->connect_error){
	echo "Error connecting database";
}

 ?>