<?php
# Access session.
session_start();

# Open database connection.
require('connect_db.php');
require('redirect.php');


$query = "SELECT * FROM users WHERE user_id={$_SESSION['user_id']}";
$result = mysqli_query($link, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $subscription = $row['subscription'];
  }
}

if ($subscription != 'Premium') {
  header("Location: home.php");
}