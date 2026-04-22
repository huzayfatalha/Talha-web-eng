<?php

include('includes/header.php');
?>

<div class="container">
    <h2>Welcome to Lead Tracking AI</h2>

    <div class="welcome">
        <p>Hello! This is a powerful Lead Tracking and Management System powered by AI insights.</p>
        <p>With this system, you can:</p>
        <ul style="margin-left: 20px; margin-top: 10px;">
            <li>Add and track new leads</li>
            <li>View all leads in the system</li>
            <li>Edit and manage lead information</li>
            <li>Search through your lead database</li>
        </ul>

        <p style="margin-top: 20px;">Use the navigation menu above to get started.</p>

        <div style="margin-top: 30px;">
            <a href="pages/add_customer.php" class="btn">Add New Lead</a>
            <a href="pages/view_customers.php" class="btn">View All Leads</a>
        </div>
    </div>
</div>

<?php

include('includes/footer.php');
?>
