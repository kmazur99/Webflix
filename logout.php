<?php

# Access session.
session_start();

# Clear existing variables.
$_SESSION = array();

# Destroy the session.
session_destroy();

$Success = urlencode("You have been successfully logged out.");
  header("Location:login.php?Success=".$Success);
  die;
