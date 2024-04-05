<?php
session_start();

// Check if the user is logged in
$loggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Associated Security - Product Page</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
<header>
        <div class="banner">
            <h1>Associated Security</h1>
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
        <h2>Product Page</h2>
        <?php
        $dsn = 'mysql:host=sql1.njit.edu;port=3306;dbname=ie48';
        $username = 'ie48';
        $password = 'cZ_263161_Cz';

        try {
            $db = new PDO($dsn, $username, $password);
            // Set the PDO error mode to exception
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // SQL query to get product info
            $sql = "SELECT HomeSecurityCategories.CategoryName, HomeSecurityItems.ItemCode, HomeSecurityItems.ItemName, HomeSecurityItems.Description, HomeSecurityItems.Price
                    FROM HomeSecurityItems
                    INNER JOIN HomeSecurityCategories ON HomeSecurityItems.CategoryID = HomeSecurityCategories.CategoryID";
            $stmt = $db->query($sql);

            if ($stmt->rowCount() > 0) {
                // Output data of each row
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<div class='product'>";
                    echo "<h3>" . $row["CategoryName"] . "</h3>";
                    echo "<p><strong>Product Name:</strong> " . $row["ItemName"] . "</p>";
                    echo "<p><strong>Description:</strong> " . $row["Description"] . "</p>";
                    echo "<p><strong>Price:</strong> $" . $row["Price"] . "</p>";
                    echo "<form action='delete.php' method='post'>";
                    echo "<input type='hidden' name='item_code' value='" . $row["ItemCode"] . "'>";
                    echo "<input type='submit' value='Delete'>";
                    echo "</form>";
                    echo "</div>";
                }
            } else {
                echo "0 results";
            }
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        // Close connection
        $db = null; 
        ?>
    </main>
    <footer>
        <p>© 2024 Associated Security</p>
    </footer>
</body>
</html>
<!-- ie48 2/29 ie48@njit.edu IT-202 Phase 2 Assignment: Read SQL Data using PHP -->
