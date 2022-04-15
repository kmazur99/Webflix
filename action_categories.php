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

if(isset($_POST['new_category'])){

    $new_category = mysqli_real_escape_string($link,$_POST[ 'new_category' ]);
    $query = "INSERT INTO categories (category_name) VALUES ('$new_category')";
    mysqli_query($link, $query);

    header('location: admin_panel.php');
}

echo json_encode($input);

?>
