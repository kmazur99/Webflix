<?php

# Open database connection.
require('connect_db.php');

# Get email, name and surname passed from the form.
$to = $_POST[ 'email' ];
$name = $_POST[ 'fn' ];
$surname = $_POST[ 'ln' ];

# Email message.
$message = "
<html>
<head>
</head>
<body>
<h1>Hello $name $surname</h1>
<p>Welcome to Webflix</p>
<p>To activate your account, please click the button below</p>
<a href='http://webdev.edinburghcollege.ac.uk/~HNCSOFTSA7/Webflix/activate?email=$to'> <button type='button' role='button'><h1>Activate account</h1></button></a>
<br>
</body>
</html>
";

# send email
$q = "SELECT * FROM users WHERE email='$to'";
$r = mysqli_query($link, $q);
if (mysqli_num_rows($r) > 0) {
  $subject = "Welcome to Webflix: Activate Your Account";
  $headers = "From: Webflix <account-activation@webflix.com>\r\n";
  $headers .= "Reply-To: activation@webflix.com\r\n";
  $headers .= "Content-type: text/html\r\n";
  mail($to, $subject, $message, $headers);

  $Success = urlencode("Email sent");
  header("Location:activate.php?Success=".$Success);
  die;
}
else{
  $Message = urlencode("No account found with that email address.");
  header("Location:activate.php?Message=".$Message);
  die;
}
  
