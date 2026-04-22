<?php

include('../includes/session_check.php');


include('../db.php');


include('../includes/header.php');


$message = "";
$messageType = ""; // "success" or "error"


if (isset($_POST['submit'])) {
    
    $name = trim(mysqli_real_escape_string($conn, $_POST['name']));
    $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
    $phone = trim(mysqli_real_escape_string($conn, $_POST['phone']));

   
    $errors = array();

  
    if (empty($name)) {
        $errors[] = "Name is required!";
    } elseif (strlen($name) < 2) {
        $errors[] = "Name must be at least 2 characters long!";
    }

    if (empty($email)) {
        $errors[] = "Email is required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address!";
    }

    
    if (!empty($phone)) {
        if (!preg_match("/^[0-9\-\+\(\)\s]+$/", $phone)) {
            $errors[] = "Phone number should contain only numbers and common symbols!";
        }
    }


    if (count($errors) > 0) {
        $message = implode("<br>", $errors);
        $messageType = "error";
    } else {
       
        $query = "INSERT INTO customers (name, email, phone)
                  VALUES ('$name', '$email', '$phone')";

        
        if (mysqli_query($conn, $query)) {
            $message = "Customer added successfully!";
            $messageType = "success";
           
            echo "<script>
                setTimeout(function() {
                    window.location.href = 'view_customers.php';
                }, 2000);
            </script>";
        } else {
           
            $message = "Error: " . mysqli_error($conn);
            $messageType = "error";
        }
    }
}
?>

<div class="container">
    <h2>Add New Lead</h2>

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

    <!-- Lead form -->
    <form method="POST" action="" onsubmit="return validateCustomerForm()">
        <label for="name">Lead Name:</label>
        <input type="text" id="name" name="name" placeholder="Enter lead name (min 2 characters)">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter lead email (e.g., john@example.com)">

        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" placeholder="Enter lead phone (optional)">

        <!-- Submit button -->
        <input type="submit" name="submit" value="Add Lead">
    </form>

    <!-- Info message -->
    <p style="margin-top: 20px; font-size: 12px; color: #7f8c8d;">
        <strong>Note:</strong> Name and Email are required. Phone is optional.
    </p>
</div>

<?php

include('../includes/footer.php');
?>
