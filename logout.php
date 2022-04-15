<?php # DISPLAY COMPLETE LOGGED OUT PAGE.

# Access session.
session_start();

# Redirect if not logged in.
if (!isset($_SESSION['user_id'])) {
    require('login_tools.php');
    load();
}

# Clear existing variables.
$_SESSION = array();

# Destroy the session.
session_destroy();

$Success = urlencode("You have been successfully logged out.");
  header("Location:login.php?Success=".$Success);
  die;
