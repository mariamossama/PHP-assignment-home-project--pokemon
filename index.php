<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Card Trading</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f4;
        }
        header {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 1rem 0;
        }
        nav ul {
            padding: 0;
            list-style: none;
            background: #555;
            text-align: center;
        }
        nav ul li {
            display: inline;
            margin-right: 20px;
        }
        nav ul li a {
            text-decoration: none;
            color: white;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        .card {
            background: #fff;
            border: 1px solid #ddd;
            margin-bottom: 10px;
            padding: 10px;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.3);
        }
        .card img {
            max-width: 100%;
            height: auto;
        }
        footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 1rem 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Pokémon Card Trading Platform</h1>
    </header>
    <nav>
        <ul>
            <li><a href="login.html">Login</a></li>
            <li><a href="register.html">Register</a></li>
            <li><a href="user_details.html">My Profile</a></li>
        </ul>
    </nav>
    <div class="container">
        <section class="card-list">
            <?php
            // Include necessary classes and functions
            require_once("storage.php"); // Include your Storage class
            require_once("card.php");   // Include your Card class

            // Initialize the storage
            $storage = new Storage("data/users.json", "data/cards.json"); // Update with your file paths

            // Retrieve all cards
            $cards = $storage->getAllCards();

            // Loop through the cards and generate HTML
            foreach ($cards as $cardData) {
            ?>
<div class="card">
    <?php foreach ($cards as $cardId => $cardData): ?>
        <img src="<?php echo $cardData['image']; ?>" alt="<?php echo $cardData['name']; ?>">
        <h3><?php echo $cardData['name']; ?></h3>
        <h3><a href="card_details.php?cardId=<?php echo $cardId; ?>"><?php echo $cardData['name']; ?></a></h3>
        <p>Type: <?php echo $cardData['type']; ?></p>
        <p>Description: <?php echo $cardData['description']; ?></p>
        <p>Price: <?php echo $cardData['price']; ?></p>
    <?php endforeach; ?>
</div>


            <?php
            }
            ?>
        </section>
    </div>
    <footer>
        <p>© 2024 Pokémon Card Trading Platform</p>
    </footer>
</body>
</html>
