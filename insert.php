<?php
// Include database connection
include('db.php');  // Assuming db.php contains your database connection logic

// Array of vegetables to insert into the database
$vegetables = [
    ['Tomato', 50, 'Tomato.jpg'],
    ['Cauliflower', 40, 'Cauliflower.jpg'],
    ['Potato', 60, 'Potato.jpg'],
    ['Onion', 60, 'Onion.jpg'],
    ['Ginger', 60, 'Ginger.jpg'],
    ['Mushroom', 60, 'Mushroom.jpg'],
    ['Capscium', 60, 'Capscium.jpg'],
    ['Peas', 60, 'Peas.jpg'],
    ['Garlic', 60, 'Garlic.jpg'],
    ['Cabbage', 60, 'cabbage.jpg']
];

// Insert each vegetable into the database
foreach ($vegetables as $vegetable) {
    $name = $vegetable[0];
    $price = $vegetable[1];
    $image = $vegetable[2];
    
    // Prepare and execute the insert query
    $stmt = $pdo->prepare("INSERT INTO vegetables (name, price, image) VALUES (:name, :price, :image)");
    $stmt->execute(['name' => $name, 'price' => $price, 'image' => $image]);
}

echo "Vegetables inserted successfully!";
?>
