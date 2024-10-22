<?php
// Include database connection
include('../includes/database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $id = $_POST['id'];
    $type = $_POST['type'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];

    // Validate input
    if (!empty($id) && !empty($type) && !empty($category) && !empty($description) && !empty($amount)) {
        // Prepare the SQL statement to prevent SQL injection
        $stmt = $conn->prepare("UPDATE daily_records SET type = ?, category = ?, description = ?, amount = ? WHERE id = ?");
        $stmt->bind_param("sssdi", $type, $category, $description, $amount, $id); // note the 'd' for the decimal amount

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect back to transaction.php with success message
            header("Location: transaction.php?msg=" . urlencode("Record updated successfully"));
            exit();
        } else {
            // Redirect with error message
            header("Location: transaction.php?msg=" . urlencode("Error: " . $stmt->error));
            exit();
        }
    } else {
        // Redirect with error message for validation failure
        header("Location: transaction.php?msg=" . urlencode("All fields are required."));
        exit();
    }
}
?>