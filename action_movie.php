<?php  

# Open database connection.
require('connect_db.php');

# Get movie data
$input = filter_input_array(INPUT_POST);

$movie_title = mysqli_real_escape_string($link, $input["movie_title"]);
$further_info = mysqli_real_escape_string($link, $input["further_info"]);
$img = mysqli_real_escape_string($link, $input["img"]);
$preview = mysqli_real_escape_string($link, $input["preview"]);
$movie_link = mysqli_real_escape_string($link, $input["link"]);
$category= mysqli_real_escape_string($link, $input["category"]);
$release_date = mysqli_real_escape_string($link, $input["release_date"]);
$languages= mysqli_real_escape_string($link, $input["languages"]);
$duration = mysqli_real_escape_string($link, $input["duration"]);

# Edit movie details.
if($input["action"] === 'edit')
{
 $query = "
 UPDATE movie
 SET movie_title = '".$movie_title."', 
 further_info = '".$further_info."' , 
 img = '".$img."' , 
 preview = '".$preview."' , 
 link = '".$movie_link."' , 
 category = '".$category."' , 
 release_date = '".$release_date."' , 
 duration = '".$duration."' , 
 languages = '".$languages."' 
 WHERE id = '".$input["id"]."'
 ";

 mysqli_query($link, $query);

}
# Delete movie.
if($input["action"] === 'delete')
{
 $query = "
 DELETE FROM movie
 WHERE id = '".$input["id"]."'
 ";
 mysqli_query($link, $query);
}

# Add new movie.
if(isset($_POST['new_movie_title'])){

    $new_title = mysqli_real_escape_string($link,$_POST[ 'new_movie_title' ]);
    $new_description = mysqli_real_escape_string($link, $_POST[ 'description' ]);
    $new_img = mysqli_real_escape_string($link,$_POST[ 'img' ]);
    $new_category = mysqli_real_escape_string($link,$_POST[ 'category' ]);
    $new_released = mysqli_real_escape_string($link,$_POST[ 'released' ]);
    $new_languages = mysqli_real_escape_string($link,$_POST[ 'languages' ]);
    $new_duration = mysqli_real_escape_string($link,$_POST[ 'duration' ]);
    $new_movie_url = mysqli_real_escape_string($link,$_POST[ 'movie_url' ]);
    $new_trailer_url = mysqli_real_escape_string($link,$_POST[ 'trailer_url' ]);
    
    $query = "INSERT INTO movie (movie_title, further_info, img, preview, link, category, release_date, languages, duration) VALUES ('$new_title', '$new_description', '$new_img', '$new_trailer_url', '$new_movie_url', '$new_category', '$new_released', '$new_languages', '$new_duration')";
    mysqli_query($link, $query);

    header('location: admin_panel.php');
}

echo json_encode($input);
?>
