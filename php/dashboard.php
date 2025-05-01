<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: ../topics/login.html");
    exit;
}
echo "Welcome, " . htmlspecialchars($_SESSION["username"]) . "!";
header("Location: ../topics/home.html");
?>
