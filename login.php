<?php
session_start();

if (isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit;
}

$loginError = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $usersFile = "data/users.json"; 
    $users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];
    $userFound = false;

    foreach ($users as $user) {
        if ($user["username"] === $username) {
            $userFound = true;
            if (password_verify($password, $user["password"])) {

                $_SESSION["user_id"] = uniqid(); 
                $_SESSION["username"] = $username;
                $_SESSION["money"] = 1000;
            
                header("Location: index.php"); 
                exit;
            }
            break;
        }
    }

    if (!$userFound || !password_verify($password, $user["password"])) {
 
        $loginError = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pokémon Card Trading</title>
</head>
<body>
    <header>
        <h1>Login to Your Account</h1>
    </header>
    <div class="container">
        <?php if (!empty($loginError)): ?>
            <p style="color: red;"><?php echo $loginError; ?></p>
        <?php endif; ?>

        <form action="login.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</body>
</html>
