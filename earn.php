<?php
include('library/user.php');
include_once('config/connect.php');

if($_SESSION['loggedin']==1){
	include('views/earn.php');
	exit;
	}
else{
	header('Location: login.php');
	exit;
}
?>
