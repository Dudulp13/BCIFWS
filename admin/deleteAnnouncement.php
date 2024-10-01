<?php
include('../includes/database.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Cast to integer to avoid SQL injection

    // SQL DELETE statement
    $sql = "DELETE FROM announcements WHERE id = ?";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameter
        $stmt->bind_param("i", $id);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect back to the list of events or a confirmation page
            header("Location: announcement.php"); // Adjust this URL if needed
            exit();
        } else {
            echo "Error deleting record: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        die("Prepare failed: " . $conn->error);
    }
} else {
    echo "No announcement ID specified.";
}

// Close the connection
$conn->close();
?>