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

    # Check for a password and matching input passwords.
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

    # On success new password into 'users' database table.
    if (empty($errors)) {
        $q = "UPDATE users SET pass= SHA2('$p',256) WHERE user_id={$_SESSION['user_id']}";
        $r = @mysqli_query($link, $q);
        if ($r) {
            $Success = urlencode("Password has been changed successfully.");
            header("Location:user.php?Success=".$Success);
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
    $Message = urlencode("Passwords do not match.");
    header("Location:user.php?Message=".$Message);
    die;
        
    }
}
