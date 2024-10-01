<?php
include('../includes/database.php');

// Check if an ID is provided via GET request
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // anti sqlInject

    // fetch from db
    $sql = "SELECT * FROM events WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $event = $result->fetch_assoc();
    } else {
        die("Event not found.");
    }
    $stmt->close();
} else {
    die("No event ID specified.");
}

// update if button clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $time = $_POST['time'];
    $date = $_POST['date'];
    $location = $_POST['location'];

    // sql query
    $sql = "UPDATE events SET title = ?, description = ?, time = ?, date = ?, location = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $title, $description, $time, $date, $location, $id);

    if ($stmt->execute()) {
        echo "Success: ";
        header("Location: event.php"); // Redirect to event
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<div class="container mt-4">
    <h2>Edit Event</h2>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        <i class="material-icons opacity-10">add</i>ss</button>
    <form method="post" action="">
        <div class="form-group">
            <label for="title">Event Name:</label>
            <input type="text" class="form-control" id="title" name="title"
                value="<?php echo htmlspecialchars($event['title']); ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="4"
                required><?php echo htmlspecialchars($event['description']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="time">Time:</label>
            <input type="text" class="form-control" id="time" name="time"
                value="<?php echo htmlspecialchars($event['time']); ?>" required>
        </div>
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" class="form-control" id="date" name="date"
                value="<?php echo htmlspecialchars($event['date']); ?>" required>
        </div>
        <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" class="form-control" id="location" name="location"
                value="<?php echo htmlspecialchars($event['location']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Event</button>
        <a href="event.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>