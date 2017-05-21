<?php
//Set default timezone. Reason: Gambling depends on time.
date_default_timezone_set('Europe/Dublin');
//Connect to the database.
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bitpoints";

//Create the connection.
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
  include('session.php');
}
?>
