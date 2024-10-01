<?php
include "../includes/database.php";
// Set default timezone
date_default_timezone_set('Asia/Manila');

// Check if the form is submitted
if (isset($_POST["save_announce"])) {
    // Validate and escape inputs
    $ministry = $conn->real_escape_string($_POST["category"]);
    $announce_msg = $conn->real_escape_string($_POST["announceMsg"]);
    $announceDateTime = $conn->real_escape_string($_POST["announceDt"]);

    // Format datetime for MySQL
    $announceDateTimeFormatted = date('Y-m-d H:i:s', strtotime($announceDateTime));
    $posted = date('Y-m-d H:i:s');

    // SQL query to insert announcement
    $insert_query = "INSERT INTO `announcements` (`ministry_cat`, `announce_msg`, `time_date`, `created_at`)
                     VALUES ('$ministry', '$announce_msg', '$announceDateTimeFormatted', '$posted')";

    // Execute the query
    if ($conn->query($insert_query)) {
        $_SESSION['status'] = "Announcement successfully added!";
    } else {
        $_SESSION['status'] = "Failed to add announcement: " . $conn->error;
    }

}
?>