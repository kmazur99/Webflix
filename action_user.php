<?php  

# Open database connection.
require('connect_db.php');

# Get user data.
$input = filter_input_array(INPUT_POST);

$first_name = mysqli_real_escape_string($link, $input["first_name"]);
$last_name = mysqli_real_escape_string($link, $input["last_name"]);
$dob = mysqli_real_escape_string($link, $input["DOB"]);
$email = mysqli_real_escape_string($link, $input["email"]);
$contact_number = mysqli_real_escape_string($link, $input["contact_number"]);
$country = mysqli_real_escape_string($link, $input["country"]);
$reg_date = mysqli_real_escape_string($link, $input["reg_date"]);
$subscription = mysqli_real_escape_string($link, $input["subscription"]);

# Edit user details.
if($input["action"] === 'edit')
{
 $query = "
 UPDATE users 
 SET first_name = '".$first_name."', 
 last_name = '".$last_name."' , 
 DOB = '".$dob."' , 
 email = '".$email."' , 
 contact_number = '".$contact_number."' , 
 country = '".$country."' , 
 reg_date = '".$reg_date."' , 
 subscription = '".$subscription."' 
 WHERE user_id = '".$input["user_id"]."'
 ";

 mysqli_query($link, $query);

}
# Delete user.
if($input["action"] === 'delete')
{
 $query = "
 DELETE FROM users
 WHERE user_id = '".$input["user_id"]."'
 ";
 mysqli_query($link, $query);
}

echo json_encode($input);

?>
