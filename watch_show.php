<?php
include('navbar.php');
session_start();

# Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);

# Open database connection.
require('connect_db.php');

# Get passed product id and assign it to a variable.
if (isset($_GET['id'])) $id = $_GET['id'];

# Retrieve selective item data from 'movie' database table. 
$q = "SELECT * FROM tv_show WHERE id = $id";
$r = mysqli_query($link, $q);

if (isset($_GET['season'])) $season = $_GET['season'];
if (isset($_GET['episode'])) $episode = $_GET['episode'];

  $row = mysqli_fetch_array($r, MYSQLI_ASSOC);

    echo '
    <title>Webflix</title>
    <div id="mv-info">
    <div id="content-embed">
    <iframe class="embed-responsive-item" src=' . $row['link'] . '&s=' .$season. '&e=' .$episode.' 
    frameborder="no" scrolling="no" allow="autoplay; encrypted-media" allowfullscreen="yes" style="width: 100%; height: 100%;"></iframe></div>
    </iframe>
    </div>
    </div>
        ';
    if ($episode <= 5){
      echo'<a href="watch_show.php?id=' . $row['id'] . '&season=' .$season. '&episode=' .++$episode.'"> <button type="button" class="btn btn-secondary" role="button"><h3><i class="fa-solid fa-caret-right"></i> Next episode</h3></button></a>';
    }
    else{
      echo'<a href="watch_show.php?id=' . $row['id'] . '&season=' .++$season. '&episode=1"> <button type="button" class="btn btn-secondary" role="button"><h3><i class="fa-solid fa-caret-right"></i> Next Season</h3></button></a>';
    }



# Close database connection.
mysqli_close($link);

include('includes/bootstrap.html');




