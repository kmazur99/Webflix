<?php

include('navbar.php');

# Access session.
session_start();

if (isset($_GET['movie_title'])) $movie_title = $_GET['movie_title'];

# Open database connection.
require('connect_db.php');

# Retrieve items from 'mov_rev' database table.
$q = "SELECT * FROM mov_rev WHERE movie_title LIKE '%{$_GET['movie_title']}%'";
$r = mysqli_query($link, $q);
if (mysqli_num_rows($r) > 0) {
    echo '
    <br>
    <div class="container">';
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        echo '<div class="alert alert-dark" role="alert">
      <h4 class="alert-heading">' . $row['movie_title'] . '  </h4>
      <p>Rating: <strong> ' . $row['rate'] . ' &#9734</strong></p>
      <p>' . $row['message'] . '</p>
      <hr>
      <footer class="blockquote-footer">
      <span>' . $row['first_name'] . ' ' . $row['last_name'] . '</span>
      <cite title="Source Title"> ' . $row['post_date'] . '</cite>
      </footer>
      </div>
  ';
    }
    echo '<br><button type="button" class="btn btn-secondary" role="button" data-toggle="modal" data-target="#rev">Add Movie Review</button><br>';
} else {
    echo '<div class="container">
  <br>
  <div class="alert alert-secondary" role="alert">
      <p>There are currently no reviews for this movie.</p>
  <br>	<button type="button" class="btn btn-secondary" role="button" data-toggle="modal" data-target="#rev">Add Movie Review</button><br>
  </div>
  <div>  ';
}
?>

<!-- Modal review-->
<div class="modal fade " id="rev" tabindex="-1" role="dialog" aria-labelledby="rev" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rev">Movie Review</h5>
            </div>
            <div class="modal-body">

                <?php # DISPLAY POST MESSAGE FORM.
                # Display form.
                echo '
<form action="post_action.php" method="post" accept-charset="utf-8">
	<div class="form-check form-body">
	<label for="movie_title">Movie Title: </label>
	<input type="text" class="form-control" name="movie_title" value="' . $movie_title . '">
	<label for="rate">Rate Movie: </label>
	<div class="form-check form-box">
	 	<label class="form-check-label">
<input type="checkbox" class="form-check-input" name="rate" value="5">&#9734; &#9734; &#9734; &#9734; &#9734;
		</label>
        </div>
        <div class="form-check form-box">
        <label class="form-check-label">
<input type="checkbox" class="form-check-input" name="rate" value="4">&#9734; &#9734; &#9734; &#9734;
		</label>
        </div>
        <div class="form-check form-box">
        <label class="form-check-label">
<input type="checkbox" class="form-check-input" name="rate" value="3">&#9734; &#9734; &#9734;
		</label>
        </div>
        <div class="form-check form-box">
        <label class="form-check-label">
<input type="checkbox" class="form-check-input" name="rate" value="2">&#9734; &#9734;
		</label>
        </div>
        <div class="form-check form-box">
        <label class="form-check-label">
<input type="checkbox" class="form-check-input" name="rate" value="1">&#9734;
		</label>
	   </div>
       <div class="form-group">
       <label for="comment">Comment:</label>
   <textarea class="form-control" rows="5" id="message" name="message" required></textarea>
   <div class="modal-footer">
   <input class="btn btn-dark" type="submit" value="Post Review">
   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
   </div>
   </form></div>  ';

include('includes/bootstrap.html');
