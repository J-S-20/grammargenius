<?php
$servername = "sql301.infinityfree.com";
$username = "if0_38272767"; // Default username for XAMPP/MAMP
$password = "ftpproject123"; // Default password for XAMPP/MAMP
$dbname = "if0_38272767_grammargenius";

// Create connection
$conn =new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
