<?php include('views/header.php'); ?>

<div class="container theme-showcase" role="main" id="content">
<div class="col-lg-12">
   <div class="page-header">
      <h2>Gamble <small>Coin Roulette</small></h2>
   </div>
</div>
<div class="col-lg-12">
<div class="row">
   <div class="col-lg-12">
      <div class="col-lg-5">
         <div id="flip" class="flip">
            <div class="card">
               <div class="face front"></div>
               <div class="face back"></div>
            </div>
         </div>
         <form id="betCoinRoulette" action="/models/coinroulette.php" method="POST">
            <div class="panel panel-default">
               <div class="panel-heading panelHNew">Make a Bet</div>
               <div class="panel-body">
                  <div class="form-group padding-top">
                     <p class="padding-left">Enter in a bet amount and select a coin (heads or tails).</p>
                     <div class="col-lg-8">
                        <div class="input-group">
                           <span class="input-group-addon">
                           <i class="glyphicon glyphicon-gift"></i>
                           </span>
                           <input class="form-control" placeholder="Bet Amount" id="betAmount" name="betAmount" type="number" autofocus>
                        </div>
                     </div>
                     <div class="col-lg-4">
                        <label style="margin-left: -10px;">
                        <input type="radio" name="choice" value="heads" class="noRButton"/>
                        <img class="profile-img" src="../resources/img/coinroulette/heads.png" alt=""/>
                        </label>
                        <label>
                        <input type="radio" name="choice" value="tails" class="noRButton"/>
                        <img class="profile-img" src="../resources/img/coinroulette/tails.png" alt=""/>
                        </label>
                     </div>
                     <div class="col-lg-12">
                        <div class="form-group padding-top">
                           <button type="submit" id="betButton" class="btn btn-lg btn-primary btn-block">Place Bet</button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </form>
      </div>
      <div class="col-lg-7">
         <?php include('chat.php');?>
      </div>
      <div class="col-lg-12">
        <div class="page-header noHeaderBar">
          <h4>Current | Recent Game</h4>
        </div>
        <div id="LGD">
        <!-- Latest Game Data -->
      </div>
      </div>
   </div>
</div>

<div class="modal fade" id="mMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalTitle"><strong>Bit Points</strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Modal Body Here -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</body>

<?php include('views/footer.php'); ?>
