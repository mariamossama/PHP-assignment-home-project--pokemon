<?php

require_once 'Storage.php';


if (isset($_GET['cardId'])) {
    $cardId = $_GET['cardId'];
    

    $cards = (new Storage('data/users.json', 'data/cards.json'))->getAllCards();
    if (array_key_exists($cardId, $cards)) {
        $card = $cards[$cardId];

        $backgroundColor = '';
        switch (strtolower($card['type'])) {
            case 'fire':
                $backgroundColor = 'red';
                break;
            case 'electric':
                $backgroundColor = 'yellow';
                break;

            default:
                $backgroundColor = 'white'; 
                break;
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Card Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: <?php echo $backgroundColor; ?>; 
        }
    </style>
</head>
<body>
    <header>
        <h1>Pokémon Card Detail</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="user_details.html">My Profile</a></li>
            <li><a href="login.html">Login</a></li>
        </ul>
    </nav>
    <div class="container">
        <h2><?php echo $card['name']; ?></h2>
        <img src="<?php echo $card['image']; ?>" alt="<?php echo $card['name']; ?> Image">
        <p>HP: <?php echo $card['hp']; ?></p>
        <p>Type: <?php echo ucfirst($card['type']); ?></p>
        <p>Description: <?php echo $card['description']; ?></p>
    </div>
    <footer>
        <p>© 2024 Pokémon Card Trading Platform</p>
    </footer>
</body>
</html>
<?php
    } else {
        echo "<p>Card not found</p>";
    }
} else {
    echo "<p>CardId not provided in the URL</p>";
}
?>
