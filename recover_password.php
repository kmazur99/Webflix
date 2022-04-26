<?php
# Access session.
session_start();

# Check form submitted.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    # Connect to the database.
    require('connect_db.php');

    $errors = array();

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
    
    # Get the email address.
    $email_address = $_POST['email'];

    # Change the password for the user with the given email address.
    if (empty($errors)) {
        $q = "UPDATE users SET pass= SHA2('$p',256) WHERE email='$email_address'";
        $r = @mysqli_query($link, $q);
        if ($r) {
            $Success = urlencode("Password has been changed successfully.");
            header("Location:reset_password.php?Success=" . $Success);
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
        header("Location:reset_password.php?email=$email_address&Message=$Message");
        die;
    }
}
