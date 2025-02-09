<?php
$servername = "localhost";
$username = "root"; // Default username for XAMPP/MAMP
$password = ""; // Default password for XAMPP/MAMP
$dbname = "grammar_genius";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
