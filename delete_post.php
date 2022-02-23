<?php
# Access session.
session_start();

# Redirect if not logged in.
if (!isset($_SESSION['user_id'])) {
    require('login_tools.php');
    load();
}

# Open database connection.
require('connect_db.php');

if (isset($_GET['post_id'])) $post_id = $_GET['post_id'];

$sql = "DELETE FROM mov_rev WHERE post_id='$post_id'";
if ($link->query($sql) === TRUE) {
    header("Location: my_reviews.php");
} else {
    echo "Error deleting record: " . $link->error;
}
