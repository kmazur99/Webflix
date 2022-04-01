<?php

# Open database connection.
require('connect_db.php');

$to = $_POST[ 'email' ];

$message = "
<html>
<head>
</head>
<body>
<h1>Password Reset</h1>
<p>If you forgot your password, use the link below to reset it</p>
<p>If you did not request a password reset, please ignore this email</p>
<a href='http://webdev.edinburghcollege.ac.uk/~HNCSOFTSA7/Webflix/reset_password.php'> <button type='button' role='button'><h1>Reset your password</h1></button></a>
<br>
</body>
</html>
";

  $subject = "Reset password";
  $headers = "From: Webflix <password-reset@webflix.com>\r\n";
  $headers .= "Reply-To: password-reset@webflix.com\r\n";
  $headers .= "Content-type: text/html\r\n";
  mail($to, $subject, $message, $headers);

  $Success = urlencode("Email sent");
  header("Location:forgot_password.php?Success=".$Success);
  die;
