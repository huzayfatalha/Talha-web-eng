<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['admin_id'])) {
    // Redirect to login page
    header("Location: ../login.php");
    exit;
}
?>
