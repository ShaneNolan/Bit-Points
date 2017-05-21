<?php
$message = "";
$user = $_SESSION["user"]->getUsername();

//User has made a request for payment.
if(isset($_POST['reqPayment']) && isset($_POST['paypalEmail']) && isset($_POST['amount'])){
  //mysql_escape_string == This function was deprecated in PHP 4.3.0;
  $ppEmail = $conn->real_escape_string($_POST['paypalEmail']);
  $amount = $conn->real_escape_string($_POST['amount']);

  //Check if empty.
  if(!empty($ppEmail) && !empty($amount)){
    $sql = "SELECT * FROM payments WHERE user = '$user' AND paid = 0";
    $result = Query($conn, $sql);

    //Check they dont have a current payment request.
    if($result->num_rows == 0){
      //Check their amount is greater than the minimum 10000.
      if($amount >= 10000){
        //Check their points to ensure they can request that amount.
        if($_SESSION["user"]->getPoints() - $amount >= 0){
          //Create payment.
          //$sql = "INSERT INTO payments (user, ppemail, amount) VALUES ('$user', '$ppEmail', '$amount')";
          //Query($conn, $sql);
          Query($conn, "CALL createPayment('$user', '$ppEmail', '$amount')");

          //Update points.
          $sql = "UPDATE users SET points = points - '$amount' WHERE username = '$user'";
          Query($conn, $sql);
          $message = createAlert("success", "Woohoo!", "Your request has been made and will be processed at the end of the month.");
        }else{ $message = createAlert("warning", "Oops!", "You do not have enough points."); }
      }else{ $message = createAlert("warning", "Oops!", "You must enter a minimum of 10,000 Points."); }
    }else{ $message = createAlert("warning", "Oops!", "You already have a payment being processed, try again once that payment is finished processing."); }
  }else{ $message = createAlert("danger", "Oops!", "Something was wrong with your input, try again."); }
}

//Table data.
$sql = "SELECT * FROM payments WHERE user = '$user' ORDER BY ID DESC LIMIT 12";
$tdata = Query($conn, $sql);
?>
