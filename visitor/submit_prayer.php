<?php
include ('../includes/database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $message = mysqli_real_escape_string($conn, $_POST['prayerRequest']);
    $prayer_type = mysqli_real_escape_string($conn, $_POST['prayerType']);
    $reach_out = mysqli_real_escape_string($conn, $_POST['followUp']);

    // Initialize sender and address to NULL in case they are not provided
    $sender = NULL;
    $address = NULL;

    // Only collect name and contact details if the user selected "Yes"
    if ($reach_out === 'yes') {
        $sender = mysqli_real_escape_string($conn, $_POST['name']);
        $address = mysqli_real_escape_string($conn, $_POST['phone']);
    }

    // Prepare SQL query
    $query = "INSERT INTO prayers (message, prayer_type, reach_out, sender, address)
              VALUES ('$message', '$prayer_type', '$reach_out', " .
              ($sender ? "'$sender'" : "NULL") . ", " . ($address ? "'$address'" : "NULL") . ")";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        // Success message
        echo "<script>
                alert('Request submitted successfully!');
                document.forms[0].reset(); // Clear the form
              </script>";
    } else {
        // Error message
        $error_message = mysqli_real_escape_string($conn, mysqli_error($conn)); // Prevent XSS with escaping
        echo "<script>
                alert('Error: $error_message');
              </script>";
    }
}
?>