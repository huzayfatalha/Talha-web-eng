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
