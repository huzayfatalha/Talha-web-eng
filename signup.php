<?php

$message = "";
$messageType = ""; // "success" or "error"


include('db.php');


if (isset($_POST['signup'])) {
    // Get form data and trim whitespace
    $username = trim(mysqli_real_escape_string($conn, $_POST['username']));
    $password = trim(mysqli_real_escape_string($conn, $_POST['password']));
    $confirm_password = trim(mysqli_real_escape_string($conn, $_POST['confirm_password']));

    
    $errors = array();

    
    if (empty($username)) {
        $errors[] = "Username is required!";
    } elseif (strlen($username) < 3) {
        $errors[] = "Username must be at least 3 characters long!";
    } elseif (strlen($username) > 20) {
        $errors[] = "Username must be less than 20 characters!";
    } elseif (!preg_match("/^[a-zA-Z0-9_]+$/", $username)) {
        $errors[] = "Username can only contain letters, numbers, and underscores!";
    }

    
    if (empty($errors) || count($errors) == 1) {
        $check_query = "SELECT * FROM admins WHERE username = '$username'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            $errors[] = "Username already exists! Choose another username.";
        }
    }


    if (empty($password)) {
        $errors[] = "Password is required!";
    } elseif (strlen($password) < 4) {
        $errors[] = "Password must be at least 4 characters long!";
    }


    if (empty($confirm_password)) {
        $errors[] = "Please confirm your password!";
    }

    
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match!";
    }

    
    if (count($errors) > 0) {
        $message = implode("<br>", $errors);
        $messageType = "error";
    } else {
        
        $insert_query = "INSERT INTO admins (username, password) VALUES ('$username', '$password')";

        if (mysqli_query($conn, $insert_query)) {
            $message = "Account created successfully! You can now login.";
            $messageType = "success";
            // Clear form fields
            $_POST['username'] = "";
            $_POST['password'] = "";
            $_POST['confirm_password'] = "";
            // Show redirect message
            echo "<script>
                setTimeout(function() {
                    window.location.href = 'login.php';
                }, 2000);
            </script>";
        } else {
            $message = "Error creating account: " . mysqli_error($conn);
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
    <title>Sign Up - Lead Tracking AI</title>
    <link rel="stylesheet" href="/web_project/css/style.css">
</head>
<body>
    <!-- Header section -->
    <header>
        <h1>Lead Tracking AI</h1>
        <p>Create Your Account</p>
    </header>

    <div class="container" style="max-width: 400px;">
        <h2>Sign Up</h2>

        <!-- Error/Success messages -->
        <?php if (!empty($message)): ?>
            <div style="background-color: <?php echo ($messageType == 'success') ? '#d4edda' : '#f8d7da'; ?>;
                        color: <?php echo ($messageType == 'success') ? '#155724' : '#721c24'; ?>;
                        padding: 12px; border-radius: 4px; margin-bottom: 15px;
                        border: 1px solid <?php echo ($messageType == 'success') ? '#c3e6cb' : '#f5c6cb'; ?>;">
                <strong><?php echo ($messageType == 'success') ? 'Success!' : 'Error!'; ?></strong><br>
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <!-- Sign up form -->
        <form method="POST" action="" onsubmit="return validateSignupForm()">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Enter username (3-20 characters)" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>">
            <p style="font-size: 12px; color: #7f8c8d; margin-top: 5px;">
                (Letters, numbers, underscores only)
            </p>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter password (min 4 characters)">

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Re-enter password">

            <!-- Submit button -->
            <input type="submit" name="signup" value="Create Account">
        </form>

        <!-- Login link -->
        <p style="text-align: center; margin-top: 20px;">
            Already have an account? <a href="login.php" style="color: #3498db; text-decoration: none; font-weight: bold;">Login here</a>
        </p>

        <!-- Info message -->
        <p style="margin-top: 20px; font-size: 12px; color: #7f8c8d; text-align: center;">
            <strong>Note:</strong> Create a new account by entering username and password.
        </p>
    </div>

    <!-- Footer section -->
    <footer>
        <p>&copy; 2026 Lead Tracking AI. All rights reserved.</p>
    </footer>
    <!-- linking JavaScript file -->
    <script src="/web_project/js/script.js"></script>

    <!-- Sign up form validation -->
    <script>
        function validateSignupForm() {
            // Get form fields
            var username = document.getElementById("username").value.trim();
            var password = document.getElementById("password").value.trim();
            var confirm_password = document.getElementById("confirm_password").value.trim();

            // Validate Username
            if (username == "") {
                alert("Username is required!");
                return false;
            }

            if (username.length < 3) {
                alert("Username must be at least 3 characters long!");
                return false;
            }

            if (username.length > 20) {
                alert("Username must be less than 20 characters!");
                return false;
            }

            if (!/^[a-zA-Z0-9_]+$/.test(username)) {
                alert("Username can only contain letters, numbers, and underscores!");
                return false;
            }

            // Validate Password
            if (password == "") {
                alert("Password is required!");
                return false;
            }

            if (password.length < 4) {
                alert("Password must be at least 4 characters long!");
                return false;
            }

            // Validate Confirm Password
            if (confirm_password == "") {
                alert("Please confirm your password!");
                return false;
            }

            // Check if passwords match
            if (password !== confirm_password) {
                alert("Passwords do not match!");
                return false;
            }

            // All validations passed
            return true;
        }
    </script>
</body>
</html>
