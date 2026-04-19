<?php
// Include database connection
include('db.php');

// Initialize message
$message = "";
$messageType = "";

// Check if already logged in
session_start();
if (isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit;
}

// Handle login form submission
if (isset($_POST['login'])) {
    // Get form data
    $username = trim(mysqli_real_escape_string($conn, $_POST['username']));
    $password = trim(mysqli_real_escape_string($conn, $_POST['password']));

    // Validate inputs
    if (empty($username) || empty($password)) {
        $message = "Username and Password are required!";
        $messageType = "error";
    } else {
        // Check user in database
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            // Check password (simple comparison - in real apps use password_hash)
            if ($password === $user['password']) {
                // Login successful
                session_start();
                $_SESSION['admin_id'] = $user['id'];
                $_SESSION['admin_username'] = $user['username'];
                $message = "Login successful! Redirecting...";
                $messageType = "success";

                // Redirect after 1 second
                echo "<script>
                    setTimeout(function() {
                        window.location.href = 'index.php';
                    }, 1000);
                </script>";
            } else {
                $message = "Invalid password!";
                $messageType = "error";
            }
        } else {
            $message = "Username not found!";
            $messageType = "error";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CRM System</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
        }

        .login-container {
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        .login-container h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
            border-bottom: 0;
            padding-bottom: 0;
        }

        .login-container form {
            display: flex;
            flex-direction: column;
        }

        .login-container label {
            margin-top: 15px;
            font-weight: bold;
            color: #34495e;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            margin-top: 5px;
            padding: 12px;
            border: 1px solid #bdc3c7;
            border-radius: 4px;
            font-size: 14px;
        }

        .login-container input[type="submit"] {
            margin-top: 25px;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: transform 0.2s;
        }

        .login-container input[type="submit"]:hover {
            transform: translateY(-2px);
        }

        .message {
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 20px;
            text-align: center;
        }

        .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .demo-credentials {
            background-color: #e3f2fd;
            border: 1px solid #90caf9;
            border-radius: 4px;
            padding: 12px;
            margin-top: 20px;
            font-size: 12px;
            color: #1565c0;
        }

        .demo-credentials strong {
            display: block;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>🔐 CRM Login</h2>

        <!-- Show messages -->
        <?php if (!empty($message)): ?>
            <div class="message <?php echo $messageType; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <!-- Login Form -->
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Enter username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter password" required>

            <input type="submit" name="login" value="Login">
        </form>

        <!-- Demo Credentials -->
        <div class="demo-credentials">
            <strong>Demo Credentials:</strong>
            Username: <strong>admin</strong><br>
            Password: <strong>12345</strong>
        </div>
    </div>
</body>
</html>
