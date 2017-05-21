<?php
include_once('library/user.php');
include_once('config/connect.php');

if($_SESSION['loggedin']==1){
  include('library/gui.php');
  include('library/helperFunctions.php');
  include('models/redeem.php');
	include('views/redeem.php');
	}
else{
  header('Location: login.php');
	exit;
}
?>
