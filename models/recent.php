<?php
/*AJAX REQUEST CONTENT:
  This content will be fetched via ajax therefore it isnt included and
    includes its required libraries. */
include_once('../library/user.php');
include_once('../library/gui.php');
include_once('../library/helperFunctions.php');
include_once('../config/connect.php');

//Get the latest earnings.
if(isset($_POST['earnings'])){
  $sql = "SELECT * FROM earnings ORDER BY ID DESC LIMIT 5";
  $tdata = Query($conn, $sql);

  $sql ="SHOW COLUMNS FROM earnings";
  $ttitles = Query($conn, $sql);

  createTable($ttitles, $tdata);

//Get the latest winners.
}else if(isset($_POST['winnings'])){
  $sql = "SELECT * FROM bets WHERE guess = result ORDER BY ID DESC LIMIT 9";
  $tdata = Query($conn, $sql);

  $sql ="SHOW COLUMNS FROM bets";
  $ttitles = Query($conn, $sql);

  createTableGamble($ttitles, $tdata);

//Get the current/latest game details.
}else if(isset($_POST['gamble'])){
  $sql = "SELECT * FROM coinroulette ORDER BY id DESC LIMIT 1";
  $rows = Query($conn, $sql, 1);

  $gameID = $rows['id'];
  $sql = "SELECT * FROM bets WHERE gameID = '$gameID'";
  $tdata = Query($conn, $sql);

  $sql ="SHOW COLUMNS FROM bets";
  $ttitles = Query($conn, $sql);

  createTableGamble($ttitles, $tdata);

//Get the users current points.
}else if(isset($_POST['points'])){
  //Refreshes the users points.
  refreshPoints($conn);
   echo '<ul class="nav navbar-nav navbar-right">
    <li id="pointsIcon"><span class="glyphicon glyphicon-gift"></span> ' . $_SESSION['user']->getPoints() . ' Points</li>
  </ul>';
}else{
  header('Location ../');
}
?>
