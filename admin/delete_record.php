<?php
include("../includes/database.php");
session_start();

// Get the ID from the URL
$id = $_GET['id'];

// Prepare the delete statement
$stmt = $conn->prepare("DELETE FROM daily_records WHERE id = ?");
$stmt->bind_param("s", $id);

if ($stmt->execute()) {
    // Redirect with success message
    header("Location: transaction.php?msg=" . urlencode("Record deleted successfully."));
    exit();
} else {
    // Redirect with error message
    header("Location: transaction.php?msg=" . urlencode("Error: " . $stmt->error));
    exit();
}

$stmt->close();
$conn->close();
?>