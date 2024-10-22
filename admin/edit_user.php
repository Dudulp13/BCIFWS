<?php
include("../includes/database.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate required fields
    $userId = $_POST['id'] ?? null;
    $username = $_POST['username'] ?? null;
    $firstName = $_POST['first_name'] ?? null;
    $lastName = $_POST['last_name'] ?? null;
    $email = $_POST['email'] ?? null;
    $address = $_POST['address'] ?? null;
    $contact = $_POST['contact'] ?? null;
    $role = $_POST['role'] ?? null;
    $ministry = $_POST['ministry'] ?? null;
    $birthday = $_POST['birthday'] ?? null;
    $currentProfilePicture = $_POST['pp_url'] ?? null; // URL from hidden input

    // Simple validation
    if (!$username || !$email) {
        header("Location: users.php?message=Please fill in all required fields&alertType=danger");
        exit();
    }

    $uploadDir = 'uploads/'; // Directory to store uploaded files
    $profilePicture = $currentProfilePicture; // Fallback to current picture

    // Check if a new file was uploaded
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profile_picture']['tmp_name'];
        $fileName = $_FILES['profile_picture']['name'];
        $fileSize = $_FILES['profile_picture']['size'];
        $fileType = $_FILES['profile_picture']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $allowedfileExtensions = array('jpg', 'png', 'jpeg');

        // Check file type
        if (in_array($fileExtension, $allowedfileExtensions) && $fileSize < 2 * 1024 * 1024) { // Limit to 2MB
            // Generate new unique file name
            $newFileName = $userId . '_' . time() . '.' . $fileExtension;
            $dest_path = $uploadDir . $newFileName;

            // Move file to upload directory
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                // Update profile picture URL
                $profilePicture = $dest_path;
            } else {
                header("Location: users.php?message=Error uploading the file&alertType=danger");
                exit();
            }
        } else {
            header("Location: users.php?message=Invalid file extension or file too large&alertType=danger");
            exit();
        }
    }

    // Update user in the database
    $query = "UPDATE users SET
        username = ?,
        first_name = ?,
        last_name = ?,
        email = ?,
        address = ?,
        contact = ?,
        role = ?,
        ministry = ?,
        birthday = ?,
        pp_url = ?
        WHERE id = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        "ssssssssssi",
        $username,
        $firstName,
        $lastName,
        $email,
        $address,
        $contact,
        $role,
        $ministry,
        $birthday,
        $profilePicture,
        $userId
    );

    if ($stmt->execute()) {
        // Redirect back with success message
        header("Location: users.php?message=" . urlencode("$username's profile has been updated successfully!") . "&alertType=success");
    } else {
        header("Location: users.php?message=Error updating user: " . $conn->error . "&alertType=danger");
    }

}
?>