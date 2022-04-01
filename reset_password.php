<?php # DISPLAY COMPLETE REGISTRATION PAGE.

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

# Access session.
session_start();

# Display error message if passwords don't match
if(isset($_GET['Message'])){
    echo '<div class="alert alert-dark" role="alert">
    <h4 class="alert-heading">Error</h4>
    <p> '. $_GET['Message'] .' </p>
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
<label for="email" class="col-sm-12 col-form-label"><strong>Subscription type: </strong>'  . $row['subscription'] . '</label> 			  
     </div>
   </li>
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

';
    }
} else {
    echo '<h3>No user details.</h3>';
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
