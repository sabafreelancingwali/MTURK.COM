<?php
$host = "localhost";
$user = "uei4bkjtcem6s";
$pass = "wmhalmspfjgz";
$db   = "dbzgyojdpdnwse";
 
$conn = new mysqli($host, $user, $pass, $db);
if($conn->connect_error){
  die("Connection failed: " . $conn->connect_error);
}
?>
