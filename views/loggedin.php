<?php include('views/header.php');?>

    <div class="container theme-showcase" role="main" id="content">
      <div class="col-lg-12">
        <div class="page-header">
          <h2>Dashboard</h2>
        </div>
      <div class="col-lg-5">
        <div class="page-header noHeaderBar" style="padding-top: 0px; margin-top: -8px;">
          <h4>Recent Winnings</h4>
        </div>
        <div id="rWinnings">
          <!-- Recent Winnings -->
        </div>
      </div>
      <div class="col-lg-7">
        <?php include('chat.php');?>
      </div>
    </div>
      <div class="col-lg-12">
        <div class="page-header noHeaderBar">
          <h4>Recent Earnings</h4>
        </div>
        <div id="rEarnings">
          <!-- Recent Earnings -->
      </div>
      </div>
  </div>
  </body>

<?php include('views/footer.php'); ?>
