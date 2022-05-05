<?php

# Access session.
session_start();

# Load bootstrap + CSS
include('includes/bootstrap.html');
# Check account status
require('checkStatus.php');
# Display navigation bar
include('navbar.php');
# Check if user is signed in
include('redirect.php');
# Open database connection.
require('connect_db.php');

# Get user subscription status
$query = "SELECT * FROM users WHERE user_id={$_SESSION['user_id']}";
$result = mysqli_query($link, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $subscription = $row['subscription'];
  }
}

# Get movie ID
if (isset($_GET['id'])) $id = $_GET['id'];

# Retrieve data from 'movie' database table. 
$q = "SELECT * FROM movie WHERE id = $id";
$r = mysqli_query($link, $q);

if (mysqli_num_rows($r) == 1) {

  $row = mysqli_fetch_array($r, MYSQLI_ASSOC);

  # Retrieve data from 'categories' database table. 
  $query = "SELECT * FROM categories WHERE category_id = {$row['category']}";
  $data = mysqli_query($link, $query);

  $category = mysqli_fetch_array($data, MYSQLI_ASSOC);

    echo '
          <title>Webflix</title>
          <br>
          <div class="container-fluid">
          <div class="row">
          <div class="col-sm-12 col-md-1">
          </div>
          <div class="col-sm-12 col-md-6">
          <div class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item" src=' . $row['preview'] . '?autoplay=1   
          frameborder="0" allow="autoplay; 
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
          <td><h6>Genre(s)</h6></td>
          <td><h6>' . $category['category_name'] . '</h6></td>
          </tr>
          <tr>
          <td><h6>Released</h6></td>
          <td><h6>' . $row['release_date'] . '</h6></td>
          </tr>
          <tr>
          <td><h6>Duration</h6></td>
          <td><h6>' . $row['duration'] . ' minutes</h6></td>
          </tr>
          <tr>
          <td><h6>Language</h6></td>
          <td><h6>' . $row['languages'] . '</h6></td>
          </tr>
          </tbody>
          </table>
          <hr>
        ';
        if ($subscription == 'Premium') {
          echo'
              <a href="watch_movie.php?id=' . $row['id'] . '"> <button type="button" class="btn btn-secondary btn-block" role="button"><h2>Watch now</h2></button></a>
              </div>
          ';
        } else {
          echo'
              <a href="payment.php"> <button type="button" class="btn btn-secondary btn-block" role="button"><h3>Purchase premium</h3></button></a>
              </div> 
          ';
  } 
}
# Close database connection.
mysqli_close($link);

include('footer.html');