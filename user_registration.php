<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input from the registration form
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password for security

    // Validation (you can add more validation as needed)
    if (empty($username) || empty($email) || empty($password)) {
        echo "Please fill in all fields.";
    } else {
        // Save user data to a database or file (example: users.json)
        $user = [
            "username" => $username,
            "email" => $email,
            "password" => $password,
        ];

        // Store the user data in a database or file
        $usersData = json_decode(file_get_contents("users.json"), true);
        $usersData[] = $user;
        file_put_contents("users.json", json_encode($usersData));

        echo "Registration successful. <a href='login.html'>Login</a>";
    }
}
?>
