<?php
session_start();

// Validate and process user registration data
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm-password"];

    // Validate input (you can add more validation as needed)
    if (empty($username) || empty($email) || empty($password) || empty($confirmPassword) || $password !== $confirmPassword) {
        $_SESSION["registration_error"] = "Please fill in all fields and ensure passwords match.";
        header("Location: register.html");
        exit;
    }

    // Store user data (for demonstration, we're using a simple file approach)
    $userData = [
        "username" => $username,
        "email" => $email,
        "password" => password_hash($password, PASSWORD_DEFAULT), // Hash the password
    ];

    $usersFile = "users.json"; // Change this to the path where you want to store user data
    $users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

    // Check if the username or email already exists
    foreach ($users as $user) {
        if ($user["username"] === $username || $user["email"] === $email) {
            $_SESSION["registration_error"] = "Username or email already exists.";
            header("Location: register.html");
            exit;
        }
    }

    // Add the new user data
    $users[] = $userData;

    // Save updated user data
    file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));

    // Redirect to a success page or login page
    $_SESSION["registration_success"] = "Registration successful! You can now log in.";
    header("Location: login.html");
    exit;
}
?>
