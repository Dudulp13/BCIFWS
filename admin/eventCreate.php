<?php
include('../includes/database.php'); // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = mysqli_real_escape_string($conn, $_POST['eventTitle']); // Ensure this matches the form input name
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);

    // SQL query to insert a new event
    $sql = "INSERT INTO events (title, description, time, date, location) VALUES ('$title', '$description', '$time', '$date', '$location')";

    if (mysqli_query($conn, $sql)) {
        $newEventId = mysqli_insert_id($conn); // Get the last inserted ID
        // Redirect back to the events page with a success message
        header("Location: events.php?status=success&message=New Event has been created successfully! ID: $newEventId");
        exit();
    } else {
        error_log("Error creating record: " . mysqli_error($conn));
        // Redirect back to the events page with an error message
        header("Location: events.php?status=error&message=Error creating event");
        exit();
    }
}
?>