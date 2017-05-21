<?php
//Query helper function for better error handling.
//If method == 0 then execute query and return the result.
//If method == 1 then execute the query and return its rows.
function Query($connection, $sql, $method = 0)
{
	try {
		$result = $connection->query($sql);
		if ($result){
			if($method == 0){
			 return $result; // return 1;
		 }else{
			 return $result->fetch_array(MYSQLI_ASSOC);
		 }
	 }
	}	catch(Exception $e) {
			//echo 'Message: ' .$e->getMessage();
			header("Location:".__USER_ERROR_PAGE);
	}
}

//Add Points to a user. Update: No longer needed due to storage procedure.
function addTPoint($conn, $addPoints){
  $user = $_SESSION['user']->getUsername();
  //$sql = "UPDATE points SET totalpoints = totalpoints + '$addPoints' WHERE username = '$user'";
  //$result = Query($conn, $sql);
	//Query($conn, "CALL addTPoints('$addPoints', '$user')");
}

//Refreshes the Users Points.
function refreshPoints($conn){
  $username = $_SESSION['user']->getUsername();
  $sql = "SELECT points, totalpoints FROM points WHERE username = '$username'";

  //$result = $conn->query($sql);
  //$rows = $result->fetch_array(MYSQLI_ASSOC);
	$rows = Query($conn, $sql, 1);
  $_SESSION['user']->setPoints($rows['points']);
  $_SESSION['user']->setTotalPoints($rows['totalpoints']);
}
?>
