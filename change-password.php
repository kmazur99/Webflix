<?php
# Access session.
session_start();

# Redirect if not logged in.
require('redirect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    # Connect to the database.
    require('connect_db.php');

    $errors = array();

    # Check for a password and matching inputs.
    if (!empty($_POST['pass1'])) {
        if ($_POST['pass1'] != $_POST['pass2']) {
            $errors[] = 'Passwords do not match.';
        } else {
            $p = mysqli_real_escape_string($link, trim($_POST['pass1']));
        }
    } else {
        $errors[] = 'Enter your password.';
    }

    # Check if email address already registered.
    if (empty($errors)) {
        $q = "SELECT * FROM users WHERE email='$e'";
        $r = @mysqli_query($link, $q);
    }

    # On success update password
    if (empty($errors)) {
        $q = "UPDATE users SET pass= SHA2('$p',256) WHERE user_id={$_SESSION['user_id']}";
        $r = @mysqli_query($link, $q);
        if ($r) {
            $Message = urlencode("Password has been changed successfully.");
            header("Location:user.php?Success=" . $Message);
            die;
        } else {
            echo "Error updating record: " . $link->error;
        }

        mysqli_close($link);
        exit();
    }

    # Report errors.
    else {
        $Message = urlencode("Passwords do not match.");
        header("Location:user.php?Message=" . $Message);
        die;
    }
}
