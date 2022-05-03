<?php

# Access session.
session_start();

# Load bootstrap + CSS
include('includes/bootstrap.html');
# Check account status
require('checkStatus.php');
# Check if user is signed in
include('redirect.php');
# Display navbar
include('navbar.php');
# Open database connection.
require('connect_db.php');

# Retrieve categories from the database
$categories_query = "SELECT * FROM categories ORDER BY category_id ASC";
$categories_result = mysqli_query($link, $categories_query);

# Display category dropdowns
echo'
<title>Movies - Webflix</title>
  <br>
  <div class="container-fluid">
<select id="genre" name="genre" onchange="changeGenre(this.value)" style="float: right;">
<option value=""disabled selected>Category</option>
<option value="all">All</option>';

# Add categories to the dropdown menu
while ($row = mysqli_fetch_array($categories_result)) {
echo'
  <option value="'.$row['category_id'].'">'. $row['category_name'] . '</option>';
}
echo' </select>';

if (isset($_GET['genre'])) {
  $genre_id = $_GET['genre'];
}

# Display all movies
if ($genre_id == 'all') {
  $q = "SELECT * FROM movie";
}
else{
# Display certain category
$q = "SELECT * FROM movie WHERE category = $genre_id";
}

$r = mysqli_query($link, $q);
if (mysqli_num_rows($r) > 0) {

  echo '
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

  # Close database connection.
  mysqli_close($link);
}
include('footer.html');
?>
<!-- Display correct category -->
<script>
function changeGenre(genre) {
  window.location.href = "movies.php?genre=" + genre;
}
</script>