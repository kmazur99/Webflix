<?php

session_start();

# Redirect if not logged in.
if (!isset($_SESSION['user_id'])) {
    require('login_tools.php');
    load();
}

include('navbar.php');

# Open database connection.
require('connect_db.php');

# Retrieve items from 'booking' database table.
$q = "SELECT * FROM booking WHERE user_id=($_SESSION[user_id])
ORDER BY booking_date DESC
LIMIT 1";
$r = mysqli_query($link, $q);
if (mysqli_num_rows($r) > 0) {

    echo '<body>
    <br>
    <div class="container">
    <h1 class="text-center">Latest Booking</h1>
    <hr>
    <div class="card card-dark mb-3"> 
             <div class="row no-gutters" style="padding-top: 15px; padding-bottom: 15px;">
                 <div class="col-md-4" style="margin-top: auto; margin-bottom: auto; text-align: center;"> 
                <img width="256" alt="QR Code " src="img/qrcode.png">
                 </div>
                 <div class="col-md-8">
                 <div class="card-body">
        ';
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        echo '
          <ul class="list-group">
            <li class="list-group-item">
              <div class="form-group row">
                         <label for="booking ref" class="col-sm-12 col-form-label">
               Booking Reference:  #EC1000' . $row['booking_id'] . '</label> 
              </div>
                   </li>
           <li class="list-group-item">
                <div class="form-group row">
                 <label for="booking ref" class="col-sm-12 col-form-label">
              Total Paid:   &pound ' . $row['total'] . ' 
                 </label>
                </div>
              </li>
                </ul>
          <hr>
      <div class="card-footer">
         <small>'  . $row['booking_date'] . '</small>
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
include('includes/bootstrap.html');
