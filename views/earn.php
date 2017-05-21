<?php include('views/header.php'); ?>

    <div class="container theme-showcase" role="main" id="content">
      <div class="col-lg-12">
        <div class="page-header">
          <h2>Earn <small>Available Offers</small></h2>
        </div>
        <p class="text-center">Complete offers below to earn <span class="glyphicon glyphicon-gift"></span> Points. We are not associated with any offers and completion is decided by
          the offer provider.</p>
          <p class="text-center">Offers are displayed based on the device you are on, more offers are available if you log on via another device such as your phone.</p>
      </div>
      <div class="row">
        <input id="uid" type="hidden" value="<?php echo $_SESSION['user']->getUsername(); //Used to store the current users ID. ?>"/>
        <div class="col-lg-12 offer_holder">
          <p class="text-center">There are currently no offers available for you at this time. If you have an <strong>Ad Blocker</strong> please disable it.</p>
        </div>
      </div>
    </div>
  </body>

<?php include('views/footer.php'); ?>
