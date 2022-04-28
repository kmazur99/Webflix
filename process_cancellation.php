<?php

session_start();
# Open database connection.
require('connect_db.php');

# Retrieve user data
$q = "SELECT * FROM users WHERE user_id={$_SESSION['user_id']}";
$r = mysqli_query($link, $q);
if (mysqli_num_rows($r) > 0) {
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {

            # Change the subscription status
            $q = "UPDATE users SET subscription='Basic' WHERE user_id={$_SESSION['user_id']}";
            $r = @mysqli_query($link, $q);

            $Message = urlencode("Subscription cancelled successfully.");
            header("Location:user.php?Success=" . $Message);
            die;
        
    }
}
