// Simple JavaScript file for CRM System

console.log("Welcome to CRM System!");

// Function to show alert when form is submitted
function showAlert() {
    console.log("Form submitted!");
}

// Function to confirm delete action
function confirmDelete(customerName) {
    return confirm("Are you sure you want to delete " + customerName + "?");
}

// Function to validate customer form (Add/Edit)
function validateCustomerForm() {
    // Get form fields
    var name = document.getElementById("name").value.trim();
    var email = document.getElementById("email").value.trim();
    var phone = document.getElementById("phone").value.trim();

    // Clear previous error messages
    document.getElementById("error-message").innerHTML = "";

    // Validate Name
    if (name == "") {
        showValidationError("Name is required!");
        return false;
    }

    if (name.length < 2) {
        showValidationError("Name must be at least 2 characters long!");
        return false;
    }

    // Validate Email
    if (email == "") {
        showValidationError("Email is required!");
        return false;
    }

    if (!isValidEmail(email)) {
        showValidationError("Please enter a valid email address!");
        return false;
    }

    // Validate Phone (if provided)
    if (phone != "") {
        if (!isValidPhone(phone)) {
            showValidationError("Phone number should contain only numbers and common symbols!");
            return false;
        }
    }

    // All validations passed
    return true;
}

// Function to validate email format
function isValidEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Function to validate phone format
function isValidPhone(phone) {
    var phoneRegex = /^[0-9\-\+\(\)\s]+$/;
    return phoneRegex.test(phone);
}

// Function to show validation error
function showValidationError(message) {
    var errorDiv = document.getElementById("error-message");
    if (errorDiv) {
        errorDiv.innerHTML = "<div style='background-color: #f8d7da; color: #721c24; padding: 12px; border-radius: 4px; margin-bottom: 15px; border: 1px solid #f5c6cb;'><strong>Error:</strong> " + message + "</div>";
        // Scroll to top to show error
        window.scrollTo(0, 0);
    }
}

// Function to add event listener to form
document.addEventListener("DOMContentLoaded", function() {
    // Add validation to customer form by checking for form with customer fields
    var nameInput = document.getElementById("name");
    if (nameInput) {
        // Clear error message when user starts typing
        nameInput.addEventListener("focus", function() {
            document.getElementById("error-message").innerHTML = "";
        });
    }
});

