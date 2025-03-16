<?php
session_start();
include('db.php');  // Include database connection
include('header.php');  // Include your header file
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Section</title>
    <!-- Ensure products.css is loaded after styles.css -->
    <link rel="stylesheet" href="css/home.css?v=1.0">
</head>

<main>
    <section id="products">
        <h2>Available Products</h2>
        <div class="products-list">
            <?php
            // Fetch products from the database
            $stmt = $pdo->query("SELECT * FROM vegetables");
            while ($product = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="product-item">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product-image">
                    <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                    <p>Price: Rs<?php echo number_format($product['price'], 2); ?></p>

                    <!-- Form to add product to the cart -->
                    <form action="add_cart.php" method="POST">
                        <label for="quantity-<?php echo $product['vegetable_id']; ?>">Enter Quantity (kg):</label>
                        <input type="number" name="quantity" id="quantity-<?php echo $product['vegetable_id']; ?>" min="1" required placeholder="e.g., 5">

                        <input type="hidden" name="product_id" value="<?php echo $product['vegetable_id']; ?>">

                        <button type="submit" name="add_to_cart">Add to Cart</button>
                    </form>
                </div>
            <?php
            }
            ?>
        </div>
    </section>
</main>

<?php include('footer.php');  // Include your footer file ?>
