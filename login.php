  <?php
  # Load bootstrap + CSS
  include('includes/bootstrap.html');

  # Display navbar
  echo '
        <nav class="navbar navbar-expand-sm bg-dark" style="background-color: #ffffff00 !important;">
        <a class="navbar-brand" href="home.php"><span style="color:#C72606; font-size: 36px;">Webflix</span></a>
        </nav>
  ';

  # Display logout popup
  if (isset($_GET['Success'])) {
    echo '
          <div class="alert alert-dark" role="alert">
          <h4 class="alert-heading">Logout</h4>
          <p> ' . $_GET['Success'] . ' </p>
          <hr>
          <footer">
          </footer>
          </div> 
    ';
  }

  # Display any error messages if present.
  if (isset($errors) && !empty($errors)) {
    $title = 'Log in error';
    echo '
          <div class="alert alert-dark" role="alert">
	        <h4 class="alert-heading">' . $title . '</h4>
    ';
    foreach ($errors as $msg) {
      echo ' 
            <p> '.$msg.' </p>
      ';
    }
    echo '
          <hr>
          <footer">
          </footer>
          </div>
    ';
  }

  include('footer.html');
  ?>

  <br>
  <title>Sign In - Webflix</title>
  <div class="container">
    <div class="row">
      <div class="col-sm">
      </div>
      <div class="col-sm">
        <div class="card card-dark mb-3">
          <div class="card-header">
            <h1 style="text-align: center">Sign In</h1>
            <hr>
          </div>
          <div class="card-body">
            <form action="login_action.php" method="post">
              <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" id="email" name="email" size="30" required>
              </div>
              <div class="form-group">
                <label for="email">Password:</label>
                <input type="password" class="form-control" id="password" name="pass" size="30" required>
              </div>
              <div class="form-group">
                <a href="forgot_password.php">Forgot password?</a>
                <br>
                <br>
                <a>New to Webflix? </a><a href="register.php"><span style="color:#C72606;">Sign up now</span></a>
              </div>
              <br>
              <div style="text-align:center">
                <button type="submit" class="btn btn-secondary btn-block">Sign In</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-sm">
      </div>
    </div>
  </div>