<?php
include("../includes/database.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $userId = $_GET['id'];

    // Fetch the username before deleting
    $query = "SELECT username FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $username = $user['username'];

        // Proceed with deletion
        $deleteQuery = "DELETE FROM users WHERE id = ?";
        $deleteStmt = $conn->prepare($deleteQuery);
        $deleteStmt->bind_param("i", $userId);
        if ($deleteStmt->execute()) {
            // Redirect back with success message
            header("Location: users.php?message=" . urlencode("User $username has been deleted successfully!") . "&alertType=success");
            exit(); // It's a good practice to call exit after a header redirect
        }

        } else {
            header("Location: users.php?message=Error deleting user: " . $conn->error . "&alertType=danger");
        }
    } else {
        header("Location: users.php?message=User not found&alertType=danger");
    }
?>