<?php
session_start();


function userExists($username, $email, $users) {
    foreach ($users as $user) {
        if ($user['username'] === $username || $user['email'] === $email) {
            return true;
        }
    }
    return false;
}

$registrationError = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm-password"];

    if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
        $registrationError = 'Please fill in all fields.';
    } elseif ($password !== $confirmPassword) {
        $registrationError = 'Passwords do not match.';
    } else {
        $usersFile = "data/users.json";
        $users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

        if (userExists($username, $email, $users)) {
            $registrationError = 'Username or email already exists.';
        } else {
            // Registration logic
            $userData = [
                "username" => $username,
                "email" => $email,
                "password" => password_hash($password, PASSWORD_DEFAULT) // Hash the password
            ];

            $users[] = $userData;
            file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));

            // Redirect to login page after successful registration
            $_SESSION["registration_success"] = "Registration successful! You can now log in.";
            header("Location: login.html");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Pokémon Card Trading</title>
    <!-- Add any additional CSS here -->
</head>
<body>
    <header>
        <h1>Create a New Account</h1>
    </header>
    <div class="container">
        <?php if (!empty($registrationError)): ?>
            <p style="color: red;"><?php echo $registrationError; ?></p>
        <?php endif; ?>

        <form action="register.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
            </div>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.html">Login here</a></p>
    </div>
</body>
</html>
