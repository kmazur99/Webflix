<?php # DISPLAY COMPLETE REGISTRATION PAGE.
include('navbar.php');
# Access session.
session_start();

# Redirect if not logged in.
if (!isset($_SESSION['user_id'])) {
    require('login_tools.php');
    load();
}

# Display error message if passwords don't match
if(isset($_GET['Message'])){
    echo '<div class="alert alert-dark" role="alert">
    <h4 class="alert-heading">Error</h4>
    <p> '. $_GET['Message'] .' </p>
  <hr>
<footer">
</footer></div>  ';
}

# Display error message if card cannot be updated
if(isset($_GET['errMessage'])){
    echo '<div class="alert alert-dark" role="alert">
    <h4 class="alert-heading">Error</h4>
    <p> '. $_GET['errMessage'] .' </p>
  <hr>
<footer">
</footer></div>  ';
}

# Display message when password has been changed
if(isset($_GET['Success'])){
    echo '<div class="alert alert-dark" role="alert">
    <h4 class="alert-heading">Success</h4>
    <p> '. $_GET['Success'] .' </p>
  <hr>
<footer">
</footer></div>  ';
}

# Display message when card details have been updated
if(isset($_GET['SuccessCard'])){
    echo '<div class="alert alert-dark" role="alert">
    <h4 class="alert-heading">Success</h4>
    <p> '. $_GET['SuccessCard'] .' </p>
  <hr>
<footer">
</footer></div>  ';
}


# Open database connection.
require('connect_db.php');

# Retrieve items from 'users' database table.
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
    <li class="list-group-item">
     <div class="form-group row">
<label for="email" class="col-sm-12 col-form-label"><strong>Email: </strong>'  . $row['email'] . '</label> 			  
      </div>
    </li>
    <li class="list-group-item">
     <div class="form-group row">
<label for="email" class="col-sm-12 col-form-label"><strong>Subscription type: </strong>'  . $row['subscription'] . '</label> 			  
      </div>
    </li>

    <li class="list-group-item">
<button type="button" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#password">Change Password</button>
</li>
</ul>
</form> 
</div>
</div>
</div>

';
    }
} else {
    echo '<h3>No user details.</h3>';
}

# Retrieve items from 'users' database table.
$q = "SELECT * FROM users WHERE user_id={$_SESSION['user_id']}";
$r = mysqli_query($link, $q);
if (mysqli_num_rows($r) > 0) {
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        echo '
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
    <label for="cardNo" class="col-sm-12 col-form-label"><strong>Card Number: </strong>'  . $row['card_number'] . '</label> 			  
          </div>
        </li>
        <li class="list-group-item">
         <div class="form-group row">
    <label for="expDate" class="col-sm-12 col-form-label"><strong>Expiry Date: </strong>'  . $row['exp_month'] . ' / '  . $row['exp_year'] . '</label> 			  
          </div>
        </li>
      
        <li class="list-group-item">
        <button type="button" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#card">Update Card</button>
        </li>
      </ul>
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
} else {
    echo '<div class="alert alert-danger" alert-dismissible fade show" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		   </button>
			<h1>Card Stored</h1>
			<h3>No card stored.</h3>
		</div>
';
}

include('includes/bootstrap.html');

?>

<div class="modal fade" id="password" tabindex="-1" role="dialog" aria-labelledby="password" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Change Password</h5>
            </div>

            <div class="modal-body">
                <form action="change-password.php" method="post">
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Confirm Email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" required>
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
                <input class="btn btn-dark" type="submit" value="Save Changes">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
            </form>
        </div>
        <!--Close body-->
    </div>
    <!--Close modal-body-->
</div><!-- Close modal-fade-->

<div class="modal fade" id="card" tabindex="-1" role="dialog" aria-labelledby="card" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Update Card</h5>
            </div>

            <div class="modal-body">
                <form action="update-card.php" method="post">
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Confirm Email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="number" name="card_number" class="form-control" placeholder="Card Number" value="<?php if (isset($_POST['card_number'])) echo $_POST['card_number']; ?>" required>
                    </div>

                    <div class="form-group">
                        <input type="number" name="exp_month" class="form-control" placeholder="Expiry Month" value="<?php if (isset($_POST['exp_month'])) echo $_POST['exp_month']; ?>" required>
                    </div>

                    <div class="form-group">
                        <input type="number" name="exp_year" class="form-control" placeholder="Expiry Year" value="<?php if (isset($_POST['exp_year'])) echo $_POST['exp_year']; ?>" required>
                    </div>

                    <div class="form-group">
                        <input type="number" name="cvv" class="form-control" placeholder="CVV" value="<?php if (isset($_POST['cvv'])) echo $_POST['cvv']; ?>" required>
                    </div>

            </div>
            <div class="modal-footer">
                <div class="form-group">
                <input class="btn btn-dark" type="submit" value="Save Changes">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
            </form>
        </div>
        <!--Close body-->
    </div>
    <!--Close modal-body-->
</div><!-- Close modal-fade-->