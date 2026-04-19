<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lead Tracking AI</title>
    <!-- linking CSS file -->
    <link rel="stylesheet" href="/web_project/css/style.css">
</head>
<body>
    <!-- Header section -->
    <header>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div style="text-align: left;">
                <h1 style="margin: 0; font-size: 32px; font-weight: bold; color: white; letter-spacing: 1px;">Lead Tracking AI</h1>
                <p style="margin: 5px 0 0 0; font-size: 14px; color: rgba(255, 255, 255, 0.9); font-weight: 500; letter-spacing: 0.5px;">✨ Intelligent Lead Management System</p>
            </div>
            <?php
            // Start session if not started
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Show user info if logged in
            if (isset($_SESSION['admin_username'])): ?>
                <div style="text-align: right; color: white;">
                    <p>Welcome, <strong><?php echo $_SESSION['admin_username']; ?></strong></p>
                    <a href="/web_project/logout.php" style="color: #fff; text-decoration: none; background-color: rgba(255,255,255,0.2); padding: 5px 10px; border-radius: 4px;">Logout</a>
                </div>
            <?php endif; ?>
        </div>
    </header>
    <nav>
        <ul>
            <li><a href="/web_project/index.php">Home</a></li>
            <li><a href="/web_project/pages/add_customer.php">Add Lead</a></li>
            <li><a href="/web_project/pages/view_customers.php">View Leads</a></li>
        </ul>
    </nav>
