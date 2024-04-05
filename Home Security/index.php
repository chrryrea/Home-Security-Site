<?php
session_start();

// Check if the user is logged in
$loggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Associated Security - Home</title>
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
        <h2>Welcome to Associated Security!</h2>
        <p>Associated Security is your one-stop destination for home security devices. We offer a wide range of products including:</p>
        <ul>
            <li>Smart Door Locks</li>
            <li>Security Camera Systems</li>
            <li>Motion Sensor Lights</li>
            <li>Video Doorbells</li>
            <li>Window Alarms</li>
        </ul>
        <p>Welcome to Associated Security, your premier destination for home security devices. Founded in 2024, our mission is to provide top-quality security solutions to safeguard your home and loved ones. We offer a diverse range of products including smart door locks, security camera systems, motion sensor lights, video doorbells, and window alarms. At Associated Security, we prioritize your safety and peace of mind.</p>        <div class="image-gallery">
            <img src="images/SmartDoorLock.jpg" alt="Smart Door Lock">
            <img src="images/SecurityCameras.jpg" alt="Security Camera System">
            <img src="images/MotionSensorLight.jpg" alt="Motion Sensor Light">
            <img src="images/DoorbellCamera.jpg" alt="Video Doorbell">
            <img src="images/WindowAlarm.jpg" alt="Window Alarm">
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Associated Security</p>
    </footer>
</body>
</html>
<!-- ie48 2/16 ie48@njit.edu IT-202 Phase 1 Assignment: HTML5 and PHP Form -->