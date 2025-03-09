<?php include('header.php'); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="styling.css?v=1.1"> <!-- Link to your CSS file -->
</head>

<main>
    <div class="container contact-page">
        <h2>Contact Us</h2>
        <p>If you have any questions or feedback, feel free to reach out to us using the form below:</p>

        <form action="submit_contact_form.php" method="POST">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="5" required></textarea>

            <button type="submit">Submit</button>
        </form>

        <p>Alternatively, you can reach us by email at <a href="mailto:[email@example.com]">[email@example.com]</a></p>
    </div>
</main>

<?php include('footer.php'); ?>
