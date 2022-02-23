<?php
# Access session.
session_start();

# Redirect if not logged in.
if (!isset($_SESSION['user_id'])) {
    require('login_tools.php');
    load();
}

# Check form submitted.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    # Connect to the database.
    require('connect_db.php');

    # Initialize an error array.
    $errors = array();

    # Check for an email address:
    if (empty($_POST['email'])) {
        $errors[] = 'Enter your email address.';
    } else {
        $e = mysqli_real_escape_string($link, trim($_POST['email']));
    }

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

    # Check for Expiry year.
    if (!empty($_POST['exp_year'])) {
        $y = mysqli_real_escape_string($link, trim($_POST['exp_year']));
    } else {
        $errors[] = 'Enter expiry year.';
    }

    # Check for cvv.
    if (!empty($_POST['cvv'])) {
        $cv = mysqli_real_escape_string($link, trim($_POST['cvv']));
    } else {
        $errors[] = 'Enter CVV.';
    }

    # Check if email address already registered.
    if (empty($errors)) {
        $q = "SELECT * FROM users WHERE email='$e'";
        $r = @mysqli_query($link, $q);
    }

    # On success new card details into 'users' database table.
    if (empty($errors)) {
        $q = "UPDATE users SET card_number='$cn', exp_month='$m', exp_year='$y', cvv='$cv' WHERE email='$e'";
        $r = @mysqli_query($link, $q);
        if ($r) {
            $SuccessCard = urlencode("Card details have been updated successfully.");
            header("Location:user.php?SuccessCard=".$SuccessCard);
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
        $errMessage = urlencode("Error updating card details");
        header("Location:user.php?errMessage=".$errMessage);
        die;
    }
}
