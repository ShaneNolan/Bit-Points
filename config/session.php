<?php
//Start a PHP session.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//Set login status.
if(!isset($_SESSION['loggedin'])){$_SESSION['loggedin']=0;}
?>
