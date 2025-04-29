<?php
$servername = "sql301.infinityfree.com";
$username = "if0_38272767";
$password = "ftpproject123"; 
$dbname = "if0_38272767_grammargenius";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$username = $_POST['username'];
$password = $_POST['password'];

// Hash the password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert into database
$sql = "INSERT INTO users (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $hashed_password);

if ($stmt->execute()) {
    echo "<h2 style='text-align:center; color:green;'>Registration successful!</h2>";
} else {
    echo "<h2 style='text-align:center; color:red;'>Error: " . $stmt->error . "</h2>";
}

$stmt->close();
$conn->close();
?>
