<?php
include('../includes/database.php');

// Check if an ID is provided via GET request
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Anti SQL Injection

    // Fetch from the database
    $sql = "SELECT * FROM announcements WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $announce_update = $result->fetch_assoc(); // Fetch event details
    } else {
        die("Announcement not found.");
    }
    $stmt->close();
} else {
    die("No Announcement ID specified.");
}

// Update if the button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST['category']; // Match with form 'name'
    $announce_msg = $_POST['announceMsg']; // Match with form 'name'
    $time = $_POST['time_date']; // Match with form 'name'

    // SQL query to update the announcement
    $sql = "UPDATE announcements SET ministry_cat = ?, announce_msg = ?, time_date = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $category, $announce_msg, $time, $id);

    if ($stmt->execute()) {
        header("Location: announcement.php"); // Redirect to announcement page
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<div class="container mt-4">
    <h2>Edit Announcement</h2>
    <form method="post" action="">
        <div class="form-group">
            <select class="form-select fs-6 px-3 border border-info" id="category" name="category">
                <option value="" disabled selected>Choose Category</option>
                <option value="Children" <?php if ($announce_update['ministry_cat'] == 'Children') echo 'selected'; ?>>
                    Children
                </option>
                <option value="Youth" <?php if ($announce_update['ministry_cat'] == 'Youth') echo 'selected'; ?>>Youth
                </option>
                <option value="Outreach" <?php if ($announce_update['ministry_cat'] == 'Outreach') echo 'selected'; ?>>
                    Outreach
                </option>
                <option value="Usher" <?php if ($announce_update['ministry_cat'] == 'Usher') echo 'selected'; ?>>Usher
                </option>
                <option value="Media" <?php if ($announce_update['ministry_cat'] == 'Media') echo 'selected'; ?>>Media
                </option>
                <option value="Dance" <?php if ($announce_update['ministry_cat'] == 'Dance') echo 'selected'; ?>>Dance
                </option>
                <option value="Music" <?php if ($announce_update['ministry_cat'] == 'Music') echo 'selected'; ?>>Music
                </option>
                <option value="General" <?php if ($announce_update['ministry_cat'] == 'General') echo 'selected'; ?>>
                    General
                </option>
            </select>
        </div>

        <div class="form-group">
            <label for="announceMsg">Message:</label>
            <textarea class="form-control" id="announceMsg" name="announceMsg" rows="5"
                required><?php echo htmlspecialchars($announce_update['announce_msg']); ?></textarea>
        </div>

        <div class="form-group">
            <label for="time_date">Time & Date:</label>
            <input type="datetime-local" class="form-control" id="time_date" name="time_date"
                value="<?php echo htmlspecialchars(date('Y-m-d\TH:i', strtotime($announce_update['time_date']))); ?>"
                required>
        </div>

        <button type="submit" class="btn btn-primary">Update Announcement</button>
        <a href="announcement.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>