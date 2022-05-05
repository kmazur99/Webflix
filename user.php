<?php

# Access session.
session_start();

# Load bootstrap + css
include('includes/bootstrap.html');
# Check account status
require('checkStatus.php');
# Display navigation bar.
include('navbar.php');
# Open database connection.
require('connect_db.php');
# Redirect if not logged in.
include('redirect.php');

# Error message pop-up
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

# Success message pop-up
if (isset($_GET['Success'])) {
    echo '
        <div class="alert alert-dark" role="alert">
        <h4 class="alert-heading">Success</h4>
        <p> ' . $_GET['Success'] . ' </p>
        <hr>
        <footer">
        </footer>
        </div>
    ';
}

# Retrieve user data from the database.
$q = "SELECT * FROM users WHERE user_id={$_SESSION['user_id']}";
$r = mysqli_query($link, $q);
if (mysqli_num_rows($r) > 0) {
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        echo '
            <title>Account - Webflix</title>
            <br>
            <div class="container">
            <div class="row">
            <div class="col-sm">
            <div class="card card-dark mb-3">
            <div class="card-header"> 
            <h5 class="card-title">Account Details</h5>
            </div>
            <div class="card-body">
            <form>
            <ul class="list-group list-group"> 
            <li class="list-group-item">
            <div class="form-group row">
            <label for="userName" class="col-sm-12 col-form-label"><strong>Name: </strong>' . $row['first_name'] . ' ' . $row['last_name'] . '</label> 
            </div>
            </li>
        ';
        if ($row['subscription'] == 'Premium') {
            echo '
                <li class="list-group-item">
                <div class="form-group row">
                <label for="email" class="col-sm-12 col-form-label"><strong>Subscription type: </strong>'  . $row['subscription'] . '
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#cancel" style="float: right;">Cancel subscription</button>	 
                </label>			  
                </div>
                </li>
            ';
        } elseif ($row['subscription'] == 'Basic') {
            echo '
                <li class="list-group-item">
                <div class="form-group row">
                <label for="email" class="col-sm-12 col-form-label"><strong>Subscription type: </strong>'  . $row['subscription'] . '
                <a href="payment.php"> <button type="button" class="btn btn-secondary" role="button" style="float: right;">Purchase premium</button></a>		
                </label>	  
                </div>
                </li>
            ';
        }
        echo '
            <li class="list-group-item">
            <div class="form-group row">
            <label for="email" class="col-sm-12 col-form-label"><strong>Email: </strong>'  . $row['email'] . '</label> 			  
            </div>
            </li>
            <li class="list-group-item">
            <div class="form-group row">
            <label for="DOB" class="col-sm-12 col-form-label"><strong>Date of Birth: </strong>'  . $row['DOB'] . '</label> 			  
            </div>
            </li>
            <li class="list-group-item">
            <div class="form-group row">
            <label for="Contact No." class="col-sm-12 col-form-label"><strong>Contact Number: </strong>'  . $row['contact_number'] . '</label> 			  
            </div>
            </li>
            <li class="list-group-item">
            <div class="form-group row">
            <label for="country" class="col-sm-12 col-form-label"><strong>Country: </strong>'  . $row['country'] . '</label> 			  
            </div>
            </li>
            <li class="list-group-item">
            <div class="form-group row">
            <label for="regDate" class="col-sm-12 col-form-label"><strong>Account created: </strong>'  . $row['reg_date'] . '</label> 			  
            </div>
            </li>
            </ul>
            <br>
            <button type="button" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#password">Change Password</button>
            </form> 
            </div>
            </div>
            </div>
            <div class="col-sm">
            <div class="card card-dark mb-3">
            <div class="card-header"> 
            <h5 class="card-title">Payment Details</h5>
            </div>
            <div class="card-body">
            <form>
            <ul class="list-group list-group"> 
            <li class="list-group-item">
            <div class="form-group row">
            <label for="cardHolder" class="col-sm-12 col-form-label"><strong>Card Holder: </strong>' . $row['first_name'] . ' ' . $row['last_name'] . '</label> 
            </div>
            </li>
            <li class="list-group-item">
            <div class="form-group row">
            <label for="cardNo" class="col-sm-12 col-form-label"><strong>Card Number: </strong>';
        echo wordwrap($row['card_number'], 4, " ", true);

        echo '
                </label> 			  
                </div>
                </li>
                <li class="list-group-item">
                <div class="form-group row">
                <label for="expDate" class="col-sm-12 col-form-label"><strong>Expiry Date: </strong>'  . $row['exp_month'] . ' / '  . $row['exp_year'] . '</label> 			  
                </div>
                </li>
                </ul>
                <br>
                <button type="button" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#card">Update Card</button>
                </form> 
                </div>
                </div>
                </div>
                </div>
                </div>
            ';
    }

    # Close database connection.
    mysqli_close($link);
}

