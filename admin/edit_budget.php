<?php
require '../includes/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $year = $_POST['year'];
    $quarter = $_POST['quarter'];
    $allocated_budget = $_POST['allocated_budget'];
    $actual_spent = $_POST['actual_spent'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("UPDATE church_budget SET year = ?, quarter = ?, allocated_budget = ?, actual_spent = ? WHERE id = ?");
    $stmt->bind_param("isssi", $year, $quarter, $allocated_budget, $actual_spent, $id);

    if ($stmt->execute()) {
        // Redirect back to transaction.php with success message
        header("Location: transaction.php?msg=" . urlencode("Budget updated successfully!"));
        exit();
    } else {
        // Redirect back to transaction.php with error message
        header("Location: transaction.php?msg=" . urlencode("Error: " . $stmt->error));
        exit();
    }

}
?>