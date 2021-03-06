<?php  

# Open database connection.
require('connect_db.php');

# Get show details
$input = filter_input_array(INPUT_POST);

$show_title = mysqli_real_escape_string($link, $input["show_title"]);
$further_info = mysqli_real_escape_string($link, $input["further_info"]);
$img = mysqli_real_escape_string($link, $input["img"]);
$preview = mysqli_real_escape_string($link, $input["preview"]);
$show_link = mysqli_real_escape_string($link, $input["link"]);
$category= mysqli_real_escape_string($link, $input["category"]);
$release_date = mysqli_real_escape_string($link, $input["release_date"]);
$languages= mysqli_real_escape_string($link, $input["languages"]);
$seasons= mysqli_real_escape_string($link, $input["seasons"]);
$episodes = mysqli_real_escape_string($link, $input["episodes"]);

# Edit show details.
if($input["action"] === 'edit')
{
 $query = "
 UPDATE tv_show
 SET show_title = '".$show_title."', 
 further_info = '".$further_info."' , 
 img = '".$img."' , 
 preview = '".$preview."' , 
 link = '".$show_link."' , 
 category = '".$category."' , 
 release_date = '".$release_date."' , 
 seasons = '".$seasons."' , 
 episodes = '".$episodes."' , 
 languages = '".$languages."' 
 WHERE id = '".$input["id"]."'
 ";

 mysqli_query($link, $query);

}
# Delete show.
if($input["action"] === 'delete')
{
 $query = "
 DELETE FROM tv_show
 WHERE id = '".$input["id"]."'
 ";
 mysqli_query($link, $query);
}

# Add new show.
if(isset($_POST['new_show_title'])){

    $new_title = mysqli_real_escape_string($link,$_POST[ 'new_show_title' ]);
    $new_description = mysqli_real_escape_string($link,$_POST[ 'show_description' ]);
    $new_img = mysqli_real_escape_string($link,$_POST[ 'show_img' ]);
    $new_category = mysqli_real_escape_string($link,$_POST[ 'show_category' ]);
    $new_released = mysqli_real_escape_string($link,$_POST[ 'show_released' ]);
    $new_languages = mysqli_real_escape_string($link,$_POST[ 'show_languages' ]);
    $new_seasons = mysqli_real_escape_string($link,$_POST[ 'new_seasons' ]);
    $new_episodes = mysqli_real_escape_string($link,$_POST[ 'new_episodes' ]);
    $new_show_url = mysqli_real_escape_string($link,$_POST[ 'show_url' ]);
    $new_trailer_url = mysqli_real_escape_string($link,$_POST[ 'show_trailer' ]);
    
    $query = "INSERT INTO tv_show (show_title, further_info, release_date, img, preview, category, languages, seasons, episodes, link) VALUES ('$new_title', '$new_description', '$new_released', '$new_img', '$new_trailer_url', '$new_category', '$new_languages', '$new_seasons', '$new_episodes', '$new_show_url')";
    mysqli_query($link, $query);

    header('location: admin_panel.php');
}

echo json_encode($input);

?>
