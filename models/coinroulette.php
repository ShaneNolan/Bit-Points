<?php
//Echos are outputted so the Ajax requests can determine what to do next.
include('../library/user.php');
include('../library/helperFunctions.php');
include('../config/connect.php');

function getGameData($conn){
  $sql = "SELECT * FROM coinroulette ORDER BY id DESC LIMIT 1";
  return Query($conn, $sql, 1);
}

if(isset($_POST['betAmount']) && isset($_POST['choice'])){
    $betAmount = $conn->real_escape_string($_POST['betAmount']);
    $choice = $conn->real_escape_string($_POST['choice']);

    if($choice == "heads"){
      $choice = 1;
    }else{
      $choice = 0;
    }

    $rows = getGameData($conn);

    // Create a new game.
    if($_SESSION["user"]->getPoints() - $betAmount >= 0){
      if($rows["time"] < date("Y-m-d H:i:s")){
        $sql = "INSERT INTO coinroulette(time) VALUES (NOW() + INTERVAL 30 SECOND)";
        Query($conn, $sql);
        //Update rows.
        $rows = getGameData($conn);
      }

    //Check if the game is not already finished.
    if($rows['result'] == -1){
      $user = $_SESSION["user"]->getUsername();
      $id = $rows['id'];

      $sql = "SELECT * FROM bets WHERE gameID = '$id' AND user = '$user'";
      $result = Query($conn, $sql);

      if($result->num_rows == 0){
          //$sql = "INSERT INTO bets(gameID, user, guess, amount) VALUES ('$id', '$user', '$choice', '$betAmount')";
          //Query($conn, $sql);
          Query($conn, "CALL createBet('$id', '$user', '$choice', '$betAmount')");

          $user = $_SESSION["user"]->getUsername();
          //$sql = "UPDATE points SET points = points - '$betAmount' WHERE username = '$user'";
          //Query($conn, $sql);
          Query($conn, "CALL betCost('$betAmount', '$user')");

          addTPoint($conn, 1);
          echo 'Bet placed successfully.';
      }else{
        echo "Bet already made.";
      }
    }else{
      echo "No longer taking bets.";
    }
  }else{
    echo "You do not have enough points to bet that amount.";
  }
}
?>
