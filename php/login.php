<?php
// Database config
$servername = "localhost";
$db_username = "root";      // Change this if needed
$db_password = "";          // Set your MySQL password
$dbname = "user_db";

// Create DB connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input
$username = $_POST['username'];
$password = $_POST['password'];

// Fetch user from DB
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verify hashed password
    if (password_verify($password, $user['password'])) {
        echo "<h2 style='text-align:center; color:green;'>Login successful! Welcome, " . htmlspecialchars($username) . ".</h2>";
    } else {
        echo "<h2 style='text-align:center; color:red;'>Incorrect password.</h2>";
    }
} else {
    echo "<h2 style='text-align:center; color:red;'>User not found.</h2>";
}

$stmt->close();
$conn->close();
?>
