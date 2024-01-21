<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); 

 
    if (empty($username) || empty($email) || empty($password)) {
        echo "Please fill in all fields.";
    } else {
        
        $user = [
            "username" => $username,
            "email" => $email,
            "password" => $password,
        ];

       
        $usersData = json_decode(file_get_contents("users.json"), true);
        $usersData[] = $user;
        file_put_contents("data/users.json", json_encode($usersData));

        echo "Registration successful. <a href='login.html'>Login</a>";
    }
}
?>
