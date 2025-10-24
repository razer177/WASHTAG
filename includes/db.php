<?php
function connectdb()
{
$dbhost="localhost";
$dbuser="root";
$dbpass="";
$db="razer_db";
$conn=new mysqli($dbhost,$dbuser,$dbpass,$db);
if($conn->connect_error){die("Connection Faild ".$mysqli->connect_error);}
return $conn;
}
?>
