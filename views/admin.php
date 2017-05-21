<div class="container theme-showcase" role="main" id="content">
  <div class="col-lg-12">
    <div class="page-header">
      <h2>Administrator</h2>
    </div>

    <div class="container">
       <div class="row">
         <?php if(!$pin){
           echo ' <div class="col-lg-6 col-lg-offset-3">' . $msg . '
         <form action="profile.php" method="POST">
           <p>As a security procedure we require you to enter your pin to continue.</p>
           <input class="form-control" type="password" placeholder="Enter your pin to continue" name="pin"/><Br>
           <button type="submit" name="unlockPin" class="btn btn-success" data-dismiss="modal">Continue</button>
         </form>
       </div>';
       }else{
         echo '<h4>Registered Users</h4><div class="col-lg-11">';
         createUsersTable($conn, $startUser);
         echo '</div>';
         createNav($page, $totalPages);
       } ?>
       </div>
       <div class="col-lg-11">
       <form action="profile.php" method="POST">
         <p class="text-right"><button class="btn btn-danger" name="logout" type="submit">Logout</button></p>
       </form>
     </div>
     </div>
   </div>

 </div>
</body>
