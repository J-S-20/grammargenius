<?php
session_start();
session_unset(); // Remove all session variables
session_destroy(); // Destroy the session
header("Location: ../topics/home.php"); // Redirect to homepage or login
exit();
?>
