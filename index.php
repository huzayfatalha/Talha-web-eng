<?php
// Include the header file
include('includes/header.php');
?>

<div class="container">
    <h2>Welcome to CRM System</h2>

    <div class="welcome">
        <p>Hello! This is a simple Customer Relationship Management (CRM) system.</p>
        <p>With this system, you can:</p>
        <ul style="margin-left: 20px; margin-top: 10px;">
            <li>Add new customers</li>
            <li>View all customers in the system</li>
            <li>Manage customer information</li>
        </ul>

        <p style="margin-top: 20px;">Use the navigation menu above to get started.</p>

        <div style="margin-top: 30px;">
            <a href="pages/add_customer.php" class="btn">Add New Customer</a>
            <a href="pages/view_customers.php" class="btn">View All Customers</a>
        </div>
    </div>
</div>

<?php
// Include the footer file
include('includes/footer.php');
?>
