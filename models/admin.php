<?php

$username = $_SESSION['user']->getUsername();
$pin = FALSE;
$msg = "";

//Page setup.
$sql = "SELECT COUNT(id) AS total FROM users";
$rows = Query($conn, $sql, 1);
$totalPages = ceil($rows["total"] / 10);
if (isset($_GET["page"])) { $page  = $conn->real_escape_string($_GET["page"]); } else { $page=1; };
$startUser = (($page - 1) * 10);

//Create Users Table and Prevent Refresh Bug.
function createUsersTable($conn, $startUser){
  $sql = "SELECT u.id, u.type, u.username, p.points, p.totalpoints, u.closed FROM users u INNER JOIN points p ON u.username = p.username ORDER BY ID DESC LIMIT $startUser, 10";
  createTableUsers(Query($conn, $sql));
}

//Crete navigation based on query results.
function createNav($page, $totalPages){
    echo '<nav class="text-center" aria-label="Page navigation"><ul class="pagination">';
    if($page <= 1){
        echo '<li class="disabled"><a href="#">«</a></li>';
    }else{
      echo '<li><a href="?page=' . $page-- . '">«</a></li>';
    }

    for($i = 1; $i <= $totalPages; $i++){
      if($i == $page){
        echo '<li class="active"><a href="#">' . $i . ' <span class="sr-only">(current)</span></a></li>';
      }else{
        echo '<li><a href="#">' . $i . '</a></li>';
      }
     }

     if($page >= $totalPages){
       echo '<li class="disabled"><a href="#">»</a></li>';
     }else{
       echo '<li><a href="?page=' . $page-- . '">»</a></li>';
     }

     echo '</ul></nav>';
}


if(isset($_POST['pin'])){
  $npin = $conn->real_escape_string($_POST['pin']);
  if($_SESSION['user']->getPin() == $npin){
    $pin = TRUE;
  }
  $msg = createAlert("warning", "Oops!", "Your pin was incorrect, try again.");
}

//Updates, closes and restores a user.
if(isset($_POST["option"]) && isset($_POST["username"])){
  $option = $conn->real_escape_string($_POST["option"]);
  $user = $conn->real_escape_string($_POST["username"]);

  switch($option){
    case 'update':
      if(isset($_POST["points"]) && isset($_POST["totalpoints"])){
        $points = $conn->real_escape_string($_POST["points"]);
        $totalpoints = $conn->real_escape_string($_POST["totalpoints"]);

        $sql = "UPDATE points SET points = '$points', totalpoints = $totalpoints WHERE username = '$user'";
        Query($conn, $sql);
      }
    break;

    case 'close':
      //$sql = "UPDATE users SET closed = 1 WHERE username = '$user'";
      //Query($conn, $sql);
      Query($conn, "CALL opencloseAccont(1, '$user')");
    break;

    case 'restore':
      //$sql = "UPDATE users SET closed = 0 WHERE username = '$user'";
      //Query($conn, $sql);
      Query($conn, "CALL opencloseAccont(0, '$user')");
    break;

    default:
    break;
  }
}
?>
