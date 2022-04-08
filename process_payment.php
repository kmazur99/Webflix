<?php

session_start();
# Open database connection.
require('connect_db.php');

# Get Security code
$cvv = $_POST['cvv'];

# Retrieve user data
$q = "SELECT * FROM users WHERE user_id={$_SESSION['user_id']}";
$r = mysqli_query($link, $q);
if (mysqli_num_rows($r) > 0) {
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {

        if ($cvv == $row['cvv']) {

            $q = "UPDATE users SET subscription='Premium' WHERE user_id={$_SESSION['user_id']}";
            $r = @mysqli_query($link, $q);

            $Success = urlencode("Payment successful");
            header("Location:payment.php?Success=" . $Success);
            die;
        } else {

            $errMessage = urlencode("Details don't match our records");
            header("Location:payment.php?errMessage=" . $errMessage);
            die;
        }
    }
}
