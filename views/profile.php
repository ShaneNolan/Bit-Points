<div class="container theme-showcase" role="main" id="content">
  <div class="col-lg-12">
    <div class="page-header">
      <h2><?php echo strtoupper($_SESSION['user']->getUsername()); ?>'S - Profile</h2>
    </div>

    <div class="container">
       <div class="row">
         <div class="col-lg-4">
           <img src="resources/img/profileimage.png" alt="Profile Picture"/>
           <h3>Rank: <?php getUserRank($_SESSION['user']->getTotalPoints()); ?> | Points: <?php echo $_SESSION['user']->getPoints() ?></h3>
           <p><?php echo $_SESSION['user']->getDescription(); ?></p>
         </div>

         <div style="margin-left: 2%;" class="col-lg-7">
           <h4 style="margin-top: 0px;">Recent Earnings</h4>
           <?php createTable($ttitles, $tdata); ?>
           <form action="profile.php" method="POST">
             <p class="text-right"><button class="btn btn-danger" name="logout" type="submit">Logout</button></p>
           </form>
         </div>
       </div>
     </div>

   </div>
 </div>
</body>
