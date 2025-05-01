<?php
include ("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    $confirm = $_POST["confirm_password"];

    // Step 1: Check for empty fields
    if (empty($username) || empty($password) || empty($confirm)) {
        die("All fields are required.");
    }

    // Step 2: Confirm password match
    if ($password !== $confirm) {
        die("Passwords do not match.");
    }

    // Step 3: Check if user already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        die("Username already taken. Try something cooler.");
    }

    // Step 4: Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Step 5: Insert new user
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password);

    if ($stmt->execute()) {
        echo "Registration successful. <a href='login.html'>Log in now</a>.";
    } else {
        echo "Something went wrong. Try again later.";
    }

    $stmt->close();
    $conn->close();
}
?>
