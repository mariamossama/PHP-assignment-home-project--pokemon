<?php
session_start(); // Start the session
require_once("storage.php"); 
require_once("card.php");

$storage = new Storage("data/users.json", "data/cards.json");
$cards = $storage->getAllCards();

// Add filter logic here if necessary
$selectedType = $_GET['type'] ?? 'all';
if ($selectedType != 'all') {
    $cards = array_filter($cards, function($card) use ($selectedType) {
        return $card['type'] == $selectedType;
    });
}
?>
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
            <?php if (isset($_SESSION["username"])): ?>
                <li><a href="user_details.php"><?php echo htmlspecialchars($_SESSION["username"]); ?></a> (Money: <?php echo htmlspecialchars($_SESSION["money"]); ?>)</li>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.html">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <div class="container">
        <!-- Filter Form -->
        <form action="index.php" method="get">
            <select name="type">
                <option value="all">All Types</option>
                <option value="fire">Fire</option>
                <option value="poison">Poison</option>
                <option value="normal">Normal</option>
                <option value="bug">Bug</option>
                <option value="grass">Grass</option>
                <option value="electric">Electric</option>
                
                <!-- Other types -->
            </select>
            <button type="submit">Filter</button>
        </form>

        <section class="card-list">
            <?php foreach ($cards as $cardId => $cardData): ?>
                <div class="card">
                    <img src="<?php echo htmlspecialchars($cardData['image']); ?>" alt="<?php echo htmlspecialchars($cardData['name']); ?>">
                    <h3><a href="card_details.php?cardId=<?php echo $cardId; ?>"><?php echo htmlspecialchars($cardData['name']); ?></a></h3>
                    <p>Type: <?php echo htmlspecialchars($cardData['type']); ?></p>
                    <p>Description: <?php echo htmlspecialchars($cardData['description']); ?></p>
                    <p>Price: <?php echo htmlspecialchars($cardData['price']); ?></p>
                    <?php if (isset($_SESSION["username"])): ?>
                        <button>Buy</button>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </section>
    </div>
    <footer>
        <p>© 2024 Pokémon Card Trading Platform</p>
    </footer>
</body>
</html>
