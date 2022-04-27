<?php
# Access session.
session_start();

# Redirect if not logged in.
include('redirect.php');

# Check form submitted.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    # Connect to the database.
    require('connect_db.php');

    $errors = array();

    # Check for card number:
    if (empty($_POST['card_number'])) {
        $errors[] = 'Enter your card number.';
    } else {
        $cn = mysqli_real_escape_string($link, trim($_POST['card_number']));
    }

    # Check for Expiry month.
    if (!empty($_POST['exp_month'])) {
        $m = mysqli_real_escape_string($link, trim($_POST['exp_month']));
    } else {
        $errors[] = 'Enter expiry month.';
    }

    if($m > 12 || $m < 01){
        $errors[] = 'Enter a valid expiry month.';
      }

    # Check for Expiry year.
    if (!empty($_POST['exp_year'])) {
        $y = mysqli_real_escape_string($link, trim($_POST['exp_year']));
    } else {
        $errors[] = 'Enter expiry year.';
    }

    if($y < date("Y")){
        $errors[] = 'Enter a valid expiry year.';
      }

    # Check for cvv.
    if (!empty($_POST['cvv'])) {
        $cv = mysqli_real_escape_string($link, trim($_POST['cvv']));
    } else {
        $errors[] = 'Enter CVV.';
    }


    # On success new card details into 'users' database table.
    if (empty($errors)) {
        $q = "UPDATE users SET card_number='$cn', exp_month='$m', exp_year='$y', cvv='$cv' WHERE user_id={$_SESSION['user_id']}";
        $r = @mysqli_query($link, $q);
        if ($r) {
            $Message = urlencode("Card details have been updated successfully.");
            header("Location:user.php?Success=".$Message);
            die;
        } else {
            echo "Error updating record: " . $link->error;
        }

        # Close database connection.
        mysqli_close($link);
        exit();
    }

    # Or report errors.
    else {
        foreach ($errors as $msg) {
        header("Location:user.php?Message=".$msg);
        }
        die;
    }
}
