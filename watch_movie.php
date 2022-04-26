<?php

session_start();

# Display navbar
include('navbar.php');
# Check if user is logged in
include('redirect.php');
# Open database connection.
require('connect_db.php');
# Check if the user has premium subscription
require('checkPremium.php');

# Get passed movie id and assign it to a variable.
if (isset($_GET['id'])) $id = $_GET['id'];

# Retrieve movie data from the database. 
$q = "SELECT * FROM movie WHERE id = $id";
$r = mysqli_query($link, $q);

  $row = mysqli_fetch_array($r, MYSQLI_ASSOC);

    echo '
    <title>Webflix</title>
    <div id="mv-info">
    <div id="content-embed">
    <iframe src=' . $row['link'] . ' 
    frameborder="no" scrolling="no" allowfullscreen="yes" style="width: 100%; height: 100%;"></iframe></div>
    </iframe>
    </div>
        ';


# Close database connection.
mysqli_close($link);

# Load bootstrap + css
include('includes/bootstrap.html');
