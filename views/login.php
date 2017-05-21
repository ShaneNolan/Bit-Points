<?php include('views/header.php');?>

    <div class="container theme-showcase" role="main" id="content">
      <div class="col-lg-12">
        <div class="page-header text-center">
          <h2>Bit Points - <small>Account Registration / Login</small></h2>
        </div>

        <div class="container">
           <div class="row">
            <div class="col-md-6 col-md-offset-3">
              <?php echo $alertmsg; ?>
              <div class="panel panel-login">
                <div class="panel-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <form id="login-form" action="login.php" method="post" role="form" style="display: block;">
                        <h2>LOGIN</h2>
                          <div class="form-group">
                            <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                          </div>
                          <div class="form-group">
                            <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                          </div>
                          <div class="col-xs-6 form-group col-sm-offset-3">
                                <input type="submit" name="login" id="login-submit" tabindex="4" class="form-control btn btn-login" name="login" value="Log In">
                          </div>
                      </form>

                      <form id="register-form" action="login.php" method="post" role="form" style="display: none;">
                        <h2>REGISTER</h2>
                          <div class="form-group">
                            <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                          </div>
                          <div class="form-group">
                            <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                          </div>
                          <div class="form-group">
                            <input type="password" name="verifypassword" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
                          </div>
                          <div class="form-group">
                            <div class="row">
                              <div class="col-sm-6 col-sm-offset-3">
                                <input type="submit" name="register" id="register-submit" tabindex="4" class="form-control btn btn-register" name="register" value="Register Now">
                              </div>
                            </div>
                          </div>
                      </form>
                    </div>
                  </div>
                </div>

                <div class="panel-heading">
                  <div class="row">
                    <div class="col-xs-6 tabs">
                      <a href="#" class="current" id="login-form-link"><div class="login">LOGIN</div></a>
                    </div>
                    <div class="col-xs-6 tabs">
                      <a href="#" id="register-form-link"><div class="register">REGISTER</div></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
  
<?php include('footer.php');?>
