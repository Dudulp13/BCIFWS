<?php
// Database connection
include '../includes/database.php';

// Query to get pending requests from cert_request table
$cert_request_query = "SELECT COUNT(*) as pending_count FROM cert_request WHERE status = 'pending'";
$cert_result = mysqli_query($conn, $cert_request_query);
$cert_pending = mysqli_fetch_assoc($cert_result)['pending_count'];

// Query to get pending requests from baptism_schedule table
$baptism_schedule_query = "SELECT COUNT(*) as pending_count FROM baptism_schedule WHERE status = 'pending'";
$baptism_result = mysqli_query($conn, $baptism_schedule_query);
$baptism_pending = mysqli_fetch_assoc($baptism_result)['pending_count'];

// Total pending requests
$total_pending = $cert_pending + $baptism_pending;

// Return the total pending requests as JSON
echo json_encode([
    'cert_pending' => $cert_pending,
    'baptism_pending' => $baptism_pending,
    'total_pending' => $total_pending
]);
?>