<?php  

# Open database connection.
require('connect_db.php');

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
if($input["action"] === 'delete')
{
 $query = "
 DELETE FROM tv_show
 WHERE id = '".$input["id"]."'
 ";
 mysqli_query($link, $query);
}

echo json_encode($input);

?>
