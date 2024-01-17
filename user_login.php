<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input from the login form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validation (you can add more validation as needed)
    if (empty($username) || empty($password)) {
        echo "Please fill in all fields.";
    } else {
        // Load user data from a database or file (example: users.json)
        $usersData = json_decode(file_get_contents("users.json"), true);

        // Find the user with the given username
        $user = array_filter($usersData, function($userData) use ($username) {
            return $userData["username"] === $username;
        });

        if (!empty($user)) {
            $user = array_shift($user);
            // Verify the password
            if (password_verify($password, $user["password"])) {
                // Login successful, store user data in session
                $_SESSION["user"] = $user;
                header("Location: user_details.php"); // Redirect to user profile page
                exit();
            } else {
                echo "Incorrect password.";
            }
        } else {
            echo "User not found.";
        }
    }
}
?>
