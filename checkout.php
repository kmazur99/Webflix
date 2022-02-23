<?php

session_start();

# Redirect if not logged in.
if (!isset($_SESSION['user_id'])) {
    require('login_tools.php');
    load();
}

include('navbar.php');

# Check for passed total and cart.
if (isset($_GET['total']) && ($_GET['total'] > 0) && (!empty($_SESSION['cart']))) {

    # Open database connection.
    require('connect_db.php');

    # Ticket reservation and total in 'booking' database table.
    $q = "INSERT INTO booking ( user_id, total, booking_date ) 
VALUES (
" . $_SESSION['user_id'] . "," . $_GET['total'] . ", NOW() 
) ";
    $r = mysqli_query($link, $q);

    # Retrieve current booking id.
    $booking_id = mysqli_insert_id($link);

    # Retrieve cart items from 'movie' database table.
    $q = "SELECT * FROM movie WHERE id IN (";
    foreach ($_SESSION['cart'] as $id => $value) {
        $q .= $id . ',';
    }
    $q = substr($q, 0, -1) . ') ORDER BY id ASC';
    $r = mysqli_query($link, $q);

    # Store order contents in 'booking_contents' database table.
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        $query = "INSERT INTO booking_contents
  ( booking_id, id, quantity, mov_price )
  VALUES ( $booking_id, " . $row['id'] . "," . $_SESSION['cart'][$row['id']]['quantity'] . "," . $_SESSION['cart'][$row['id']]['price'] . ")";
        $result = mysqli_query($link, $query);
    }
    # Remove booking items.  
    $_SESSION['cart'] = NULL;
}

# Or display a message.
else {
    echo '<p></p>';
}
# Retrieve items from 'booking' database table.
$q = "SELECT * FROM booking WHERE user_id=($_SESSION[user_id])
ORDER BY booking_date DESC
LIMIT 1";
$r = mysqli_query($link, $q);
if (mysqli_num_rows($r) > 0) {

    echo '
    <br>
    <div class="container">
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
      ';
    }
    # Close database connection.
    mysqli_close($link);
}

include('includes/bootstrap.html');
?>

<div class="modal fade" id="thankYou" tabindex="-1" role="dialog" aria-labelledby="thankYou" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Thank You!</h5>
            </div>

            <div class="modal-body">
                <p><strong>Thank You for booking with ECinema. Please enjoy your movie!</strong></p>
                <p>Why not pre-order your snacks and drinks online? Then simply collect them at any till when you visit.
                <p>

                <div class="modal-footer mr-auto">

                    <a href="snackshack.php"> <button type="button" class="btn btn-secondary" role="button">Snacks & Drinks</button></a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Close</button>

                </div>
            </div>
            </form>
        </div>
        <!--Close body-->
    </div>
    <!--Close modal-body-->
</div><!-- Close modal-fade-->

<script>
    $(window).on('load', function() {
        $('#thankYou').modal('show');
    });
</script>