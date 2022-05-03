<?php
# Load bootstrap + css
include('includes/bootstrap.html');

# Display navbar
echo '
  <nav class="navbar navbar-expand-sm bg-dark" style="background-color: #ffffff00 !important;">
  <a class="navbar-brand" href="home.php"><span style="color:#C72606; font-size: 36px;">Webflix</span></a>
  </nav>
  ';
  
# Display footer
include('footer.html');
?>

<!-- Display message -->
<html>
<title>Account blocked - Webflix</title>
<br>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm">
    </div>
    <div class="col-sm">
      <div class="card card-dark mb-3">
        <div class="card-body">
          <div style="text-align: center;">
            <br>
            <h3> Your account has been blocked by an administrator</h3>
            <br>
            <a href="login.php"> <button type="button" class="btn btn-secondary btn-block" role="button">Back to Login page</button></a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm">
    </div>
  </div>
</div>
</html>