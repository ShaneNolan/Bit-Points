<?php
$username = $_SESSION['user']->getUsername();
$sql = "SELECT * FROM earnings WHERE username = '$username' ORDER BY ID DESC LIMIT 5";

$tdata = Query($conn, $sql);

$sql ="SHOW COLUMNS FROM earnings";
$ttitles = Query($conn, $sql);

if(isset($_POST["logout"])){
  session_destroy();
  header('Location: index.php');
}
?>
