<?php
session_start();

// Check if the user is logged in
$loggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Associated Security - Shipping</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <div class="banner">
        <h1>Associated Security</h1>
        <?php if ($loggedIn): ?>
            <p>Welcome, <?= $_SESSION['firstName'] ?> <?= $_SESSION['lastName'] ?> (<?= $_SESSION['email'] ?>)</p>
        <?php endif; ?>
    </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Products</a></li> 
                <?php if ($loggedIn): ?>
                    <li><a href="shipping.php">Shipping</a></li>
                    <li><a href="create.php">Create</a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Shipping Label Generator</h2>
        <form action="process_shipping.php" method="post">
            <label for="first_name">First Name:</label><br>
            <input type="text" id="first_name" name="first_name" required><br>

            <label for="last_name">Last Name:</label><br>
            <input type="text" id="last_name" name="last_name" required><br>

            <label for="street_address">Street Address:</label><br>
            <input type="text" id="street_address" name="street_address" required><br>

            <label for="city">City:</label><br>
            <input type="text" id="city" name="city" required><br>

            <label for="state">State:</label><br>
            <input type="text" id="state" name="state" required><br>

            <label for="zip_code">Zip Code:</label><br>
            <input type="text" id="zip_code" name="zip_code" required><br>

            <label for="ship_date">Ship Date:</label><br>
            <input type="date" id="ship_date" name="ship_date" required><br>

            <label for="order_number">Order Number:</label><br>
            <input type="text" id="order_number" name="order_number" required><br>

            <label for="length">Length (in.):</label><br>
            <input type="number" id="length" name="length" min="1" max="36" required><br>

            <label for="width">Width (in.):</label><br>
            <input type="number" id="width" name="width" min="1" max="36" required><br>

            <label for="height">Height (in.):</label><br>
            <input type="number" id="height" name="height" min="1" max="36" required><br>

            <label for="declared_value">Declared Value ($):</label><br>
            <input type="number" id="declared_value" name="declared_value" min="1" max="1000" required><br>

            <button type="submit">Generate Label</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Associated Security</p>
    </footer> 
</body>
</html> 
<!-- ie48 2/16 ie48@njit.edu IT-202 Phase 1 Assignment: HTML5 and PHP Form -->
