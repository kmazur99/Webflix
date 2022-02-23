<?php
include('navbar.php');
# Access session.
session_start();

unset($_SESSION['cart']); // prevent adding more than 1 movie to the cart at once

# Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);

# Open database connection.
require('connect_db.php');

$query = "SELECT * FROM users WHERE user_id={$_SESSION['user_id']}";
$result = mysqli_query($link, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $subscription = $row['subscription'];
        
    }
  }

# Get passed product id and assign it to a variable.
if (isset($_GET['id'])) $id = $_GET['id'];

# Retrieve selective item data from 'movie' database table. 
$q = "SELECT * FROM movie WHERE id = $id";
$r = mysqli_query($link, $q);

if (mysqli_num_rows($r) == 1) {

  $row = mysqli_fetch_array($r, MYSQLI_ASSOC);

    $_SESSION['cart'][$id] = array('quantity' => 1, 'price' => $row['mov_price']);

    if ($subscription == 'Premium') { # Only display for premium users
      echo '
        <br>
        <div class="container-fluid">
			  <h1 class="display-4">' . $row['movie_title'] . '</h1>
        <div class="row">
	      <div class="col-sm-12 col-md-4">
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
        <div class="col-sm-12 col-md-4">
        <p>' . $row['further_info'] . '</p>
        <h4>Watch</h4>
        <hr>
        <h2> 
        <a href="show1.php"> <button type="button" class="btn btn-secondary" role="button"> ' . $row['show1'] . ' </button></a>
        </h2>
        <br>
        <h4>Trailer</h4>
        <hr>
        <h2> 
        <a href="mov-rev.php?movie_title=' . $row['movie_title'] . '"> <button type="button" class="btn btn-secondary" role="button">This Movie</button></a>
        <a href="review.php"> <button type="button" class="btn btn-secondary" role="button">All Movies</button></a>
        </h2>';
  }else{
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
        <h4>AVAILABLE WITH WEBFLIX PREMIUM</h4>
        <hr>
        <p>' . $row['further_info'] . '</p>
        <h2> 
        <a href="#"> <button type="button" class="btn btn-secondary" role="button">Buy Premium</button></a>
        </h2>
        ';
  }
}
  # Close database connection.
  mysqli_close($link);


include('includes/bootstrap.html');
