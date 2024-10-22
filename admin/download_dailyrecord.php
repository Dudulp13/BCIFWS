<?php
include("../includes/database.php"); // Make sure to include your database connection

// Set headers to force download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="daily_records_report.csv"');

// Open output stream
$output = fopen('php://output', 'w');

// Add header row to CSV
fputcsv($output, ['ID', 'Date', 'Type', 'Category', 'Amount', 'Created By']);

// Fetch daily records
$query = "SELECT * FROM daily_records";
$result = $conn->query($query);

// Check if records exist
if ($result->num_rows > 0) {
    // Loop through each record and write to CSV
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, [
            $row['id'],
            date('M j, Y', strtotime($row['date'])), // Format date
            $row['type'],
            $row['category'],
            number_format($row['amount'], 2), // Format amount
            $row['created_by']
        ]);
    }
}

// Close the output stream
fclose($output);
exit(); // Exit to ensure no additional output is sent