<?php
require '../includes/database.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("DELETE FROM church_budget WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirect back to transaction.php with success message
        header("Location: transaction.php?msg=" . urlencode("Budget deleted successfully!"));
        exit();
    } else {
        // Redirect back to transaction.php with error message
        header("Location: transaction.php?msg=" . urlencode("Error: " . $stmt->error));
        exit();
    }

    $stmt->close();
    $conn->close();

    header('Location: transaction.php'); // Redirect back to main page
}
?>