<?php
// Check if user is logged in
include('../includes/session_check.php');

// Include database connection
include('../db.php');

// Include header
include('../includes/header.php');

// Initialize message variable
$message = "";
$messageType = ""; // "success" or "error"

// Check if form was submitted
if (isset($_POST['submit'])) {
    // Get form data and trim whitespace
    $name = trim(mysqli_real_escape_string($conn, $_POST['name']));
    $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
    $phone = trim(mysqli_real_escape_string($conn, $_POST['phone']));

    // Server-side validation
    $errors = array();

    // Validate Name
    if (empty($name)) {
        $errors[] = "Name is required!";
    } elseif (strlen($name) < 2) {
        $errors[] = "Name must be at least 2 characters long!";
    }

    // Validate Email
    if (empty($email)) {
        $errors[] = "Email is required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address!";
    }

    // Validate Phone (optional but if provided must be valid)
    if (!empty($phone)) {
        if (!preg_match("/^[0-9\-\+\(\)\s]+$/", $phone)) {
            $errors[] = "Phone number should contain only numbers and common symbols!";
        }
    }

    // If there are errors, show them
    if (count($errors) > 0) {
        $message = implode("<br>", $errors);
        $messageType = "error";
    } else {
        // All validations passed, insert into database
        $query = "INSERT INTO customers (name, email, phone)
                  VALUES ('$name', '$email', '$phone')";

        // Execute query
        if (mysqli_query($conn, $query)) {
            $message = "Customer added successfully!";
            $messageType = "success";
            // Redirect to view customers page after 2 seconds
            echo "<script>
                setTimeout(function() {
                    window.location.href = 'view_customers.php';
                }, 2000);
            </script>";
        } else {
            // Show error message if insertion failed
            $message = "Error: " . mysqli_error($conn);
            $messageType = "error";
        }
    }
}
?>

<div class="container">
    <h2>Add New Customer</h2>

    <!-- Error/Success messages -->
    <div id="error-message"></div>

    <!-- Show message if there is one -->
    <?php if (!empty($message)): ?>
        <div style="background-color: <?php echo ($messageType == 'success') ? '#d4edda' : '#f8d7da'; ?>;
                    color: <?php echo ($messageType == 'success') ? '#155724' : '#721c24'; ?>;
                    padding: 12px; border-radius: 4px; margin-bottom: 15px;
                    border: 1px solid <?php echo ($messageType == 'success') ? '#c3e6cb' : '#f5c6cb'; ?>;">
            <strong><?php echo ($messageType == 'success') ? 'Success!' : 'Error!'; ?></strong><br>
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <!-- Customer form -->
    <form method="POST" action="" onsubmit="return validateCustomerForm()">
        <label for="name">Customer Name:</label>
        <input type="text" id="name" name="name" placeholder="Enter customer name (min 2 characters)">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter customer email (e.g., john@example.com)">

        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" placeholder="Enter customer phone (optional)">

        <!-- Submit button -->
        <input type="submit" name="submit" value="Add Customer">
    </form>

    <!-- Info message -->
    <p style="margin-top: 20px; font-size: 12px; color: #7f8c8d;">
        <strong>Note:</strong> Name and Email are required. Phone is optional.
    </p>
</div>

<?php
// Include footer
include('../includes/footer.php');
?>
