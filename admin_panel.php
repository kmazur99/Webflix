<?php
# Access session.
session_start();

# Load bootstrap + CSS
include('includes/bootstrap.html');
# Redirect if not logged in.
require('redirect.php');
# Open database connection.
require('connect_db.php');
# display navbar
include('navbar.php');

# Access the data from the database.
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://kmazur99.github.io/table_editor.js"></script>


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
                    <table id="user_table" class="table table-striped table-hover" style="table-layout: fixed">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Date of Birth</th>
                                <th>Email</th>
                                <th>Contact Number</th>
                                <th>Country</th>
                                <th>Joined</th>
                                <th>Account Type</th>
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
                </div>
            </div>
        </div>

        <div class="card card-dark mb-3">
            <div class="card-header">
                <h5 class="card-title">Categories</h5>
            </div>
            <div class="card-body">
                <div class="categories-table">
                    <table id="categories_table" class="table table-striped table-hover">
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
                    <button type="button" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#new_category">Add</button>
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
       <td class="description">' . $row["further_info"] . '</td>
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
                    <button type="button" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#new_movie">Add</button>
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
                    <button type="button" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#new_show">Add</button>
                </div>
            </div>
        </div>

    </div>

</body>

</html>
<script>
    // Pass the data to the appropriate action
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
            restoreButton: false,
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
            restoreButton: false,
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
            restoreButton: false,
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
            restoreButton: false,
            onSuccess: function(data, textStatus, jqXHR) {
                if (data.action == 'delete') {
                    $('#' + data.id).remove();
                }
            }
        });

    });
</script>

<!-- New category popup -->
<div class="modal fade" id="new_category" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add New Category</h5>
            </div>

            <div class="modal-body">
                <form action="action_categories.php" method="post">
                    <div class="form-group">
                        <input type="text" pattern="[a-zA-Z\s]+" title="This field should not contain numbers" name="new_category" class="form-control" placeholder="Enter category name" value="<?php if (isset($_POST['new_category'])) echo $_POST['new_category']; ?>" required>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input class="btn btn-secondary" type="submit" value="Save Changes">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- New movie popup -->
<div class="modal fade" id="new_movie" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add New Movie</h5>
            </div>

            <div class="modal-body">
                <form action="action_movie.php" method="post">
                    <div class="form-group">
                        <label>Movie title</label>
                        <input type="text" name="new_movie_title" class="form-control" value="<?php if (isset($_POST['new_movie_title'])) echo $_POST['new_movie_title']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="description" class="form-control" value="<?php if (isset($_POST['description'])) echo $_POST['description']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Cover image (URL)</label>
                        <input type="text" name="img" class="form-control" value="<?php if (isset($_POST['img'])) echo $_POST['img']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Category (Category ID)</label>
                        <input type="text" name="category" class="form-control" value="<?php if (isset($_POST['category'])) echo $_POST['category']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Release Date</label>
                        <input type="date" name="released" class="form-control" value="<?php if (isset($_POST['released'])) echo $_POST['released']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Language(s)</label>
                        <input type="text" name="languages" class="form-control" value="<?php if (isset($_POST['lanugages'])) echo $_POST['languages']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Duration (minutes)</label>
                        <input type="number" name="duration" class="form-control" value="<?php if (isset($_POST['duration'])) echo $_POST['duration']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Movie (URL)</label>
                        <input type="text" name="movie_url" class="form-control" value="<?php if (isset($_POST['movie_url'])) echo $_POST['movie_url']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Trailer (URL)</label>
                        <input type="text" name="trailer_url" class="form-control" value="<?php if (isset($_POST['trailer_url'])) echo $_POST['trailer_url']; ?>" required>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input class="btn btn-secondary" type="submit" value="Save Changes">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- New tv show popup -->
<div class="modal fade" id="new_show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add New TV Show</h5>
            </div>

            <div class="modal-body">
                <form action="action_show.php" method="post">
                    <div class="form-group">
                        <label>Show title</label>
                        <input type="text" name="new_show_title" class="form-control" value="<?php if (isset($_POST['new_show_title'])) echo $_POST['new_show_title']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="show_description" class="form-control" value="<?php if (isset($_POST['show_description'])) echo $_POST['show_description']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Cover image (URL)</label>
                        <input type="text" name="show_img" class="form-control" value="<?php if (isset($_POST['show_img'])) echo $_POST['show_img']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Category (Category ID)</label>
                        <input type="text" name="show_category" class="form-control" value="<?php if (isset($_POST['show_category'])) echo $_POST['show_category']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Release Date</label>
                        <input type="date" name="show_released" class="form-control" value="<?php if (isset($_POST['show_released'])) echo $_POST['show_released']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Language(s)</label>
                        <input type="text" name="show_languages" class="form-control" value="<?php if (isset($_POST['show_lanugages'])) echo $_POST['show_languages']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>No. of Seasons</label>
                        <input type="number" name="new_seasons" class="form-control" value="<?php if (isset($_POST['new_seasons'])) echo $_POST['new_seasons']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>No. of Episodes</label>
                        <input type="number" name="new_episodes" class="form-control" value="<?php if (isset($_POST['new_episodes'])) echo $_POST['new_episodes']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>TV Show (URL)</label>
                        <input type="text" name="show_url" class="form-control" value="<?php if (isset($_POST['show_url'])) echo $_POST['show_url']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Trailer (URL)</label>
                        <input type="text" name="show_trailer" class="form-control" value="<?php if (isset($_POST['show_trailer'])) echo $_POST['show_trailer']; ?>" required>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input class="btn btn-secondary" type="submit" value="Save Changes">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>