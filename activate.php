<?php
# Access session
session_start();

# Open database connection.
require('connect_db.php');
# Load bootstrap + css
include('includes/bootstrap.html');

# Display error message
if (isset($_GET['Message'])) {
  echo '
        <div class="alert alert-dark" role="alert">
        <h4 class="alert-heading">Error</h4>
        <p> ' . $_GET['Message'] . ' </p>
        <hr>
        <footer">
        </footer>
        </div>
      ';
}

# Display navbar
echo '
  <nav class="navbar navbar-expand-sm bg-dark" style="background-color: #ffffff00 !important;">
  <a class="navbar-brand" href="home.php"><span style="color:#C72606; font-size: 36px;">Webflix</span></a>
  </nav>
    ';

# Get user details
$query = "SELECT * FROM users WHERE user_id={$_SESSION['user_id']}";
$result = mysqli_query($link, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $email = $row['email'];
    $fn = $row['first_name'];
    $ln = $row['last_name'];
  }
}

# Get email from URL
if (isset($_GET['email'])) {
  $email_adress = $_GET['email'];

  # Retrieve user data using email address
  $q = "SELECT * FROM users WHERE email='$email_adress'";
  $r = mysqli_query($link, $q);
  if (mysqli_num_rows($r) > 0) {
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {

      # Change the account status
      $q = "UPDATE users SET status='active' WHERE email='$email_adress'";
      $r = @mysqli_query($link, $q);
    }
  }

  # Display account activation confirmation
  echo '
        <title>Activate - Webflix</title>
        <br>
        <div class="container-fluid">
        <div class="row">
        <div class="col-sm">
        </div>
        <div class="col-sm">
        <div class="card card-dark mb-3">
        <div class="card-body">
        <div style="text-align: center;">
        <h3> Account Activated</h3>
        <hr>
        <p> Your account has been activated. You can now use the service. </p>
        <a href="home.php"> <button type="button" class="btn btn-secondary btn-block" role="button">Home</button></a>
        </div>
        </div>
        </div>
        </div>
        <div class="col-sm">
        </div>
        </div>
        </div>
      ';
} else {
  echo '
        <title>Activate - Webflix</title>
        <br>
        <div class="container-fluid">
        <div class="row">
        <div class="col-sm">
        </div>
        <div class="col-sm">
        <div class="card card-dark mb-3">
       ';

  # Display confirmation of sending email
  if (isset($_GET['Success'])) {
    echo '
          <div class="card-body">
          <div style="text-align: center;">
          <br>
          <h3> Activation email sent</h3>
          <hr>
          <p>A link to activate your account has been sent to: ' . $email . ' If you cannot see it, please check the SPAM folder.</p>
          </div>
          </div>
        ';
  } else {
    echo '
          <div class="card-body">
          <div style="text-align: center;">
          <h3> Please activate your account</h3>
          <hr>
          <p>You need to activate your account to access Webflix. Click the button below to send the activation link to your e-mail address and follow the instructions.</p>
          <form action="activation_email.php" method="post">
          <div class="form-group">
          <input type="hidden" name="email" class="form-control" value="' . $email . '" required>
          <input type="hidden" name="fn" class="form-control" value="' . $fn . '" required>
          <input type="hidden" name="ln" class="form-control" value="' . $ln . '" required>
          </div>
          <button type="submit" class="btn btn-secondary">Send activation email</button>
          </form>
          </div>
          </div>
        ';
  }
  echo '
        </div>
        </div>
        <div class="col-sm">
        </div>
        </div>
        </div>
      ';
}
include('footer.html');
