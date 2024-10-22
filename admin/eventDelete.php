<?php
include('../includes/database.php'); // Include your database connection file

if (isset($_GET['id'])) {
    $eventId = (int)$_GET['id']; // Get the ID from the URL and cast it to an integer

    // Prepare the SQL statement to delete the event
    $sql = "DELETE FROM events WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $eventId); // Bind the event ID parameter

    if ($stmt->execute()) {
        // Redirect back to the events page with a success message
        header("Location: events.php?status=success&message=Event ID: $eventId deleted successfully!");
    } else {
        // Redirect back with an error message
        header("Location: events.php?status=error&message=Failed to delete event (ID: $eventId)");
    }

    $stmt->close();
    $conn->close();
} else {
    // Redirect back if no ID is provided
    header("Location: events.php?status=error&message=No event ID specified");
}
?>