<?php
$db = new Mysqli("localhost", "root", "", "gmaps"); 
if ($db->connect_errno){
	die('Connect Error: ' . $db->connect_errno);
}
?>