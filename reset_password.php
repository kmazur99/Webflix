<?php

session_start();

# Open database connection.
require('connect_db.php');

# Load bootstrap + CSS
include('includes/bootstrap.html');

# Display error message if passwords don't match
if (isset($_GET['Message'])) {
  echo '<div class="alert alert-dark" role="alert">
  <h4 class="alert-heading">Error</h4>
  <p> ' . $_GET['Message'] . ' </p>
<hr>
<footer">
</footer></div>  ';
}

# Display navbar
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

if (isset($_GET['email'])) $email = $_GET['email'];

$_POST['email'] = $email;

echo '
  <br>
  <title>Reset password - Webflix</title>
  <div class="container">
    <div class="row">
      <div class="col-sm">
      </div>
      <div class="col-md">
        <div class="card card-dark mb-3">
          <div class="card-header">
            <h1 style="text-align: center">Reset Password</h1>
            <hr>
          </div>';
if (isset($_GET['Success'])) {
  echo '
          <div class="card-body">
            <form action="send_email.php" method="post">
              <div style="text-align:center">
              <p> Your password has been changed. Please login with your new password. </p>
              </p>
              <a href="login.php"><button type="button" class="btn btn-secondary" role="button">Sign in</button></a>
              </div>
            </form>
          </div>';
} else {
  echo '
            <div class="card-body">
          <form action="recover_password.php" method="post">
            <div class="form-group">
              <input type="hidden" name="email" class="form-control" placeholder="Confirm Email" value="' . $_POST['email'] . '" required>
            </div>
            <div class="form-group">
              <input type="password" name="pass1" class="form-control" placeholder="New Password" value="' . $_POST['pass1'] . '" required>
            </div>
            <div class="form-group">
              <input type="password" name="pass2" class="form-control" placeholder="Confirm New Password" value="' . $_POST['pass2'] . '" required>
            </div>
            <div class="form-group">
                <input class="btn btn-secondary" type="submit" value="Change password">
                </div>
          </form>
        </div>';
}
echo '
        </div>
      </div>
      <div class="col-sm">
      </div>
    </div>
  </div>
  ';
