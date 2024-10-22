<?php
require '../includes/database.php'; // Make sure to include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $year = $_POST['year'];
    $quarter = $_POST['quarter'];
    $allocated_budget = $_POST['allocated_budget'];
    $actual_spent = $_POST['actual_spent'];
    $added_by = $_POST['added_by'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO church_budget (year, quarter, allocated_budget, actual_spent, added_by) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $year, $quarter, $allocated_budget, $actual_spent, $added_by);

    if ($stmt->execute()) {
        // Redirect to transaction.php with success message
        header("Location: transaction.php?msg=" . urlencode("Budget added successfully!"));
        exit();
    } else {
        // Redirect to transaction.php with error message
        header("Location: transaction.php?msg=" . urlencode("Error: " . $stmt->error));
        exit();
    }


}
?>