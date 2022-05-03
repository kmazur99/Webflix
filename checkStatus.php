<?php
# Access session.
session_start();

# Open database connection.
require('connect_db.php');
# Redirect if not logged in.
require('redirect.php');

# Get user account status
$query = "SELECT * FROM users WHERE user_id={$_SESSION['user_id']}";
$result = mysqli_query($link, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $status = $row['status'];
  }
}

# Check account status
if(strtolower($status) == 'inactive'){
    header("Location: activate.php");
}
elseif(strtolower($status) == 'blocked'){
    header("Location: accountBlocked.php");
}