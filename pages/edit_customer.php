<?php
// Check if user is logged in
include('../includes/session_check.php');

// Include database connection
include('../db.php');

// Include header
include('../includes/header.php');

// Initialize variables
$message = "";
$messageType = ""; // "success" or "error"
$customer = null;

// Check if customer ID is provided in URL
if (isset($_GET['id'])) {
    $customer_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Get customer data from database
    $query = "SELECT * FROM customers WHERE id = '$customer_id'";
    $result = mysqli_query($conn, $query);

    // Check if customer exists
    if (mysqli_num_rows($result) > 0) {
        $customer = mysqli_fetch_assoc($result);
    } else {
        $message = "Customer not found!";
        $messageType = "error";
    }
} else {
    $message = "No customer ID provided!";
    $messageType = "error";
}

// Handle form submission (UPDATE)
if (isset($_POST['submit']) && $customer) {
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
        // All validations passed, update database
        $update_query = "UPDATE customers SET
                        name = '$name',
                        email = '$email',
                        phone = '$phone'
                        WHERE id = '$customer_id'";

        if (mysqli_query($conn, $update_query)) {
            $message = "Customer updated successfully!";
            $messageType = "success";
            // Update the customer variable so form shows new data
            $customer['name'] = $name;
            $customer['email'] = $email;
            $customer['phone'] = $phone;
            // Redirect after 2 seconds
            echo "<script>
                setTimeout(function() {
                    window.location.href = 'view_customers.php';
                }, 2000);
            </script>";
        } else {
            $message = "Error updating customer: " . mysqli_error($conn);
            $messageType = "error";
        }
    }
}
?>

<div class="container">
    <h2>Edit Lead</h2>

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

    <!-- Edit form (only show if customer exists) -->
    <?php if ($customer): ?>
        <form method="POST" action="" onsubmit="return validateCustomerForm()">
            <label for="name">Lead Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $customer['name']; ?>" placeholder="Enter lead name (min 2 characters)">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $customer['email']; ?>" placeholder="Enter lead email">

            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" value="<?php echo $customer['phone']; ?>" placeholder="Enter lead phone (optional)">

            <!-- Display created date (read-only) -->
            <label for="created_at">Date Added:</label>
            <input type="text" id="created_at" name="created_at" value="<?php echo $customer['created_at']; ?>" disabled>

            <!-- Submit button -->
            <input type="submit" name="submit" value="Update Lead">
        </form>

        <!-- Link to go back -->
        <a href="view_customers.php" style="display: block; margin-top: 20px; text-align: center;">Back to Leads List</a>

        <!-- Info message -->
        <p style="margin-top: 20px; font-size: 12px; color: #7f8c8d;">
            <strong>Note:</strong> Name and Email are required. Phone is optional.
        </p>
    <?php endif; ?>
</div>

<?php
// Include footer
include('../includes/footer.php');
?>
