<?php
include("../includes/database.php");
session_start();

// Assuming the user ID is stored in session after login
$user_id = $_SESSION['user_id'];

// Fetch the user's username from the users table
$query = "SELECT username FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username);
$stmt->fetch();
$stmt->close();

// Return the username as a JSON response
echo json_encode(['username' => $username]);
?>