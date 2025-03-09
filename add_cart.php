<?php
session_start();
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Validate input
    if (!empty($productId) && !empty($quantity) && ctype_digit($quantity) && $quantity > 0) {
        $stmt = $pdo->prepare("SELECT name, price FROM vegetables WHERE vegetable_id = :id");
        $stmt->execute(['id' => $productId]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            $productName = $product['name'];
            $productPrice = $product['price'];

            // Initialize cart if not set
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            // Add product to cart
            if (isset($_SESSION['cart'][$productId])) {
                $_SESSION['cart'][$productId]['quantity'] += $quantity;
            } else {
                $_SESSION['cart'][$productId] = [
                    'name' => $productName,
                    'price' => $productPrice,
                    'quantity' => $quantity
                ];
            }

            echo "✅ Product added to cart!";
        } else {
            echo "❌ Product not found in the database.";
        }
    } else {
        echo "❌ Invalid input. Make sure quantity is a positive number.";
    }
}
?>
<a href="cart.php">View Cart</a>
