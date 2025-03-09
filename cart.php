<?php
session_start();
include('header.php');
?>

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
                    echo "<li>{$product['name']} - {$product['quantity']} kg - $ {$subtotal}</li>";
                }
            } else {
                echo "<p>Your cart is empty.</p>";
            }
            ?>
        </ul>
        <p><strong>Total Price: $<?php echo number_format($totalPrice, 2); ?></strong></p>

        <form action="clear_cart.php" method="POST">
            <button type="submit" name="clear_cart">Clear Cart</button>
        </form>
    </section>
</main>

<?php include('footer.php'); ?>
