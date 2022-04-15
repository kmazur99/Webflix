<?php  

# Open database connection.
require('connect_db.php');

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
if($input["action"] === 'delete')
{
 $query = "
 DELETE FROM movie
 WHERE id = '".$input["id"]."'
 ";
 mysqli_query($link, $query);
}

echo json_encode($input);

?>
