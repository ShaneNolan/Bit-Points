<?php
include_once('library/user.php');
include_once('config/connect.php');

if($_SESSION['loggedin']==1){
	include('views/loggedin.php');
	exit;
	}
else{
	include('views/loggedout.php');
	exit;
}
?>
