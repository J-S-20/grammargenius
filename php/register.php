<?php
error_reporting(error_level: E_ALL);
ini_set(option: "display_errors", value: 1);
include ("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim(string: $_POST["username"]);
    $password = $_POST["password"];
    $email=$_POST["email"];
    $fullname=$_POST["fullName"];;


    // Step 3: Check if user already exists
    $stmt = $conn->prepare(query: "SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows === 1) {
        die("Username already taken. Try something else.<a href='../topics/register.html'>Register again</a>");
    }

    // Step 4: Hash the password
    $hashed_password =password_hash(password: $password, algo:PASSWORD_DEFAULT);

    // Step 5: Insert new user
    $stmt = $conn->prepare(query: "INSERT INTO users (username, password,fullname,email) VALUES (?, ?,?,?)");
    $stmt->bind_param( "ssss", $username,  $hashed_password,$fullname,$email);

    if ($stmt->execute()) {
        header(header: "Location: ../topics/login.html");
        //echo "'Registration successful'. <a href='../topics/login.html'>Log in now</a>.";
    } else {
        echo "Something went wrong. Try again later.<a href='../topics/register.html'>Register again</a>";
    }

    $stmt->close();
    $conn->close();
}
?>
