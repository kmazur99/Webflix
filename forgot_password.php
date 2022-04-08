  <?php # DISPLAY COMPLETE LOGIN PAGE.
  include('includes/bootstrap.html');
  session_start();
  echo '
  <nav class="navbar sticky-top navbar-expand-sm bg-dark" style="background-color: #171717 !important;">
          <a class="navbar-brand" href="home.php"><span style="color:#C72606; font-size: 36px;">Webflix</span></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
              </ul>
              <ul class="navbar-nav">
              <li class="nav-item">
              <a class="nav-link" href="login.php"><span style="color:#C72606; font-size: 24px;">Sign In</a>
            </li>    
              </ul>
          </div>
        </nav>
  ';

    if (isset($_GET['Success'])) {
  echo'
  <br>
  <title>Forgot password - Webflix</title>
  <div class="container">
    <div class="row">
      <div class="col-sm">
      </div>
      <div class="col-md">
        <div class="card card-dark mb-3">
          <div class="card-header">
            <h1 style="text-align: center">Forgot Password</h1>
            <hr>
          </div>
          <div class="card-body">
            <form action="send_email.php" method="post">
              <div style="text-align:center">
              <p> A link to reset your password has been sent to your email address. If you cannot see it, please check the SPAM folder. 
              </p>
              </div>

            </form>
          </div>
        </div>
      </div>
      <div class="col-sm">
      </div>
    </div>
  </div>
  ';
    }
    else{
      echo'
      <br>
      <title>Forgot password - Webflix</title>
      <div class="container">
        <div class="row">
          <div class="col-sm">
          </div>
          <div class="col-md">
            <div class="card card-dark mb-3">
              <div class="card-header">
                <h1 style="text-align: center">Forgot Password</h1>
                <hr>
              </div>
    
              <div class="card-body">
                <form action="send_email.php" method="post">
    
                  <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" id="email" name="email" size="30" required>
                  </div>
                  <br>
                  <div style="text-align:center">
                    <button type="submit" class="btn btn-primary">Send password reset link</button>
                  </div>
    
                </form>
              </div>
            </div>
          </div>
          <div class="col-sm">
          </div>
        </div>
      </div>
      ';
    }
  