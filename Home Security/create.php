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
    <title>Associated Security - Create</title>
    <link rel="stylesheet" href="styles.css">
    <script>
    function validateForm() {
        var code = document.forms["createProductForm"]["code"].value;
        var name = document.forms["createProductForm"]["name"].value;
        var description = document.forms["createProductForm"]["description"].value;
        var price = document.forms["createProductForm"]["price"].value;

        if (code == "" || code.length < 4 || code.length > 10) {
            alert("Code must be between 4 and 10 characters long.");
            return false;
        }

        if (name == "" || name.length < 10 || name.length > 100) {
            alert("Name must be between 10 and 100 characters long.");
            return false;
        }

        if (description == "" || description.length < 10 || description.length > 255) {
            alert("Description must be between 10 and 255 characters long.");
            return false;
        }

        if (price == "" || price <= 0 || price > 100000) {
            alert("Price must be greater than 0 and not exceed $100,000.");
            return false;
        }
    }
    </script>
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
        <h2>Create a New Product</h2>
        <?php
$dsn = 'mysql:host=sql1.njit.edu;port=3306;dbname=ie48';
$username = 'ie48';
$password = 'cZ_263161_Cz';

try {
    $db = new PDO($dsn, $username, $password);
    // Set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch categories for the dropdown
    $sql = "SELECT CategoryID, CategoryName FROM HomeSecurityCategories";
    $stmt = $db->query($sql);
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Form submission handling
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $errors = [];

        // Check for duplicate product code
        $sql = "SELECT * FROM HomeSecurityItems WHERE ItemCode = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$_POST['code']]);
        if ($stmt->rowCount() > 0) {
            $errors[] = "The product code already exists.";
        }

        // Check price value
        if ($_POST['price'] <= 0 || $_POST['price'] > 9999.99) {
            $errors[] = "The price must be a positive number and not exceed 9999.99.";
        }

        if (empty($errors)) {
            // Insert data into the database
            $sql = "INSERT INTO HomeSecurityItems (CategoryID, ItemCode, ItemName, Description, Price, DateCreated) VALUES (?, ?, ?, ?, ?, NOW())";
            $stmt = $db->prepare($sql);
            $stmt->execute([$_POST['category'], $_POST['code'], $_POST['name'], $_POST['description'], $_POST['price']]);
        } else {
            foreach ($errors as $error) {
                echo "<p>$error</p>";
            }
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
<form method="POST" id="createProductForm" onsubmit="return validateForm()">
            <label for="category">Category:</label>
            <select id="category" name="category">
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['CategoryID'] ?>"><?= $category['CategoryName'] ?></option>
                <?php endforeach; ?>
            </select>

            <label for="code">Code:</label>
            <input type="text" id="code" name="code">

            <label for="name">Name:</label>
            <input type="text" id="name" name="name">

            <label for="description">Description:</label>
            <textarea id="description" name="description"></textarea>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" min="0" max="100000" step="0.01">

            <input type="reset" value="Reset">
            <input type="submit" value="Submit">
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Associated Security</p>
    </footer>
</body>
</html>
<!-- ie48 3/22 ie48@njit.edu IT-202 Phase 3 Assignment: Create SQL Data using PHP  -->