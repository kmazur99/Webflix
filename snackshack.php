<?php

session_start();

include('navbar.php');

# Open database connection.
require('connect_db.php');

# Retrieve movies from 'snacks' database table.
$q = "SELECT * FROM snacks";
$r = mysqli_query($link, $q);
if (mysqli_num_rows($r) > 0) {

    echo'

    <br>
    <div class="container">
    <h1 class="text-center">Menu</h1>
    <hr>
    <div class="row">
    <div class="col-md-6">
    <div class="card card-dark">
    <h5 class="card-header text-center">Snacks</h5>
    <div class="card-body">
    <div class="table-responsive">
    <table class="table table-striped">
    <thread>
    <tr>
    <th><h5 class"card-title">Item</h5></th>
    <th><h5 class"card-title">Price</h5></th>
    </tr>
    </thread>
    ';
  
    # Display body section.
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
      echo ' 
      <tbody>
          <tr>
          <td><h6>' .$row['name'].'</h6></td>
          <td><h6>&pound;' .$row['price'].'</h6></td>
          </tr>
      </tbody>
      ';
    }
  
    echo'
    </table>
    </div>
    </div>
    </div>
    </div>
    <div class="col-md-6">
    <div class="card card-dark">
    <h5 class="card-header text-center">Drinks</h5>
    <div class="card-body">
    <div class="table-responsive">
    <table class="table table-striped">
    <thread>
    <tr>
    <th><h5 class"card-title">Item</h5></th>
    <th><h5 class"card-title">Price</h5></th>
    </tr>
    </thread>
    ';
  
    $q = "SELECT * FROM drinks";
    $r = mysqli_query($link, $q);
    if (mysqli_num_rows($r) > 0) {

       # Display body section.
       while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        echo ' 
        <tbody>
            <tr>
            <td><h6>' .$row['name'].'</h6></td>
            <td><h6>&pound;' .$row['price'].'</h6></td>
            </tr>
        </tbody>
        ';
      }

    echo'
    </table>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
  
  ';
  }
}

  # Close database connection.
  mysqli_close($link);

include('includes/bootstrap.html');
