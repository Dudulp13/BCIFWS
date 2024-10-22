<?php
include('../includes/database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $id = $_POST['id'];
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $time_date = mysqli_real_escape_string($conn, $_POST['time_date']);

    // Prepare the SQL statement
    $sql = "UPDATE announcements SET ministry_cat = ?, announce_msg = ?, time_date = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters
        $stmt->bind_param('sssi', $category, $message, $time_date, $id);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect back to the announcements page with success message
            header("Location: announce.php?status=success&message=Announcement ID: $id has been updated successfully!");
            exit();
        } else {
            // Log the error
            error_log("Error updating record: " . $stmt->error);
            // Redirect back with error message
            header("Location: announce.php?status=error&message=Could not update announcement (ID: $id)");
            exit();
        }
    } else {
        // Log the error if statement preparation fails
        error_log("Error preparing statement: " . $conn->error);
        // Redirect back with error message
        header("Location: announce.php?status=error&message=Error preparing statement for announcement (ID: $id)");
        exit();
    }
}

mysqli_close($conn);
?>