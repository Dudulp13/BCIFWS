<?php
// Include your existing database connection
require '../includes/database.php'; // Ensure this points to the correct path of your database.php file

header('Content-Type: application/json');

try {
    // Prepare the SQL query to count new prayer requests
    $sql = "SELECT COUNT(*) AS request_count FROM prayers WHERE status = 'pending';"; // Count the number of prayer requests

    $result = mysqli_query($conn, $sql);

    // Check for errors in the SQL query
    if (!$result) {
        throw new Exception("Database query failed: " . mysqli_error($conn));
    }

    // Fetch the count of new requests
    $row = mysqli_fetch_assoc($result);
    $requestCount = $row['request_count'];

    // Return the count as JSON
    echo json_encode(['count' => $requestCount]);

} catch (Exception $e) {
    // Handle any errors by returning a JSON object with the error message
    echo json_encode(['error' => $e->getMessage()]);
}
?>