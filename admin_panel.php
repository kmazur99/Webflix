<?php # DISPLAY COMPLETE REGISTRATION PAGE.
include('navbar.php');
# Access session.
session_start();

# Redirect if not logged in.
if (!isset($_SESSION['user_id'])) {
    require('login_tools.php');
    load();
}

# Open database connection.
require('connect_db.php');

include('includes/bootstrap.html');

// Access the data from the database.
$user_query = "SELECT * FROM users ORDER BY user_id ASC";
$user_result = mysqli_query($link, $user_query);

$movie_query = "SELECT * FROM movie ORDER BY id ASC";
$movie_result = mysqli_query($link, $movie_query);

$show_query = "SELECT * FROM tv_show ORDER BY id ASC";
$show_result = mysqli_query($link, $show_query);

$categories_query = "SELECT * FROM categories ORDER BY category_id ASC";
$categories_result = mysqli_query($link, $categories_query);
?>
<html>

<head>
    <title>Admin Panel - Webflix</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="jquery.tabledit.min.js"></script>

</head>

<body>
    <br />

    <div class="container">
        <div class="card card-dark mb-3">
            <div class="card-header">
                <h5 class="card-title">Users</h5>
            </div>
            <div class="card-body">
                <div class="user-table">
                    <table id="user_table" class="table table-striped table-hover">
                        <thead class="thead">
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Date of Birth</th>
                                <th>Email</th>
                                <th>Contact Number</th>
                                <th>Country</th>
                                <th>Joined</th>
                                <th>Subscription</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($user_result)) {
                                echo '
      <tr>
       <td>' . $row["user_id"] . '</td>
       <td>' . $row["first_name"] . '</td>
       <td>' . $row["last_name"] . '</td>
       <td>' . $row["DOB"] . '</td>
       <td>' . $row["email"] . '</td>
       <td>' . $row["contact_number"] . '</td>
       <td>' . $row["country"] . '</td>
       <td>' . $row["reg_date"] . '</td>
       <td>' . $row["subscription"] . '</td>
      </tr>
      ';
                            }
                            ?>
                        </tbody>
                    </table>
                    <button id="addRow">Add Row</button>
                </div>

            </div>
        </div>

        <div class="card card-dark mb-3">
            <div class="card-header">
                <h5 class="card-title">Categories</h5>
            </div>
            <div class="card-body">
                <div class="categories-table">
                    <table id="categories_table" class="table table-striped table-hover" style="table-layout: fixed;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($categories_result)) {
                                echo '
      <tr>
       <td>' . $row["category_id"] . '</td>
       <td>' . $row["category_name"] . '</td>
      </tr>
      ';
                            }


                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card card-dark mb-3">
            <div class="card-header">
                <h5 class="card-title">Movies</h5>
            </div>
            <div class="card-body">
                <div class="movie-table">
                    <table id="movie_table" class="table table-striped table-hover" style="table-layout: fixed;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Cover Image</th>
                                <th>Category</th>
                                <th>Release Date</th>
                                <th>Languages</th>
                                <th>Duration</th>
                                <th>Movie Link</th>
                                <th>Trailer Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($movie_result)) {
                                echo '
      <tr>
       <td>' . $row["id"] . '</td>
       <td>' . $row["movie_title"] . '</td>
       <td>' . $row["further_info"] . '</td>
       <td>' . $row["img"] . '</td>
       <td>' . $row["category"] . '</td>
       <td>' . $row["release_date"] . '</td>
       <td>' . $row["languages"] . '</td>
       <td>' . $row["duration"] . '</td>
       <td>' . $row["link"] . '</td>
       <td>' . $row["preview"] . '</td>
      </tr>
      ';
                            }


                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card card-dark mb-3">
            <div class="card-header">
                <h5 class="card-title">TV Shows</h5>
            </div>
            <div class="card-body">
                <div class="show-table">
                    <table id="show_table" class="table table-striped table-hover" style="table-layout: fixed;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Cover Image</th>
                                <th>Category</th>
                                <th>Release Date</th>
                                <th>Languages</th>
                                <th>No. of Seasons</th>
                                <th>No. of Episodes</th>
                                <th>Show Link</th>
                                <th>Trailer Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($show_result)) {
                                echo '
      <tr>
       <td>' . $row["id"] . '</td>
       <td>' . $row["show_title"] . '</td>
       <td>' . $row["further_info"] . '</td>
       <td>' . $row["img"] . '</td>
       <td>' . $row["category"] . '</td>
       <td>' . $row["release_date"] . '</td>
       <td>' . $row["languages"] . '</td>
       <td>' . $row["seasons"] . '</td>
       <td>' . $row["episodes"] . '</td>
       <td>' . $row["link"] . '</td>
       <td>' . $row["preview"] . '</td>
      </tr>
      ';
                            }


                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</body>

