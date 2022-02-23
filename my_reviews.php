<?php
include('navbar.php');
# Access session.
session_start();

# Open database connection.
require('connect_db.php');

# Retrieve items from 'mov_rev' database table.
$q = "SELECT * FROM mov_rev WHERE id={$_SESSION['user_id']}
ORDER BY post_date DESC" ;

$r = mysqli_query( $link, $q ) ;
if ( mysqli_num_rows( $r ) > 0 )
{
    echo '
    <br>
    <div class="container">';
    while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
      {
    echo '<div class="alert alert-dark" role="alert">
                <h4 class="alert-heading">' . $row['movie_title'] . '  </h4>
    <p>Rating:  ' . $row['rate'] . ' &#9734</p>
    <p>' . $row['message'] . '</p>
    <hr>
    <footer class="blockquote-footer">
  <span>' . $row['first_name'] . ' ' . $row['last_name'] . '</span> 
  <cite title="Source Title"> ' . $row['post_date'] . '</cite></footer>
    <br>
    <a href="delete_post.php?post_id='.$row['post_id'].'"><button type="button" class="btn btn-secondary" role="button">Delete Post</a><br>
    </div>
                
    ';  
      }
    }
    else { echo '<div class="container">
    <br>
    <div class="alert alert-secondary" role="alert">
    <p>You have no movie reviews</p>
    </div>
    <div> ' ; }

    include('includes/bootstrap.html');
