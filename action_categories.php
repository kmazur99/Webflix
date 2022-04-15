<?php  

# Open database connection.
require('connect_db.php');

$input = filter_input_array(INPUT_POST);

$category_name = mysqli_real_escape_string($link, $input["category_name"]);

if($input["action"] === 'edit')
{
 $query = "
 UPDATE categories 
 SET category_name = '".$category_name."'
 WHERE category_id = '".$input["category_id"]."'
 ";

 mysqli_query($link, $query);

}
if($input["action"] === 'delete')
{
 $query = "
 DELETE FROM categories
 WHERE category_id = '".$input["category_id"]."'
 ";
 mysqli_query($link, $query);
}

echo json_encode($input);

?>
