<?php
// Include database connection
include('../db.php');

// Include header
include('../includes/header.php');

// Initialize variables
$message = "";
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
    }
} else {
    $message = "No customer ID provided!";
}

// Handle form submission (UPDATE)
if (isset($_POST['submit']) && $customer) {
    // Get form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    // Simple validation
    if (empty($name) || empty($email)) {
        $message = "Name and Email are required!";
    } else {
        // Update database
        $update_query = "UPDATE customers SET
                        name = '$name',
                        email = '$email',
                        phone = '$phone'
                        WHERE id = '$customer_id'";

        if (mysqli_query($conn, $update_query)) {
            $message = "Customer updated successfully!";
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
        }
    }
}
?>

<div class="container">
    <h2>Edit Customer</h2>

    <!-- Show message if there is one -->
    <?php if (!empty($message)): ?>
        <p style="background-color: #ecf0f1; padding: 10px; border-radius: 4px; color: #2c3e50;">
            <?php echo $message; ?>
        </p>
    <?php endif; ?>

    <!-- Edit form (only show if customer exists) -->
    <?php if ($customer): ?>
        <form method="POST" action="">
            <label for="name">Customer Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $customer['name']; ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $customer['email']; ?>" required>

            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" value="<?php echo $customer['phone']; ?>">

            <!-- Display created date (read-only) -->
            <label for="created_at">Date Added:</label>
            <input type="text" id="created_at" name="created_at" value="<?php echo $customer['created_at']; ?>" disabled>

            <!-- Submit button -->
            <input type="submit" name="submit" value="Update Customer">
        </form>

        <!-- Link to go back -->
        <a href="view_customers.php" style="display: block; margin-top: 20px; text-align: center;">Back to Customer List</a>
    <?php endif; ?>
</div>

<?php
// Include footer
include('../includes/footer.php');
?>
