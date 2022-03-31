<?php
# Access session.
session_start();

$isLoggedIn = isset($_SESSION['user_id']);

# Open database connection.
require('connect_db.php');

$query = "SELECT * FROM users WHERE user_id={$_SESSION['user_id']}";
$result = mysqli_query($link, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $account_type = $row['account_type'];
    }
  }

# Display navbar only when user is logged in
if ($isLoggedIn) {
 
echo '
<nav class="navbar sticky-top navbar-expand-sm bg-dark ">
        <a class="navbar-brand" href="home.php"><span style="color:#C72606;">Webflix</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="movies.php">Movies</a>
            </li>     
            <li class="nav-item">
              <a class="nav-link" href="tv_shows.php">TV Shows</a>
            </li> 
            </ul>
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               ' . $_SESSION['first_name'] . '
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="user.php">Account settings</a>
                <a class="dropdown-item" href="logout.php">Sign out</a>
              </div>
            </li>
            ';
            # Display admin panel
            if($account_type == 'Admin'){
              echo'
              <li class="nav-item">
              <a class="nav-link" href="admin_panel.php">Admin Panel</a>
            </li>  ';
            }echo '

        </div>
        
      </nav>
';
}
