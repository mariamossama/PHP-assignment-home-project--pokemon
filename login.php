<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION["user_id"])) {
    header("Location: user_details.php");
    exit;
}

// Validate and process user login
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Load user data (from the same file or database used for registration)
    $usersFile = "users.json"; // Update with the actual path to your user data file
    $users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

    foreach ($users as $user) {
        if ($user["username"] === $username && password_verify($password, $user["password"])) {
            // Login successful
            $_SESSION["user_id"] = uniqid(); // Assign a unique user identifier
            $_SESSION["username"] = $username;
            header("Location: user_details.php");
            exit;
        }
    }

    // Login failed
    $_SESSION["login_error"] = "Invalid username or password.";
    header("Location: login.html");
    exit;
}
?>
