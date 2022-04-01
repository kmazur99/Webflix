<?php

# Include navbar
include('navbar.php');

# Check form submitted.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  # Connect to the database.
  require('connect_db.php');
  # Initialize an error array.
  $errors = array();
  # Check for a first name.
  if (empty($_POST['first_name'])) {
    $errors[] = 'Enter your first name.';
  } else {
    $fn = mysqli_real_escape_string($link, trim($_POST['first_name']));
  }

  if (empty($_POST['last_name'])) {
    $errors[] = 'Enter your last name.';
  } else {
    $ln = mysqli_real_escape_string($link, trim($_POST['last_name']));
  }

  if (empty($_POST['email'])) {
    $errors[] = 'Enter your Email.';
  } else {
    $email = mysqli_real_escape_string($link, trim($_POST['email']));
  }


  # Check for a password and matching input passwords.
  if (!empty($_POST['pass1'])) {
    if ($_POST['pass1'] != $_POST['pass2']) {
      $errors[] = 'Passwords do not match.';
      unset($_POST['pass1'], $_POST['pass2']);
    } else {
      $p = mysqli_real_escape_string($link, trim($_POST['pass1']));
    }
  } else {
    $errors[] = 'Enter your password.';
  }

  if (empty($_POST['card_number'])) {
    $errors[] = 'Enter your Card Number.';
  } else {
    $card_no = mysqli_real_escape_string($link, trim($_POST['card_number']));
  }

  if (empty($_POST['contact_number'])) {
    $errors[] = 'Enter your contact Number.';
  } else {
    $contact_no = mysqli_real_escape_string($link, trim($_POST['contact_number']));
  }

  if (empty($_POST['country'])) {
    $errors[] = 'Enter your country.';
  } else {
    $country = mysqli_real_escape_string($link, trim($_POST['country']));
  }

  if (empty($_POST['DOB'])) {
    $errors[] = 'Enter your date of birth.';
  } else {
    $DOB = mysqli_real_escape_string($link, trim($_POST['DOB']));
  }

  if (empty($_POST['exp_month'])) {
    $errors[] = 'Enter your Card Exp Month.';
  } else {
    $exp_m = mysqli_real_escape_string($link, trim($_POST['exp_month']));
  }

  if (empty($_POST['exp_year'])) {
    $errors[] = 'Enter your Card Exp Year.';
  } else {
    $exp_y = mysqli_real_escape_string($link, trim($_POST['exp_year']));
  }

  if (empty($_POST['cvv'])) {
    $errors[] = 'Enter your Card CVV.';
  } else {
    $cvv = mysqli_real_escape_string($link, trim($_POST['cvv']));
  }

  # Check if email address already registered.
  if (empty($errors)) {
    $q = "SELECT user_id FROM users WHERE email='$email'";
    $r = @mysqli_query($link, $q);
    unset($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['pass1'], $_POST['pass2'], $_POST['contact_number'], $_POST['country'], $_POST['DOB'], $_POST['card_number'], $_POST['exp_month'], $_POST['exp_year'], $_POST['cvv']);
    $title = 'Email already registered';
    if (mysqli_num_rows($r) != 0) $errors[] = 'An account is already registered with this email address
    <hr>
<footer">
<a href="login.php"> <button type="button" class="btn btn-secondary" role="button">Log in</button></a>
 </footer></div>  ';
  }

  # On success register user inserting into 'users' database table.
  if (empty($errors)) {
    $q = "INSERT INTO users (first_name, last_name, DOB, email, contact_number, country, pass, card_number, exp_month, exp_year, cvv, reg_date) VALUES ('$fn', '$ln', '$DOB', '$email', '$contact_no', '$country', SHA2('$p',256), '$card_no', '$exp_m', '$exp_y', '$cvv', NOW() )";
    $r = @mysqli_query($link, $q);
    if ($r) {

      $title = 'Success';
      echo '<div class="container"><div class="alert alert-dark" role="alert">
	   <h4 class="alert-heading">' . $title . '</h4>
     <p>Your account has been registered successfully</p>
      ';
      echo '
     <hr>
<footer">
<a href="login.php"> <button type="button" class="btn btn-secondary" role="button">Log in</button></a>
  </footer></div></div>
 ';
 unset($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['pass1'], $_POST['pass2'], $_POST['contact_number'], $_POST['country'], $_POST['DOB'], $_POST['card_number'], $_POST['exp_month'], $_POST['exp_year'], $_POST['cvv']);

    }
    
    # Close database connection.
    mysqli_close($link);
  }

  # Or report errors.
  else {
    $title = 'Error';
    echo '<div class="container"><div class="alert alert-dark" role="alert">
	   <h4 class="alert-heading">' . $title . '</h4>';
    foreach ($errors as $msg) {
      echo " <p> $msg </p>";
    }
    echo '
<footer">
  </footer></div></div>';
    # Close database connection.
    mysqli_close($link);
  }
}
include('includes/bootstrap.html');
?>
<title>Register - Webflix</title>
<br>
<div class="container">
  <div class="row">
    <div class="col-sm">

    </div>
    <div class="col-sm">
      <div class="card card-dark mb-3">
        <div class="card-header">
          <h1 style="text-align: center">Register</h1>
          <hr>
        </div>
        <div class="card-body">
          <form name="RegisterForm" id="RegisterForm" action="register.php" method="post">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="exampleInputName">First Name</label>
                <input type="text" pattern="[a-zA-Z]+" class="form-control" id="exampleInputName" name="first_name" size="20" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" required>
              </div>
              <div class="form-group col-md-6">
                <label for="exampleLastName">Last Name</label>
                <input type="text" pattern="[a-zA-Z]+" class="form-control" id="exampleLastName" name="last_name" size="20" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" size="40" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" required>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
              <label for="examplePassword">Password</label>
              <input type="password" class="form-control" id="examplePassword" name="pass1" size="30" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>" required>
            </div>
            <div class="form-group col-md-6">
              <label for="examplePassword2">Confirm Password</label>
              <input type="password" class="form-control" id="examplePassword2" name="pass2" size="30" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>" required>
            </div>
            </div>
            <div class="form-group">
              <label for="examplePhoneNo">Contact number</label>
              <input type="number" class="form-control" id="examplePhoneNo" name="contact_number" size="20" value="<?php if (isset($_POST['contact_number'])) echo $_POST['contact_number']; ?>" required>
            </div>
            <div class="form-group">
              <label for="exampleCountry">Country</label>
              <input type="text" pattern="[a-zA-Z\s]+" class="form-control" id="exampleCountry" name="country" size="30" value="<?php if (isset($_POST['country'])) echo $_POST['country']; ?>" required>
            </div>
            <div class="form-group">
              <label for="exampleDOB">DOB</label>
              <input type="date" max="2022-01-01" class="form-control" id="exampleDOB" name="DOB" size="30" value="<?php if (isset($_POST['DOB'])) echo $_POST['DOB']; ?>" required>
            </div>
            <div class="form-group">
              <label for="exampleCardNumber">Card number</label>
              <input type="text" pattern="[0-9]{16}" class="form-control" id="exampleCardNumber" name="card_number" size="16" value="<?php if (isset($_POST['card_number'])) echo $_POST['card_number']; ?>" required>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="exampleExpiryMonth">Expiry Month</label>
                <input type="text" pattern="[0-9]{2}" class="form-control" id="exampleExpiryMonth" placeholder="MM" name="exp_month" size="2" value="<?php if (isset($_POST['exp_month'])) echo $_POST['exp_month']; ?>" required>
              </div>
              <div class="form-group col-md-4">
                <label for="exampleExpiryYear">Expiry Year</label>
                <input type="text" pattern="[0-9]{4}" class="form-control" id="exampleExpiryYear" placeholder="YYYY" name="exp_year" size="4" value="<?php if (isset($_POST['exp_year'])) echo $_POST['exp_year']; ?>" required>
              </div>
              <div class="form-group col-md-4">
                <label for="exampleCvv">CVV</label>
                <input type="text" pattern="[0-9]{3}" class="form-control" id="exampleCvv" placeholder="CVV" name="cvv" size="3" value="<?php if (isset($_POST['cvv'])) echo $_POST['cvv']; ?>" required>
              </div>
            </div>
            <a>Already have an account? </a><a href="login.php"><span style="color:#C72606;">Sign in</span></a>
            <div style="text-align:center">
            <br>
              <button type="submit" class="btn btn-primary" name="register">Create Account</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-sm">

    </div>
  </div>
</div>

<script>
function clearForm() {
  document.getElementById('first_name').value = '';
}
</script>

