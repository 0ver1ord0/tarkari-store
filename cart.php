<?php
session_start();
include('header.php');
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Section</title>
    <!-- Ensure products.css is loaded after styles.css -->
    <link rel="stylesheet" href="css/cart.css?v=1.0">
</head>

<main>
    <section id="cart-summary">
        <h3>Your Cart</h3>
        <ul>
            <?php 
            $totalPrice = 0;
            if (!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $productId => $product) {
                    $subtotal = $product['price'] * $product['quantity'];
                    $totalPrice += $subtotal;
                    echo "<li>{$product['name']} - {$product['quantity']} kg - Rs {$subtotal}</li>";
                }
            } else {
                echo "<p>Your cart is empty.</p>";
            }
            ?>
        </ul>
        <p><strong>Total Price: Rs<?php echo number_format($totalPrice, 2); ?></strong></p>

        <form action="clear_cart.php" method="POST">
            <button type="submit" name="clear_cart">Clear Cart</button>
        </form>
    </section>
</main>

<?php include('footer.php'); ?>
