<?php
# PROCESS REVIEW POST.

# Access session.
session_start();

# Redirect if not logged in.
if (!isset($_SESSION['user_id'])) {
  require('login_tools.php');
  load();
}

if ($_SERVER['REQUEST_METHOD'] = 'POST') {

  # Open database connection.
  require('connect_db.php');

  # Execute inserting into 'review' database table.
  $q = "INSERT INTO mov_rev(id,first_name,last_name,movie_title,rate, message, post_date) 
VALUES('{$_SESSION['user_id']}',
'{$_SESSION['first_name']}',
'{$_SESSION['last_name']}',
'{$_POST['movie_title']}',
'{$_POST['rate']}',
'{$_POST['message']}',NOW() )";
  $r = mysqli_query($link, $q);
  # Report error on failure.
  if (mysqli_affected_rows($link) != 1) {
    echo '<p>Error</p>' . mysqli_error($link);
  } else {
    header("Location: review.php");
  }
}
