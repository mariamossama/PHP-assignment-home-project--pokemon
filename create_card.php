<?php
require_once 'Storage.php';

$errorMessage = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'] ?? '';
    $hp = $_POST['hp'] ?? '';
    $type = $_POST['type'] ?? '';
    $attack = $_POST['attack'] ?? '';
    $defense = $_POST['defense'] ?? '';
    $price = $_POST['price'] ?? '';
    $description = $_POST['description'] ?? '';
    $image = $_POST['image'] ?? '';

    // Basic validation
    if (empty($name) || empty($hp) || empty($type) || empty($attack) || empty($defense) || empty($price) || empty($image)) {
        $errorMessage = 'All fields are required.';
    } else {
        // Validation successful
        $storage = new Storage('data/users.json', 'data/cards.json');
        $newCard = [
            'name' => $name,
            'hp' => $hp,
            'type' => $type,
            'attack' => $attack,
            'defense' => $defense,
            'price' => $price,
            'description' => $description,
            'image' => $image
        ];
        $storage->addCard($newCard);
        $successMessage = 'New card created successfully.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create New Card</title>
    <style>
        /* Add your styles here */
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Create a New Pokémon Card</h1>

    <?php if (!empty($errorMessage)): ?>
        <div class="error"><?php echo $errorMessage; ?></div>
    <?php endif; ?>

    <?php if (!empty($successMessage)): ?>
        <div class="success"><?php echo $successMessage; ?></div>
    <?php endif; ?>

    <form action="create_card.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="hp">HP:</label>
        <input type="number" id="hp" name="hp" required><br>

        <label for="type">type:</label>
        <input type="text" id="type" name="type" required><br>

        <label for="attack">Attack:</label>
        <input type="number" id="attack" name="attack" required><br>

        <label for="defense">Defense:</label>
        <input type="number" id="defense" name="defense" required><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea><br>

        <label for="image">Image URL:</label>
        <input type="text" id="image" name="image" required><br>

        <button type="submit">Create Card</button>
    </form>
</body>
</html>
