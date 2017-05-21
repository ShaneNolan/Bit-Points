<?php
include_once('config/connect.php');
if($_SESSION['loggedin']==1){
  header('Location: index.php');
  exit;
}
include('library/user.php');
include('library/gui.php');
include('library/helperFunctions.php');
include('models/login.php');
include('views/login.php');
?>
