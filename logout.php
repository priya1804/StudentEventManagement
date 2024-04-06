<?php
// Start the session
session_start();

// Unset all of the session variables
$_SESSION = array();

session_destroy();

// Delete cookies
setcookie("remember_me", "", time() - 3600, "/"); // Delete cookie
setcookie("email", "", time() - 3600, "/"); // Delete cookie
setcookie("user_id", "", time() - 3600, "/"); // Delete cookie

header("location: index.php");
?>