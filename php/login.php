<?php

session_start();
include("db.php");

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, password,fullname FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $hashed_password,$fullname);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION["user_id"] = $id;
            $_SESSION["username"] = htmlspecialchars($fullname);
            header("Location: ../topics/home.php");
            exit;
        } else {
            $error_message = "Invalid password.Try login again.<a href='../topics/login.html'>Login</a>";
        }
    } else {
        $error_message = "No user found with that username. Sign up instead or Login with a different username<br><a href='../topics/login.html'>Login</a><br><a href='../topics/register.html'>Signup</a>";
    }
    echo "$error_message";
    $stmt->close();
    $conn->close();
}
?>
