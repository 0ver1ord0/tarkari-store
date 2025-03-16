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
    ['Cabbage', 60, 'cabbage.jpg'],
    ['Pumpkin', 60, 'Pumpkin.jpg'],
    ['Raddish', 60, 'Radish.jpg'],
    ['Beans', 60, 'Beans.jpg'],
    ['Taaro leaves', 60, 'TaaroLeaves.jpg']
];

// Insert each vegetable into the database
foreach ($vegetables as $vegetable) {
    $name = $vegetable[0];
    $price = $vegetable[1];
    $image = 'picture/' . $vegetable[2];  // Correct path to the image

    // Check if the vegetable already exists in the database
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM vegetables WHERE name = :name");
    $stmt->execute(['name' => $name]);
    $exists = $stmt->fetchColumn();

    if ($exists == 0) {
        // Prepare and execute the insert query if the vegetable doesn't exist
        $stmt = $pdo->prepare("INSERT INTO vegetables (name, price, image) VALUES (:name, :price, :image)");
        $stmt->execute(['name' => $name, 'price' => $price, 'image' => $image]);
        echo "{$name} inserted successfully!<br>";
    } else {
        // If vegetable already exists, skip insertion
        echo "{$name} already exists in the database!<br>";
    }
}
?>
