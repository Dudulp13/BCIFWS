<?php
include('../includes/database.php'); // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $eventId = mysqli_real_escape_string($conn, $_POST['eventId']);
    $title = mysqli_real_escape_string($conn, $_POST['eventTitle']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);

    // Prepare the SQL query to update the event
    $sql = "UPDATE events SET title=?, description=?, time=?, date=?, location=? WHERE id=?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('sssssi', $title, $description, $time, $date, $location, $eventId);

        if ($stmt->execute()) {
            header("Location: events.php?status=success&message=Event ID: $eventId has been updated successfully!");
            exit();
        } else {
            error_log("Error updating record: " . $stmt->error);
            header("Location: events.php?status=error&message=Could not update event (ID: $eventId)");
            exit();
        }
    } else {
        error_log("Error preparing statement: " . $conn->error);
        header("Location: events.php?status=error&message=Error preparing statement for event (ID: $eventId)");
        exit();
    }
}

mysqli_close($conn);
?>