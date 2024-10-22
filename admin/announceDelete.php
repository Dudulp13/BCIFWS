<?php
include('../includes/database.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure ID is an integer

    // Prepare and execute the delete query
    $sql = "DELETE FROM announcements WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        // Redirect back to the announcements page with a success message
        header("Location: announce.php?status=success&message=Announcement ID: $id has been deleted successfully");
    } else {
        // Handle error
        header("Location: announce.php?status=error&message=Error deleting announcement (ID: $id)!");
    }

    $stmt->close();
} else {
    // Invalid request
    header("Location: announce.php?status=error&message=Invalid request");
}

$conn->close();
?>