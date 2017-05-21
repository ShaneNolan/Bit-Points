<?php
//Echos are outputted so the Ajax requests can determine what to do next.
include_once('../library/user.php');
include_once('../library/helperFunctions.php');
include_once('../config/connect.php');

function inGame($conn, $id, $user){
  $sql = "SELECT * FROM bets WHERE gameID = '$id' AND user = '$user'";
  return Query($conn, $sql);
}

//Get latest game.
$sql = "SELECT * FROM coinroulette ORDER BY id DESC LIMIT 1";
$rows = Query($conn, $sql, 1);

$id = $rows['id'];
$user = $_SESSION["user"]->getUsername();

//Time management for gameplay.
$beginGame = new DateTime($rows['time']);
$currentTime = new DateTime(date("Y-m-d H:i:s"));
$diff = $currentTime->diff($beginGame);

//Display remaining time.
if ($currentTime < $beginGame) { echo "Remaining:" . $diff->format('%S') . "<br>"; }
$beginGame->sub(new DateInterval('PT15S'));

if(InGame($conn, $id, $user)->num_rows > 0) { echo "InGame<br>"; }

//If result is == -1 then a game is currently on.
  if ($rows['result'] == -1) {
    echo "Accepting bets.";
    //Time up, generate result and update table.
    if ($currentTime >= $beginGame) {
        $gamble =  mt_rand(0,1);
        //$sql = "UPDATE coinroulette SET result = '$gamble' WHERE id = '$id'";
        //Query($conn, $sql);
        Query($conn, "CALL updateGameResult('$gamble', '$id')");
    }
  } else {
    echo "No longer accepting bets.<br>Result: ";
    if ($rows['result'] == 1) {
        echo "Heads<br>";
    } else {
        echo "Tails<br>";
    }

    //Check if the user was in the game after it ends.
    $result = InGame($conn, $id, $user);
    if ($result->num_rows > 0) {
      $res = $rows['result'];
      $betRows = $result->fetch_array(MYSQLI_ASSOC);
        if ($res == $betRows['guess']) {
          if(($betRows['result']) == -1){
            //Update result.
            //$sql = "UPDATE bets SET result = 1 WHERE user = '$user' AND gameID = '$id'";
            //Query($conn, $sql);
            Query($conn, "CALL updateResult('$res', '$user', '$id')");

            //Assign winners points.
            $winAmount = $betRows['amount'] * 2;
            //$sql = "UPDATE points SET points = points + '$winAmount' WHERE username = '$user'";
            //Query($conn, $sql);
            Query($conn, "CALL gameWin('$winAmount', '$user')");
            //addTPoint($conn, 1+floor($betRows['amount']/4));
            $addPoints= 1+floor($betRows['amount']/4);
            Query($conn, "CALL addTPoints('$addPoints', '$user')");
            }
          echo "Winner";
        } else {
          if(($betRows['result']) == -1){
            //Update result.
            //$sql = "UPDATE bets SET result = 0 WHERE user = '$user' AND gameID = '$id'";
            //Query($conn, $sql);
            Query($conn, "CALL updateResult('$res', '$user', '$id')");
            //addTPoint($conn, 1);
            Query($conn, "CALL addTPoints(1, '$user')");
          }
          echo "Loser";
        }
    } else {
        echo "Not<br>";
    }
}
?>
