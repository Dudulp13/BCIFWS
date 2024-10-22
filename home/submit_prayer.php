<?php
include ('../includes/database.php');

// Initialize alert variables
$alertMessage = '';
$alertType = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data, with default values if not set
    $message = isset($_POST['prayerRequest']) ? $_POST['prayerRequest'] : null;
    $prayer_type = isset($_POST['prayerType']) ? $_POST['prayerType'] : null;
    $reach_out = isset($_POST['followUp']) ? $_POST['followUp'] : null;

    // Initialize sender and address to NULL
    $sender = null;
    $address = null;

    // Only collect name and contact details if the user selected "Yes" for follow-up
    if ($reach_out === 'yes') {
        $sender = isset($_POST['name']) ? $_POST['name'] : null;
        $address = isset($_POST['phone']) ? $_POST['phone'] : null;
    }

    // Validate required fields
    if ($message && $prayer_type && $reach_out) {
        // Prepare SQL query
        $stmt = $conn->prepare("INSERT INTO prayers (message, prayer_type, reach_out, sender, address) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $message, $prayer_type, $reach_out, $sender, $address);

        // Execute the query
        if ($stmt->execute()) {
            // Success message
            $alertMessage = 'Prayer request submitted successfully!';
            $alertType = 'success';
            $_POST = []; // Clear POST data to reset the form fields
        } else {
            // Error message
            $error_message = htmlspecialchars($stmt->error); // Prevent XSS with escaping
            $alertMessage = "Error: $error_message";
            $alertType = 'danger';
        }

        // Close the statement
        $stmt->close();
    } else {
        // Handle missing required fields
        $alertMessage = 'Please fill out all required fields.';
        $alertType = 'warning';
    }
}
?>