<?php
include('navbar.php');
# Access session.
session_start();

# Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);

# Open database connection.
require('connect_db.php');

# Get passed product id and assign it to a variable.
if (isset($_GET['id'])) $id = $_GET['id'];

# Retrieve selective item data from 'coming_soon' database table. 
$q = "SELECT * FROM coming_soon WHERE id = $id";
$r = mysqli_query($link, $q);

if (mysqli_num_rows($r) == 1) {

  $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
    echo '
        <br>
        <div class="container-fluid">
			  <h1 class="display-4">' . $row['movie_title'] . '</h1>
        <div class="row">
	      <div class="col-sm-12 col-md-6">
	      <div class="embed-responsive embed-responsive-16by9">
	      <iframe class="embed-responsive-item" src=' . $row['preview'] . '   
        frameborder="0" allow="accelerometer; 
        autoplay; 
        encrypted-media; 
        gyroscope; 
        picture-in-picture"   allowfullscreen>
        </iframe>
        </div>
        </div> 
        <div class="col-sm-12 col-md-6">
        <hr>
        <h4>Release Date: ' .$row['release_date'] . '</h4>
        <hr>
        <p>' . $row['further_info'] . '</p>
        ';
  
  # Close database connection.
  mysqli_close($link);
}

include('includes/bootstrap.html');
