<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (empty($username) || empty($password)) {
        echo "Please fill in all fields.";
    } else {
       
        $usersData = json_decode(file_get_contents("users.json"), true);

        
        $user = array_filter($usersData, function($userData) use ($username) {
            return $userData["username"] === $username;
        });

        if (!empty($user)) {
            $user = array_shift($user);
            
            if (password_verify($password, $user["password"])) {
                
                $_SESSION["user"] = $user;
                header("Location: user_details.php"); 
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
