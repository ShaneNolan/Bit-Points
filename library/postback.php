<?php
/*POSTBACK : Once a survey is completed CPAGRIP.com posts back to my server stating
		that user completed the survey and update their points by the payout / 2.
	This page is locked via a password to prevent malicious intent.*/
include_once('helperFunctions.php');
include_once('../config/connect.php');

	if($_POST['password'] != 'cpapassword'){
	    //header('Location: ../'); //Access Denied.
			echo "Denied";
	    exit;
	}else{
	  $points = round($_POST['payout'] / 2) * 1000;
	  $username = $_POST['tracking_id'];
	  $sql = "UPDATE points SET points = points + '$points' WHERE username = '$username'";
	  Query($conn, $sql);

		echo "Completed.";
	}
?>
