<?php
session_start();
include_once 'db_config.php';

// Database connection
$dsn = 'mysql:host=sql1.njit.edu;port=3306;dbname=ie48';
$username = 'ie48';
$password = 'cZ_263161_Cz';

try {
    $db = new PDO($dsn, $username, $password);
    // Set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = 'SELECT * FROM AssociatedSecurityManagers WHERE emailAddress = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    
    // Fetch the manager record
    $manager = $statement->fetch(PDO::FETCH_ASSOC);

    // Verify the password
        
        if ($manager && password_verify($password, $manager['password'])) {
        $_SESSION['loggedin'] = true;
        $_SESSION['firstName'] = $manager['firstName'];
        $_SESSION['lastName'] = $manager['lastName'];
        $_SESSION['email'] = $manager['emailAddress'];

        header('Location: index.php');
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}

// Check if the user is logged in
$loggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Associated Security - Login</title>
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
        <h2>Login</h2>
        <?php if (isset($error)): ?>
            <p><?= $error ?></p>
        <?php endif; ?>
        <form action="login.php" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Login">
        </form>
    </main>
    <footer>
        <p>© 2024 Associated Security</p>
    </footer>
</body>
</html>
<!-- ie48 4/5 ie48@njit.edu IT-202 Phase 4 Assignment: PHP Authentication and Delete SQL Data -->
