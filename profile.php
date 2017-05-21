<?php
include_once('library/user.php');
include_once('config/connect.php');
if(!$_SESSION['loggedin']==1){
  header('Location: login.php');
  exit;
}
include_once('library/gui.php');
include_once('library/helperFunctions.php');
include('views/header.php');
if($_SESSION['user']->getType() == "admin"){
  include('models/admin.php');
  include('views/admin.php');
}else{
  include('models/profile.php');
  include('views/profile.php');
}
include('views/footer.php');
?>
