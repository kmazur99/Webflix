<?php
include('navbar.php');
# Access session.
session_start();

# Open database connection.
require('connect_db.php');

# Retrieve items from 'booking' database table.
$q = "SELECT * FROM booking WHERE user_id=($_SESSION[user_id])
ORDER BY booking_date DESC
LIMIT 10";
$r = mysqli_query($link, $q);
if (mysqli_num_rows($r) > 0) {

    echo '
    <br>
    <div class="container">
    <h1 class="text-center">Booking History</h1>
    <hr>';
    while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
      {
    echo '<div class="alert alert-dark" role="alert">
                <h4 class="alert-heading">Booking Reference:  #EC1000' . $row['booking_id'] . '  </h4>
    <p>Total Paid:   &pound ' . $row['total'] . ' </p>
    <hr>
    <footer">
    <small><p>'  . $row['booking_date'] . '</p></small>
    </footer>
    </div>
                
    ';  
      }
    }
    else { echo '<div class="container">
    <br>
    <div class="alert alert-secondary" role="alert">
    <p>You have no movie reviews</p>
    </div>
    <div> ' ; }

    include('includes/bootstrap.html');
