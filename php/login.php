<?php
session_start();

// Database connection
$servername = "sql301.infinityfree.com";
$username = "if0_38272767"; // Default username for XAMPP/MAMP
$password = "ftpproject123"; // Default password for XAMPP/MAMP
$dbname = "if0_38272767_grammargenius";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    // Fetch user from database
    $sql = "SELECT * FROM users WHERE username='$user'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($pass, $row['password'])) { // Assuming password is hashed
            $_SESSION['username'] = $user;
            header("Location: dashboard.php"); // Redirect to dashboard
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }
}
$conn->close();
?>
