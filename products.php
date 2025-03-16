<?php
// Start session to access cart data
session_start();

// Include database connection
include('db.php'); 

// Include the header
include('header.php');
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vegetables Shop</title>
    <!-- Ensure products.css is loaded after styles.css -->
    <link rel="stylesheet" href="css/prodcuts.css?v=1.0">
</head>

<main class="product-page"> <!-- Added class for product-specific styles -->
    <section id="products">
        <?php
        // Fetch products from the database
        $stmt = $pdo->query("SELECT * FROM vegetables");
        while ($product = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="product">
                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                <h2><?php echo $product['name']; ?></h2>
                <p>Price: Rs<?php echo number_format($product['price'], 2); ?></p>
                <form action="add_cart.php" method="POST">
                    <label for="quantity-<?php echo $product['vegetable_id']; ?>">Enter Quantity (in kg):</label>
                    <input type="number" name="quantity" id="quantity-<?php echo $product['vegetable_id']; ?>" placeholder="e.g., 5" min="1" required>
                    <input type="hidden" name="product_id" value="<?php echo $product['vegetable_id']; ?>">
                    <button type="submit" name="add_to_cart">Add to Cart</button>
                </form>
            </div>
        <?php
        }
        ?>
    </section>
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
    </section>
</main>

<?php
// Include the footer
include('footer.php');
?>
