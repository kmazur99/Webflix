<?php

# Access session.
session_start();

# Load bootstrap + CSS
include('includes/bootstrap.html');
# Check account status
require('checkStatus.php');
# Redirect if not logged in
include('redirect.php');
# Display navbar
include('navbar.php');
# Open database connection.
require('connect_db.php');

# Retrieve movies from the database.
$q = "SELECT * FROM movie";
$r = mysqli_query($link, $q);
if (mysqli_num_rows($r) > 0) {

  echo '
  <title>Webflix</title>
  <br>
  <div class="container-fluid">
  <h1>Movies</h1>
  <hr>
  <div class="row">';

  while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
    echo ' 
     <div class="col" style="margin-top: 2rem";>
		 <div class="card border-0 " style="width: 20rem; float: none; margin: 0 auto;">
			  <div class="card text-center border-0">
        <a href="movie.php?id=' . $row['id'] . '"><img class="card-img-top" src=' . $row['img'] . ' alt="Movie"></a>
				  <h5 class="card-title">' . $row['movie_title'] . '</h5>
			   </div>
		  </div>
      </div>';
  }
}

# Retrieve tv shows from the database.
$q = "SELECT * FROM tv_show";
$r = mysqli_query($link, $q);
if (mysqli_num_rows($r) > 0) {

  echo '
  <br>
  <br>
  <div class="container-fluid">
  <br>
  <h1>TV Shows</h1>
  <hr>
  <div class="row">';

  while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
    echo ' 
     <div class="col" style="margin-top: 2rem";>
		 <div class="card border-0 " style="width: 20rem; float: none; margin: 0 auto;">
			  <div class="card text-center border-0">
        <a href="tv_show.php?id=' . $row['id'] . '"><img class="card-img-top" src=' . $row['img'] . ' alt="Movie"></a>
				  <h5 class="card-title">' . $row['show_title'] . '</h5>
			   </div>
      </div>
      </div>
      ';
  }
}

# Close database connection.
mysqli_close($link);
