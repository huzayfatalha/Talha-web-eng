<?php
// Include database connection
include('../db.php');

// Include header
include('../includes/header.php');

// Initialize search variable
$search = "";
$search_query = "";

// Check if search form was submitted
if (isset($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);

    // Search by name or email
    $query = "SELECT * FROM customers WHERE name LIKE '%$search%' OR email LIKE '%$search%' ORDER BY id DESC";
} else {
    // Get all customers if no search
    $query = "SELECT * FROM customers ORDER BY id DESC";
}

// Execute query
$result = mysqli_query($conn, $query);

// Handle delete action
if (isset($_GET['delete'])) {
    $customer_id = mysqli_real_escape_string($conn, $_GET['delete']);
    $delete_query = "DELETE FROM customers WHERE id = '$customer_id'";

    if (mysqli_query($conn, $delete_query)) {
        echo "<script>alert('Customer deleted successfully!'); window.location.href='view_customers.php';</script>";
    } else {
        echo "<script>alert('Error deleting customer!');</script>";
    }
}
?>

<div class="container">
    <h2>View All Customers</h2>

    <!-- Search Form -->
    <div style="background-color: #ecf0f1; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
        <form method="POST" action="">
            <div style="display: flex; gap: 10px; align-items: center;">
                <input type="text" name="search"
                       placeholder="Search by name or email..."
                       value="<?php echo $search; ?>"
                       style="padding: 8px; border: 1px solid #bdc3c7; border-radius: 4px; flex: 1; font-size: 14px;">

                <input type="submit" value="Search"
                       style="padding: 8px 15px; background-color: #3498db; color: white; border: none; border-radius: 4px; cursor: pointer;">

                <?php if (!empty($search)): ?>
                    <a href="view_customers.php"
                       style="padding: 8px 15px; background-color: #95a5a6; color: white; text-decoration: none; border-radius: 4px; display: inline-block;">Clear Search</a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <!-- Search result info -->
    <?php if (!empty($search)): ?>
        <p style="color: #7f8c8d; margin-bottom: 15px;">
            Searching for: <strong><?php echo $search; ?></strong>
        </p>
    <?php endif; ?>

    <?php
    // Check if there are any customers
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Name</th>";
        echo "<th>Email</th>";
        echo "<th>Phone</th>";
        echo "<th>Date Added</th>";
        echo "<th>Actions</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        // Loop through each customer and display in table
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";
            echo "<td>" . $row['created_at'] . "</td>";
            echo "<td>";
            echo "<a href='edit_customer.php?id=" . $row['id'] . "' class='btn'>Edit</a> ";
            echo "<a href='?delete=" . $row['id'] . "' class='btn btn-danger' onclick=\"return confirmDelete('" . $row['name'] . "');\">Delete</a>";
            echo "</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
    } else {
        // Show message if no customers found
        if (!empty($search)) {
            echo "<p style='text-align: center; padding: 20px; background-color: #fff3cd; border-radius: 4px;'>No customers found for \"<strong>" . $search . "</strong>\". <a href='view_customers.php'>View all customers</a></p>";
        } else {
            echo "<p style='text-align: center; padding: 20px;'>No customers found. <a href='add_customer.php'>Add your first customer!</a></p>";
        }
    }

    // Close database connection
    mysqli_close($conn);
    ?>
</div>

<?php
// Include footer
include('../includes/footer.php');
?>

