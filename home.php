<?php # DISPLAY COMPLETE LOGGED IN PAGE.

# Access session.
session_start();

# Check if user is signed in
include('redirect.php');

# Display navbar
include('navbar.php');

# Open database connection.
require('connect_db.php');

# Retrieve movies from 'movie' database table.
$q = "SELECT * FROM movie";
$r = mysqli_query($link, $q);
if (mysqli_num_rows($r) > 0) {

  echo '
  <title>Webflix</title>
  <br>
  <h1 class="text-center">What\'s On</h1>
  <div class="container-fluid">
  <hr>
  <div class="row">';
  # Display body section.
  while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
    echo ' 
     <div class="col-md" style="margin-top: 2rem";>
		 <div class="card border-0 " style="width: 15rem; float: none; margin: 0 auto;">
			  <div class="card text-center border-0">
        <a href="movie.php?id=' . $row['id'] . '"><img class="card-img-top" src=' . $row['img'] . ' alt="Movie"></a>
				  <h5 class="card-title">' . $row['movie_title'] . '</h5>
			   </div>
		  </div>
      </div>';
  }
}

# Or display message.
else {
  echo '<p>There are currently no movies showing.</p>';
}

# Retrieve movies from 'coming_soon' database table.
$q = "SELECT * FROM coming_soon";
$r = mysqli_query($link, $q);
if (mysqli_num_rows($r) > 0) {

  echo '
  <br>
  <br>
  <div class="container">
  <h1 class="text-center">Coming soon</h1>
  <hr>
  <div class="row">';
  # Display body section.
  while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
    echo ' 
     <div class="col-md" style="margin-top: 2rem";>
		 <div class="card border-0 " style="width: 15rem; float: none; margin: 0 auto;">
			  <div class="card text-center border-0">
        <a href="movie_coming_soon.php?id=' . $row['id'] . '"><img class="card-img-top" src=' . $row['img'] . ' alt="Movie"></a>
				  <h5 class="card-title">' . $row['movie_title'] . '</h5>
			   </div>
      </div>
      </div>
      ';
  }

  # Close database connection.
  mysqli_close($link);
}

# Or display message.
else {
  echo '<p>There are currently no movies coming to the cinema.</p>';
}

include('includes/bootstrap.html');