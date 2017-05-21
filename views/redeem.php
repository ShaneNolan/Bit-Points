<?php include('views/header.php'); ?>

<div class="container theme-showcase" role="main" id="content">
   <div class="col-lg-12">
      <div class="page-header">
         <h2>Redeem</small></h2>
      </div>
      <p class="text-center">Once you have earned a minimum of <span class="glyphicon glyphicon-gift"></span> 10,000 Points ($10), you will be able to redeem your points for Paypal. </p>
      <p class="text-center">Your <strong>Payment Schedule is NET30</strong>, meaning you will be paid on the 30th of every Month if you have made a payment request.</p>
   </div>
   <div class="col-lg-6 col-lg-offset-3 padding-top">
     <?php echo $message; ?>
      <div class="panel panel-default">
         <div class="panel-heading panelHNew">Payment Process</div>
         <form id="requestPayment" action="redeem.php" method="POST">
            <div class="panel-body">
               <div class="col-lg-12 padding-top">
                  <div class="input-group">
                     <span class="input-group-addon">
                     <i class="glyphicon glyphicon-send"></i>
                     </span>
                     <input class="form-control" placeholder="Paypal Email" name="paypalEmail" type="email" autofocus>
                  </div>
                  <div class="input-group padding-top padding-bottom">
                     <span class="input-group-addon">
                     <i class="glyphicon glyphicon-gift"></i>
                     </span>
                     <input class="form-control" placeholder="Points Amount" name="amount" type="number" autofocus>
                  </div>
               </div>
            </div>
            <div class="panel-footer text-right"><button class="btn btn-primary" id="reqPayment" name="reqPayment" type="submit">Request Payment</button></div>
         </form>
      </div>
   </div>

   <div class="col-lg-12">
      <div class="page-header">
         <h2>Payments <small>Most Recent</small></h2>
         <?php createTablePay($tdata); ?>
      </div>
   </div>
</div>
</body>

<?php include('views/footer.php'); ?>