</html>
<script>

$("#addRow").click(function() { 
	var tableditTableName = '#user_table';  // Identifier of table
	var newID = parseInt($(tableditTableName + " tr:last").attr("id")) + 1; 
	var clone = $("#user_table tr:last").clone(); 
	$(".tabledit-span", clone).text(""); 
	$(".tabledit-input", clone).val(""); 
	clone.prependTo("table"); 
	$(tableditTableName + " tbody tr:first").attr("id", newID); 
	$(tableditTableName + " tbody tr:first td .tabledit-span.tabledit-identifier").text(newID); 
	$(tableditTableName + " tbody tr:first td .tabledit-input.tabledit-identifier").val(newID); 
	$(tableditTableName + " tbody tr:first td:last .tabledit-edit-button").trigger("click"); 
});

    $(document).ready(function() {
        $('#user_table').Tabledit({
            url: 'action_user.php',
            columns: {
                identifier: [0, "user_id"],
                editable: [
                    [1, 'first_name'],
                    [2, 'last_name'],
                    [3, 'DOB'],
                    [4, 'email'],
                    [5, 'contact_number'],
                    [6, 'country'],
                    [7, 'reg_date'],
                    [8, 'subscription']
                ]
            },
            restoreButton: true,
            onSuccess: function(data, textStatus, jqXHR) {
                if (data.action == 'delete') {
                    $('#' + data.id).remove();
                }
            }
        });
    });

    $(document).ready(function() {
        $('#movie_table').Tabledit({
            url: 'action_movie.php',
            columns: {
                identifier: [0, "id"],
                editable: [
                    [1, 'movie_title'],
                    [2, 'further_info'],
                    [3, 'img'],
                    [4, 'category'],
                    [5, 'release_date'],
                    [6, 'languages'],
                    [7, 'duration'],
                    [8, 'link'],
                    [9, 'preview']
                ]
            },
            restoreButton: true,
            onSuccess: function(data, textStatus, jqXHR) {
                if (data.action == 'delete') {
                    $('#' + data.id).remove();
                }
            }
        });
    });

    $(document).ready(function() {
        $('#show_table').Tabledit({
            url: 'action_show.php',
            columns: {
                identifier: [0, "id"],
                editable: [
                    [1, 'show_title'],
                    [2, 'further_info'],
                    [3, 'img'],
                    [4, 'category'],
                    [5, 'release_date'],
                    [6, 'languages'],
                    [7, 'seasons'],
                    [8, 'episodes'],
                    [9, 'link'],
                    [10, 'preview']
                ]
            },
            restoreButton: true,
            onSuccess: function(data, textStatus, jqXHR) {
                if (data.action == 'delete') {
                    $('#' + data.id).remove();
                }
            }
        });
    });

    $(document).ready(function() {
        $('#categories_table').Tabledit({
            url: 'action_categories.php',
            columns: {
                identifier: [0, "category_id"],
                editable: [
                    [1, 'category_name']
                ]
            },
            restoreButton: true,
            onSuccess: function(data, textStatus, jqXHR) {
                if (data.action == 'delete') {
                    $('#' + data.id).remove();
                }
            }
        });

    });

    
</script>