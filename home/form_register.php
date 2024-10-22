<?php
// Start session
session_start();

// Include the database connection file
include("../includes/database.php");

// Check if the form is submitted
if (isset($_POST['registerEvent'])) {
    // Capture and sanitize the form data
    $event_name = mysqli_real_escape_string($conn, $_POST['eventName']);
    $full_name = mysqli_real_escape_string($conn, $_POST['fullName']);
    $email_address = mysqli_real_escape_string($conn, $_POST['emailAddress']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contactNumber']);
    $number_of_pax = mysqli_real_escape_string($conn, $_POST['numberOfPax']);
    $comments = mysqli_real_escape_string($conn, $_POST['comments']);

    // Initialize user_id
    $user_id = null;

    // Check if the user is logged in
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id']; // Logged in user
    }

    // Check if the user (if any) is already registered for the event
    if ($user_id !== null) {
        $check_sql = "SELECT * FROM event_registrations WHERE user_id = '$user_id' AND event_name = '$event_name'";
        $result = $conn->query($check_sql);

        if ($result->num_rows > 0) {
            // User is already registered
            $_SESSION['error_message'] = "You have already registered for this event.";
            header("Location: error_page.php"); // Redirect to an error page
            exit();
        }
    }

    // SQL query to insert the data into the database
    // Make sure to handle null user_id
    $sql = "INSERT INTO event_registrations (event_name, user_id, full_name, contact_number, number_pax, comments, created_at)
    VALUES ('$event_name', " . ($user_id === null ? 'NULL' : "'$user_id'") . ", '$full_name', '$contact_number', '$number_of_pax', '$comments', NOW())";


    // Execute the query and check if the insertion was successful
    if ($conn->query($sql) === TRUE) {
        // Set success message in session
        $_SESSION['success_message'] = "Registration successful! You have successfully registered for the event.";
        header("Location: home.php");
        exit(); // Stop further execution
    } else {
        // Handle SQL error
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>