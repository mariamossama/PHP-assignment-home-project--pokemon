<?php
session_start();


$userName = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
$cards = isset($_SESSION['user_cards']) ? $_SESSION['user_cards'] : []; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <header>
        <h1>User Profile</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="logout.php">Logout</a></li> 
        </ul>
    </nav>
    <div class="container">
        <h2>Username: <?php echo htmlspecialchars($userName); ?></h2>
        <h3>My Pokémon Cards:</h3>
        <?php foreach ($cards as $card): ?>
            <div class="card">
                <h4><?php echo htmlspecialchars($card['name']); ?></h4>
                <p>Type: <?php echo htmlspecialchars($card['type']); ?></p>
                <button>Sell Back to Admin</button>
            </div>
        <?php endforeach; ?>
    </div>
    <footer>
        <p>© 2024 Pokémon Card Trading Platform</p>
    </footer>
</body>
</html>
