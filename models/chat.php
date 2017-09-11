<?php
include('../library/user.php');
include('../library/helperFunctions.php');
include('../config/connect.php');

/*Chat: Check if a message is submitted, if so get the user and add it to the database.
        Then fetch the chat database and 25 most recent messages.*/
if(isset($_POST['messageBody'])){
  $user = $_SESSION['user']->getUsername();
  $message = $conn->real_escape_string($_POST['messageBody']);
  //$sql = "INSERT INTO chat(sender, message) VALUES ('$user', '$message')";
  //Query($conn, $sql);
  Query($conn, "CALL chatMessage('$user', '$message')");
  //Everytime a chat message is sent add 0.2 to the users totalpoints.
  addTPoint($conn, 0.2);
}

//Chat UI.
$sql = "(SELECT * from chat ORDER BY ID DESC LIMIT 25) ORDER BY ID ASC";
$result = Query($conn, $sql);

while($trow = $result->fetch_array(MYSQLI_ASSOC)){
  echo '<div class="row message-bubble">';
  echo '<p class="dinline text-muted">' . $trow['sender'] . ': </p><p class="dinline">' . htmlspecialchars($trow['message']) . "</p></div>";
}
?>
