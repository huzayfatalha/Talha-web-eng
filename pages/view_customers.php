<?php
// Include database connection
include('../db.php');

// Include header
include('../includes/header.php');

// Get all customers from database
$query = "SELECT * FROM customers ORDER BY id DESC";
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
        echo "<p style='text-align: center; padding: 20px;'>No customers found. <a href='add_customer.php'>Add your first customer!</a></p>";
    }

    // Close database connection
    mysqli_close($conn);
    ?>
</div>

<?php
// Include footer
include('../includes/footer.php');
?>
