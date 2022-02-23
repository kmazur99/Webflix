<?php
# Access session.
session_start();

# Redirect user to login page if not signed into an account
$isLoggedIn = isset($_SESSION['user_id']);
if(!$isLoggedIn){
  header("Location: login.php");
}
?>