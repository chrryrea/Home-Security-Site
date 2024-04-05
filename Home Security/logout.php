<?php

session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to login page
header('Location: login.php');
exit;
?>
<!-- ie48 4/5 ie48@njit.edu IT-202 Phase 4 Assignment: PHP Authentication and Delete SQL Data -->