include('footer.html');
?>

<!-- Change password pop-up -->
<div class="modal fade" id="password" tabindex="-1" role="dialog" aria-labelledby="password" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Change Password</h5>
            </div>
            <div class="modal-body">
                <form action="change-password.php" method="post">
                    <div class="form-group">
                        <input type="hidden" name="email" class="form-control" placeholder="Confirm Email" value="<?php echo $_POST[$row['email']]; ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="pass1" class="form-control" placeholder="New Password" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>" required>
                    </div>

                    <div class="form-group">
                        <input type="password" name="pass2" class="form-control" placeholder="Confirm New Password" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>" required>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input class="btn btn-secondary" type="submit" value="Save Changes">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Update card pop-up -->
<div class="modal fade" id="card" tabindex="-1" role="dialog" aria-labelledby="card" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Update Card</h5>
            </div>
            <div class="modal-body">
                <form action="update-card.php" method="post">
                    <div class="form-group">
                        <input type="hidden" name="email" class="form-control" placeholder="Confirm Email" value="<?php echo $_POST[$row['email']]; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleCardNumber">Card number</label>
                        <input type="text" pattern="[0-9]{16}" title="Please enter a vaild 16 digit card number" class="form-control" id="exampleCardNumber" placeholder="XXXX-XXXX-XXXX-XXXX" name="card_number" size="16" value="<?php if (isset($_POST['card_number'])) echo $_POST['card_number']; ?>" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="exampleExpiryMonth">Expiry Month</label>
                            <input type="text" pattern="[0-9]{2}" title="Please enter a vaild 2 digit expiry month" class="form-control" id="exampleExpiryMonth" placeholder="MM" name="exp_month" size="2" value="<?php if (isset($_POST['exp_month'])) echo $_POST['exp_month']; ?>" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleExpiryYear">Expiry Year</label>
                            <input type="text" pattern="[0-9]{4}" title="Please enter a vaild 4 digit expiry year" class="form-control" id="exampleExpiryYear" placeholder="YYYY" name="exp_year" size="4" value="<?php if (isset($_POST['exp_year'])) echo $_POST['exp_year']; ?>" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleCvv">CVV</label>
                            <input type="text" pattern="[0-9]{3}" title="Please enter a vaild 3 digit CVV code" class="form-control" id="exampleCvv" placeholder="CVV" name="cvv" size="3" value="<?php if (isset($_POST['cvv'])) echo $_POST['cvv']; ?>" required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input class="btn btn-secondary" type="submit" value="Save Changes">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Cancel subscription pop-up -->
<div class="modal fade" id="cancel" tabindex="-1" role="dialog" aria-labelledby="cancel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Cancel Your Subscription?</h5>
            </div>
            <div class="modal-body">
                <form action="process_cancellation.php" method="post">
                    <div class="form-group">
                        <input type="hidden" name="email" class="form-control" placeholder="Confirm Email" value="<?php echo $_POST[$row['email']]; ?>" required>
                    </div>
                    <p>Click "Complete Cancellation" below to cancel your subscription</p>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input class="btn btn-secondary" type="submit" value="Complete Cancellation">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Go Back</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>