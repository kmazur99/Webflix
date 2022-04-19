<?php
include('navbar.php');
session_start();

# Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);

# Open database connection.
require('connect_db.php');
require('checkPremium.php');

# Get passed product id and assign it to a variable.
if (isset($_GET['id'])) $id = $_GET['id'];

# Retrieve selective item data from 'movie' database table. 
$q = "SELECT * FROM movie WHERE id = $id";
$r = mysqli_query($link, $q);


  $row = mysqli_fetch_array($r, MYSQLI_ASSOC);

    echo '
    <title>Webflix</title>
    <div id="mv-info">
    <div id="content-embed">
    <iframe class="embed-responsive-item" src=' . $row['link'] . ' 
    frameborder="no" scrolling="no" allowfullscreen="yes" style="width: 100%; height: 100%;"></iframe></div>
    </iframe>
    </div>
    </div>
        ';


# Close database connection.
mysqli_close($link);

include('includes/bootstrap.html');
