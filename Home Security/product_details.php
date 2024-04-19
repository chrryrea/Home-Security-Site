<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Associated Security - Product Details</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        img {
            width: 300px;
            height: 300px;
            transition: filter 0.3s ease;
        }
        img:hover {
            filter: grayscale(100%);
        }
    </style>
</head>
<body>
    <?php
    session_start();

    // Check if the product ID is provided
    if (!isset($_GET['product_id'])) {
        die('No product ID provided');
    }

    $product_id = $_GET['product_id'];

    $dsn = 'mysql:host=sql1.njit.edu;port=3306;dbname=ie48';
    $username = 'ie48';
    $password = 'cZ_263161_Cz';

    try {
        $db = new PDO($dsn, $username, $password);
        // Set the PDO error mode to exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQL query to get product info
        $sql = "SELECT * FROM HomeSecurityItems WHERE ItemCode = :product_id";
        $stmt = $db->prepare($sql);
        $stmt->execute(['product_id' => $product_id]);

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Display the product details
            echo "<h3>" . $row["ItemName"] . "</h3>";
            echo "<p><strong>Description:</strong> " . $row["Description"] . "</p>";
            echo "<p><strong>Price:</strong> $" . $row["Price"] . "</p>";

            // Display the product image (Option 1)
            echo "<img id='productImage' src='products/" . $product_id . ".jpg' alt='" . $row["ItemName"] . "'>";
        } else {
            echo "No product found with the provided ID.";
        }
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    $db = null; 
    ?>
    <footer>
        <p>© 2024 Associated Security</p>
    </footer>
</body>
</html>
<!-- ie48 4/19 ie48@njit.edu IT-202 Phase 5 Assignment: Read SQL Data with PHP and JavaScript  -->