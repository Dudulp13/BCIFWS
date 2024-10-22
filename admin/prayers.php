<?php
ob_start(); // Start output buffering
session_start();
include('header.php');
include('../includes/database.php');

// Function to execute prepared statements
function executeQuery($conn, $sql, $params) {
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(...$params);
    if ($stmt->execute()) {
        return true;
    } else {
        error_log("Error executing query: " . $stmt->error);
        return false;
    }
}

// Handle the form submission for marking or deleting prayer requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $id = intval($_POST['id']);
        if ($id) {
            $sql = "UPDATE prayers SET status = 'completed', completed_at = NOW() WHERE id = ?";
            if (executeQuery($conn, $sql, ["i", $id])) {
                $_SESSION['message'] = "Prayer request <strong>ID #{$id}</strong> marked as completed.";
                $_SESSION['alert_type'] = "success"; // for bootstrap alert
            } else {
                $_SESSION['message'] = "Failed to mark prayer request <strong>ID #{$id}</strong> as completed.";
                $_SESSION['alert_type'] = "danger"; // for bootstrap alert
            }
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
    } elseif (isset($_POST['delete_id'])) {
        $delete_id = intval($_POST['delete_id']);
        if ($delete_id) {
            $sql = "DELETE FROM prayers WHERE id = ?";
            if (executeQuery($conn, $sql, ["i", $delete_id])) {
                $_SESSION['message'] = "Prayer request <strong>ID #{$delete_id}</strong> has been deleted successfully.";
                $_SESSION['alert_type'] = "success"; // for bootstrap alert
            } else {
                $_SESSION['message'] = "Failed to delete prayer request <strong>ID #{$delete_id}</strong>.";
                $_SESSION['alert_type'] = "danger"; // for bootstrap alert
            }
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
    }
}

// Fetch pending prayer requests
$pending_sql = "SELECT id, message, prayer_type, reach_out, sender, address, created_at FROM prayers WHERE status = 'pending'";
$result = $conn->query($pending_sql);

// Fetch completed prayer requests
$completed_sql = "SELECT id, message, prayer_type, reach_out, sender, address, created_at, completed_at FROM prayers WHERE status = 'completed'";
$completed_result = $conn->query($completed_sql);
?>
<style>
.table {
    width: 100%;
    border-collapse: collapse;
}

.table td,
.table th {
    max-width: 500px;
    word-wrap: break-word;
    white-space: normal;
    max-height: 100px;
    overflow-y: auto;
    padding: 8px;
    text-align: left;
}

.description-cell {
    max-width: 100px;
    overflow: hidden;
    /* Hide overflow text */
    text-overflow: ellipsis;
    white-space: nowrap;
}

@media (max-width: 768px) {
    .table thead {
        display: none;
        /* Hides table headers */
    }

    .table tr {
        display: block;
        /* Makes each row block for better stacking */
        margin-bottom: 15px;
    }

    .table td {
        display: flex;
        /* Flexbox for alignment */
        justify-content: space-between;
        border: none;
        padding: 10px;
        background-color: #f9f9f9;
    }

    .table td::before {
        content: attr(data-label);
        font-weight: bold;
        margin-right: 10px;
    }

    .description-cell {
        white-space: normal;
        max-width: none;
    }
}
</style>
<?php if (isset($_SESSION['message'])): ?>
<div class="alert fs-5 text-light alert-<?php echo htmlspecialchars($_SESSION['alert_type']); ?> alert-dismissible fade show"
    role="alert">
    <?php echo $_SESSION['message']; // Display message with HTML tags rendered ?>
    <button type="button" class="btn-close text-light" data-bs-dismiss="alert" aria-label="Close"><i
            class="material-icons">close</i></button>
</div>

<?php
unset($_SESSION['message']);
unset($_SESSION['alert_type']);
endif; ?>


<div class="container-fluid">
    <h2 class="mb-4">Prayer Requests</h2>
    <div class="row justify-content-between">
        <div class="col-12">
            <h5>Pending</h5>
            <div class="table-responsive">
                <table id="pendingRequestsTable" class="table fs-5 text-dark">
                    <thead class="bg-dark text-light">
                        <tr>
                            <th>ID</th>
                            <th>Message</th>
                            <th>Prayer Type</th>
                            <th>Reach Out</th>
                            <th>Sender</th>
                            <th>Address</th>
                            <th>Submitted On</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && $result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr id="prayer-card-<?php echo htmlspecialchars($row['id']); ?>">
                            <td data-label="ID #"><?php echo htmlspecialchars($row['id']); ?></td>
                            <td data-label="Message" class="description-cell">
                                <?php echo htmlspecialchars($row['message']); ?></td>
                            <td data-label="Prayer Type"><?php echo htmlspecialchars($row['prayer_type']); ?></td>
                            <td data-label="Reach Out"><?php echo htmlspecialchars($row['reach_out']) ? 'Yes' : 'No'; ?>
                            </td>
                            <td data-label="Sender"><?php echo htmlspecialchars($row['sender']); ?></td>
                            <td data-label="Address"><?php echo htmlspecialchars($row['address']); ?></td>
                            <td data-label="Submitted On"><?php echo date('F j, Y', strtotime($row['created_at'])); ?>
                            </td>
                            <td data-label="Action">
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="delete_id"
                                        value="<?php echo htmlspecialchars($row['id']); ?>">
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this prayer request?');">Delete</button>
                                </form>
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                    <button type="submit" class="btn btn-success">Mark as done</button>
                                </form>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="8">No prayer requests found.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div class="col-12 my-5">
            <h5>Completed</h5>
            <div class="table-responsive">
                <table id="completedRequestsTable" class="table text-dark">
                    <thead class="bg-dark text-light">
                        <tr>
                            <th>ID</th>
                            <th>Message</th>
                            <th>Prayer Type</th>
                            <th>Reach Out</th>
                            <th>Sender</th>
                            <th>Address</th>
                            <th>Requested</th>
                            <th>Completed</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($completed_result && $completed_result->num_rows > 0): ?>
                        <?php while ($completed_row = $completed_result->fetch_assoc()): ?>
                        <tr>
                            <td data-label="ID #"><?php echo htmlspecialchars($completed_row['id']); ?></td>
                            <td class="description-cell" data-label="Message">
                                <?php echo htmlspecialchars($completed_row['message']); ?></td>
                            <td data-label="Prayer Type"><?php echo htmlspecialchars($completed_row['prayer_type']); ?>
                            </td>
                            <td data-label="Reach Out">
                                <?php echo htmlspecialchars($completed_row['reach_out']) ? 'Yes' : 'No'; ?></td>
                            <td data-label="Sender"><?php echo htmlspecialchars($completed_row['sender']); ?></td>
                            <td data-label="Address"><?php echo htmlspecialchars($completed_row['address']); ?></td>
                            <td data-label="Requested">
                                <?php echo date('F j, Y', strtotime($completed_row['created_at'])); ?></td>
                            <td data-label="Completed">
                                <?php echo date('F j, Y', strtotime($completed_row['completed_at'])); ?></td>
                        </tr>
                        <?php endwhile; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="8">No completed prayer requests.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#pendingRequestsTable').DataTable();
    $('#completedRequestsTable').DataTable(); // Initialize the completed requests table
});
ob_end_flush(); // Send the buffered output
</script>

<?php include('footeradmin.php'); ?>