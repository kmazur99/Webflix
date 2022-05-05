<?php

# Access session.
session_start();

# Load bootstrap + css
include('includes/bootstrap.html');
# Check account status
require('checkStatus.php');
# Display navbar
include('navbar.php');
# Redirect if not logged in.
include('redirect.php');
# Open database connection.
require('connect_db.php');

# Generate transaction id
$transaction_id = rand(1000000000000, 9999999999999);

# Retrieve items from 'users' database table.
$q = "SELECT * FROM users WHERE user_id={$_SESSION['user_id']}";
$r = mysqli_query($link, $q);
if (mysqli_num_rows($r) > 0) {
  while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {

    if (isset($_GET['Success'])) {
      echo '
            <title>Payment - Webflix</title>
            <br>
            <div class="container-fluid">
            <div class="row">
            <div class="col-sm">
            </div>
            <div class="col-sm">
            <div class="card card-dark mb-3">
            <div class="card-body">
            <div style="text-align: center;">
            <i class="fa-solid fa-circle-check fa-5x"></i>
            <br><br>
            <h3> Payment successful!</h3>
            <hr>
            <div class="row">
            <div class="col-3" style="text-align: left;">
            <h6>Plan</h6>
            </div>
            <div class="col-9" style="text-align: right;">
            <h6>Premium Subscription - 1 Year plan</h6>
            </div>
            </div>
            <div class="row">
            <div class="col-9" style="text-align: left;">
            <h6>Amount paid</h6>
            </div>
            <div class="col-3" style="text-align: right;">
            <h6>&pound99.00</h6>
            </div>
            </div>
            <div class="row">
            <div class="col-5" style="text-align: left;">
            <h6>Transaction ID</h6>
            </div>
            <div class="col-7" style="text-align: right;">
            <h6>' . $transaction_id . '</h6>
            </div>
            </div>
            <br>
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
            <title>Payment - Webflix</title>
            <br>
            <div class="container-fluid">
            <div class="row">
            <div class="col-sm">
            </div>
            <div class="col-sm">
            <div class="card card-dark">
            <div class="card-header">
            <h1>Payment Summary</h1>
            <hr>
            <div class="row">
            <div class="col-9">
            <h6>Premium Subscription - 1 Year plan</h6>
            </div>
            <div class="col-3" style="text-align: center;">
            <h6>&pound99.00</h6>
            </div>
            </div>
            </div>
            <div class="card-body">
            <form action="process_payment.php" method="post">
            <div class="form-group">
            <label for="cardNo">Card number</label>
            <input type="text" class="form-control" id="cardNo" name="cardNo" value="';
            echo wordwrap($row['card_number'], 4, " ", true);
            echo '"disabled required>
            </div>
            <div class="form-group">
            <label for="nameOnCard">Name on card</label>
            <input type="text" class="form-control" id="nameOnCard" name="nameOnCard" value="' . $row['first_name'] . ' ' . $row['last_name'] . '"disabled required>
            </div>
            <div class="form-row">
            <div class="form-group col-md-6">
            <label for="expDate">Expiry date</label>
            <input type="text" class="form-control" id="expDate" name="expDate" value="'  . $row['exp_month'] . ' / '  . $row['exp_year'] . '"disabled required>
            </div>
            <div class="form-group col-md-6">
            <label for="cvv">Security code</label>
            <input type="text" pattern="[0-9]{3}" title="Please enter a vaild 3 digit CVV code" class="form-control" id="cvv" name="cvv" placeholder="Confirm CVV" required>
            ';
      if (isset($_GET['errMessage'])) {
        echo '<p style="color: #C72606;">'.$_GET['errMessage'].'</p>';
      }
      echo '
            </div>
            </div>
            <br>
            <div style="text-align:center">
            <button type="submit" class="btn btn-secondary btn-block">Pay Now</button>
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
  }
  # Close database connection.
  mysqli_close($link);
}
include('footer.html');
