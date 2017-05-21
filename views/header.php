<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="resources/img/profileimage.png">

    <title>Bit Points - Dashboard</title>

    <link href="resources/css/bootstrap.min.css" rel="stylesheet">
    <link href="resources/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="resources/css/theme.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="library/js/bootstrap.min.js"></script>
    <script src="library/js/scripts.js"></script>
  </head>

  <body>
    <nav id="topbar" class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php">Bit Points</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
          <?php if($_SESSION['loggedin']==1){
            echo '<li><a href="profile.php"><img src="resources/img/profileimage.png" id="profileIcon" alt="Profile Icon"/>' . $_SESSION['user']->getUsername() . '</a></li>';
          }else{
            echo '<li><a href="login.php">Login | Register</a></li>';
          } ?>
          </ul>
      </div>
    </nav>

    <nav id="underbar" class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
            <ul class="nav navbar-nav">
              <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
              <li class="underbarSpace"><a href="earn.php"><span class="glyphicon glyphicon-tag"></span> Earn</a></li>
              <li class="underbarSpace"><a href="gamble.php"><span class="glyphicon glyphicon-pawn"></span> Gamble</a></li>
              <li class="underbarSpace"><a href="redeem.php"><span class="glyphicon glyphicon-usd"></span> Redeem</a></li>
            </ul>
        </div>
        <div id="dPoints">
          <!-- Points -->
        </div>
      </div>
    </nav>
