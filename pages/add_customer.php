<?php
// Include database connection
include('../db.php');

// Include header
include('../includes/header.php');

// Initialize message variable
$message = "";

// Check if form was submitted
if (isset($_POST['submit'])) {
    // Get form data from POST
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    // Simple validation (check if required fields are empty)
    if (empty($name) || empty($email)) {
        $message = "Name and Email are required!";
    } else {
        // Create INSERT query
        $query = "INSERT INTO customers (name, email, phone)
                  VALUES ('$name', '$email', '$phone')";

        // Execute query
        if (mysqli_query($conn, $query)) {
            $message = "Customer added successfully!";
            // Redirect to view customers page after 2 seconds
            echo "<script>
                setTimeout(function() {
                    window.location.href = 'view_customers.php';
                }, 2000);
            </script>";
        } else {
            // Show error message if insertion failed
            $message = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<div class="container">
    <h2>Add New Customer</h2>

    <!-- Show message if there is one -->
    <?php if (!empty($message)): ?>
        <p style="background-color: #ecf0f1; padding: 10px; border-radius: 4px; color: #2c3e50;">
            <?php echo $message; ?>
        </p>
    <?php endif; ?>

    <!-- Customer form -->
    <form method="POST" action="">
        <label for="name">Customer Name:</label>
        <input type="text" id="name" name="name" required placeholder="Enter customer name">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required placeholder="Enter customer email">

        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" placeholder="Enter customer phone">

        <!-- Submit button -->
        <input type="submit" name="submit" value="Add Customer">
    </form>
</div>

<?php
// Include footer
include('../includes/footer.php');
?>
