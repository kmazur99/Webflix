<?php
# Access session.
session_start();

# Open database connection.
require('connect_db.php');
# Redirect if not logged in.
require('redirect.php');

# Check if the user has admin permissions
$query = "SELECT * FROM users WHERE user_id={$_SESSION['user_id']}";
$result = mysqli_query($link, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $permissions = $row['account_type'];
  }
}

# Redirect to the home page
if ($permissions != 'Admin') {
  header("Location: home.php");
}