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
$q = "SELECT * FROM coming_soon WHERE id = $id";
$r = mysqli_query($link, $q);

if (mysqli_num_rows($r) == 1) {

  $row = mysqli_fetch_array($r, MYSQLI_ASSOC);

  $_SESSION['cart'][$id] = array('quantity' => 1, 'price' => $row['mov_price']);

  if ($subscription == 'Premium') { # Only display for premium users
    echo '
      <title>Webflix</title>
        <br>
        <div class="container-fluid">
        <div class="row">
        <div class="col-sm-12 col-md-1">
        </div>
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
        <div class="col-sm-12 col-md-4">
        <h1>' . $row['movie_title'] . '</h1>
        <hr>
        <p>' . $row['further_info'] . '</p>
        <table class="table table-striped">

          <tbody>
              <tr>
              <td><h6>Categories</h6></td>
              <td><h6>' .$row['movie_title'].'</h6></td>
              </tr>
              <tr>
              <td><h6>Released</h6></td>
              <td><h6>' .$row['movie_title'].'</h6></td>
              </tr>
              <tr>
              <td><h6>No. of seasons</h6></td>
              <td><h6>' .$row['movie_title'].'</h6></td>
              </tr>
              <tr>
              <td><h6>Language</h6></td>
              <td><h6>' .$row['movie_title'].'</h6></td>
              </tr>
          </tbody>
        </table>
        <hr>
        <a href=""> <button type="button" style="margin-right:20px;" class="btn btn-secondary" role="button"><h3><i class="fa-solid fa-caret-left"></i> Previous episode</h3></button></a> 
        <a href=""> <button type="button" class="btn btn-secondary" role="button"><h3><i class="fa-solid fa-caret-right"></i> Next episode</h3></button></a>
        </div> 
        ';
  } else {
    echo '
      <title>Webflix</title>
        <br>
        <div class="container-fluid">
        <div class="row">
        <div class="col-sm-12 col-md-1">
        </div>
        
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
        <div class="col-sm-12 col-md-4">
        <h1>' . $row['movie_title'] . '</h1>
        <hr>
        <p>' . $row['further_info'] . '</p>
        <table class="table table-striped">

          <tbody>
              <tr>
              <td><h6>Categories</h6></td>
              <td><h6>' .$row['movie_title'].'</h6></td>
              </tr>
              <tr>
              <td><h6>Released</h6></td>
              <td><h6>' .$row['movie_title'].'</h6></td>
              </tr>
              <tr>
              <td><h6>No. of seasons</h6></td>
              <td><h6>' .$row['movie_title'].'</h6></td>
              </tr>
              <tr>
              <td><h6>Language</h6></td>
              <td><h6>' .$row['movie_title'].'</h6></td>
              </tr>
          </tbody>
        </table>
        <h3>Watch now with webflix premium</h3>
        <hr>
        <a href=""> <button type="button" class="btn btn-secondary" role="button"><h3>Purchase premium</h3></button></a>
        </div> 
        ';
  }
}
# Close database connection.
mysqli_close($link);


include('includes/bootstrap.html');
