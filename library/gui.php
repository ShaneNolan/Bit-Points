<?php

//Create bootstrap alerts.
function createAlert($type, $title, $msg){
  return '<div class="alert alert-' . $type .
  ' alert-dismissible" role="alert"><button type="button" class="close"
  data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>' . $title . '</strong> ' . $msg . '</div>';
}

//Assign a user a rank depending on their TotalPoints.
function getUserRank($points){
  /*1.Newbie 2.Member 3.Elite 4.Veteran 5.Royalty*/
  if($points < 5000){
    echo "Newbie";
  }else if($points > 5000 && $points < 15000){
    echo "Member";
  }
  else if($points > 15000 && $points < 50000 ){
    echo "Elite";
  }
  else if($points > 50000 && $points < 150000){
    echo "Veteran";
  }else{
    echo "Royalty";
  }
}

//Create a default table.
function createTable($titles, $data){
  echo '<table class="table"><tr>';
  while($trow = $titles->fetch_array(MYSQLI_ASSOC)){
    echo '<th>'.strtoupper($trow['Field']).'</th>';
  }
  echo '</tr>';

  while($drow = $data->fetch_array(MYSQLI_ASSOC)){
    echo '<tr>';
    foreach($titles as $title){
      echo '<td>' . $drow[$title['Field']] . '</td>';
    }
    echo '</tr>';
  }
  echo '</table>';
}


//Create Payment table.
function createTablePay($data){
  echo '<table class="table"><tr><th>Paypal Email</th><th>Amount</th><th>Paid</th></tr>';
  while($drow = $data->fetch_array(MYSQLI_ASSOC)){
    echo "<tr><td>" . $drow['ppemail'] . "</td><td>" . $drow['amount'] . "</td><td>";
    if($drow['paid'] == 1){
      echo 'Paid</td>';
    }else{
      echo 'Unpaid</td>';
    }
  }
  echo '</table>';
}

//Create Gamble Tamble table.
function createTableGamble($titles, $data){
  echo '<table class="table"><tr>';
  while($trow = $titles->fetch_array(MYSQLI_ASSOC)){
    echo '<th>'.strtoupper($trow['Field']).'</th>';
  }
  echo '</tr>';

  while($drow = $data->fetch_array(MYSQLI_ASSOC)){
    echo '<tr>';
    foreach($titles as $title){
      if($title['Field'] == "guess"){
        if($drow[$title['Field']] == 1){
          echo '<td>' . "Heads" . '</td>';
        }else{
          echo '<td>' . "Tails" . '</td>';
        }
      }elseif ($title['Field'] == "result") {
        if($drow[$title['Field']] == $drow['guess']){
        echo '<td class="win">' . "Won" . '</td>';
        }else if($drow[$title['Field']] == -1){
          echo '<td>' . "Na" . '</td>';
        }else{
          echo '<td class="loss">' . "Lost" . '</td>';
        }
      }else{
        echo '<td>' . $drow[$title['Field']] . '</td>';
      }
    }
    echo '</tr>';
  }
  echo '</table>';
}


//Create users table.
function createTableUsers($data){
  echo '<table class="table"><tr><th>ID</th><th>TYPE</th><th>USERNAME</th><th>POINTS</th><th>TOTALPOINTS</th><th>OPTIONS</th><th>CLOSED</th></tr>';
  while($drow = $data->fetch_array(MYSQLI_ASSOC)){
    echo '<form action="profile.php" method="POST">';
    echo '<tr><td class="uMargin-top">' . $drow['id'] . '</td><td class="uMargin-top">' . $drow['type'] . '</td><td class="uMargin-top">' . $drow['username'];
    echo '<input type="hidden" name="username" value="' . $drow["username"] . '">';
    echo "</td><td><input class=\"form-control input-sm\"type=\"number\" name=\"points\" value=\"" . $drow['points'] . "\"></td>";
    echo "<td><input class=\"form-control input-sm\"type=\"number\" name=\"totalpoints\" value=\"" . $drow['totalpoints'] . "\"></td>";
    echo '<td><button class="btn btn-xs btn-primary uMargin-top" type="submit" name="option" value="update">Update</button></td><td>';
    if($drow['closed'] == 0){
      echo '<button class="btn btn-xs btn-danger uMargin-top" type="submit" name="option" value="close">Close Account</button>';
    }else{
      echo '<button class="btn btn-xs btn-success uMargin-top" type="submit" name="option" value="restore">Restore Account</button>';
    }
    echo '</td></tr></form>';
  }
  echo '</table></form>';
}
?>
