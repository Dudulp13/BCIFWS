<?php
session_start();
header('Content-Type: application/json');
include ("..includes/database.php");

if ($conn->connect_error) {
    die(json_encode(['error' => 'Database connection failed: ' . $conn->connect_error]));
}

$data = json_decode(file_get_contents("php://input"), true);
$email = $data['email'];
$password = $data['password'];

// SQL query to select the hashed password
$query = "SELECT password FROM users WHERE email = '$email'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashedPassword = $row['password'];

    // Verify the password
    if (password_verify($password, $hashedPassword)) {
        $_SESSION['user'] = $email; // Set session variable
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Invalid password']);
    }
} else {
    echo json_encode(['error' => 'No user found with this email']);
}

$conn->close();
?>