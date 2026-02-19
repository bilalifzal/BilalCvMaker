<?php
// Start the session to access session data
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session cookie if it exists
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}

// Destroy the session completely
session_destroy();

// Redirect the user back to the login page
header("Location: login.php");
exit();
?>