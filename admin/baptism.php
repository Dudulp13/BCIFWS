<?php
session_start(); // Ensure the session is started before any session usage
include('header.php');
include('../includes/database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Approve button pressed for Baptismal
    if (isset($_POST['approve_baptism'])) {
        $baptism_id = $_POST['approve_baptism'];

        // Update the status to "completed" in the database
        $sql_approve_baptism = "UPDATE baptism_schedule SET status = 'completed' WHERE baptism_id = ?";

        if ($stmt = $conn->prepare($sql_approve_baptism)) {
            $stmt->bind_param("i", $baptism_id);
            $stmt->execute();
            $stmt->close();
            $_SESSION['success_message'] = "<strong>Baptism Request #$baptism_id</strong> has been approved.";

        }
    } elseif (isset($_POST['decline_baptism'])) {
        // Decline button pressed for Baptismal
        $baptism_id = $_POST['decline_baptism'];

        // Update the status to "declined" in the database
        $sql_decline_baptism = "UPDATE baptism_schedule SET status = 'declined' WHERE baptism_id = ?";

        if ($stmt = $conn->prepare($sql_decline_baptism)) {
            $stmt->bind_param("i", $baptism_id);
            $stmt->execute();
            $stmt->close();
            $_SESSION['success_message'] = "<strong>Baptism Request #$baptism_id</strong> has been declined.";
        }
    }

    // Approve or decline for certificate requests
    if (isset($_POST['approve_request'])) {
        $request_id = $_POST['approve_request'];

        // Update the status to "completed" in the database
        $sql_approve = "UPDATE cert_request SET status = 'completed' WHERE request_id = ?";

        if ($stmt = $conn->prepare($sql_approve)) {
            $stmt->bind_param("i", $request_id);
            $stmt->execute();
            $stmt->close();
            $_SESSION['success_message'] = "<strong>Certificate request #$request_id</strong> has been approved.";
        }
    } elseif (isset($_POST['decline_request'])) {
        $request_id = $_POST['decline_request'];

        // Update the status to "declined" in the database
        $sql_decline = "UPDATE cert_request SET status = 'declined' WHERE request_id = ?";

        if ($stmt = $conn->prepare($sql_decline)) {
            $stmt->bind_param("i", $request_id);
            $stmt->execute();
            $stmt->close();
            $_SESSION['success_message'] = "<strong>Certificate request #$request_id</strong> has been declined.";
        }
    }
}

// Fetch pending, completed, and declined requests
$sql_pending_baptism = "SELECT * FROM baptism_schedule WHERE status = 'pending' LIMIT 6";
$result_baptism = $conn->query($sql_pending_baptism);

$sql_completed_baptism = "SELECT * FROM baptism_schedule WHERE status = 'completed'";
$result_completed_baptism = $conn->query($sql_completed_baptism);

$sql_declined_baptism = "SELECT * FROM baptism_schedule WHERE status = 'declined'";
$result_declined_baptism = $conn->query($sql_declined_baptism);

$sql_pending = "SELECT * FROM cert_request WHERE status = 'pending' LIMIT 9";
$result_certificate = $conn->query($sql_pending);

$sql_completed = "SELECT * FROM cert_request WHERE status = 'completed'";
$result_completed_certificate = $conn->query($sql_completed);

$sql_declined = "SELECT * FROM cert_request WHERE status = 'declined'";
$result_declined_certificate = $conn->query($sql_declined);
?>

<!-- Display Success Message -->
<?php if (isset($_SESSION['success_message'])): ?>
<div class="alert mx-auto my-2 w-30 text-start fixed-top text-light fs-5 alert-success mt-3 alert-dismissible fade show"
    role="alert">
    <?php echo $_SESSION['success_message']; ?>
    <button type="button" class="btn-close text-light" data-bs-dismiss="alert" aria-label="Close"> <i
            class="material-icons">close</i></button>
</div>
<?php unset($_SESSION['success_message']); // Clear the message after displaying ?>
<?php endif; ?>

<br>

<!-- Baptism Schedule Section -->
<div class="container-fluid">
    <h2 class="bg-dark fw-bold text-light text-center py-2">Baptismal Request</h2>
    <div class="row">

        <!-- Left Side: Pending Baptismal Requests (8 columns) -->
        <div class="col-12 col-lg-8">
            <div class="card text-dark bg-light mb-3">
                <div class="card-header text-dark fw-bold fs-5 py-4">
                    Pending Schedules
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php
                        if ($result_baptism && $result_baptism->num_rows > 0) {
                            $cardCounter = 0;
                            echo '<div class="row">'; // Open the first row

                            // Loop through each pending baptismal request record
                            while ($row_baptism = $result_baptism->fetch_assoc()) {
                                $baptism_id = htmlspecialchars($row_baptism['baptism_id']);
                                $baptism_full_name = htmlspecialchars($row_baptism['baptism_full_name']);
                                $birth_date = new DateTime($row_baptism['birth_date']);
                                $formatted_birth_date = $birth_date->format('M j, Y');
                                $preferred_baptism_date = new DateTime($row_baptism['preferred_baptism_date']);
                                $formatted_baptism_date = $preferred_baptism_date->format('M j, Y');
                                $created_at = new DateTime($row_baptism['created_at']);
                                $formatted_created_at = $created_at->format('M j, Y');
                                $father_name = htmlspecialchars($row_baptism['father_name']);
                                $mother_maiden_name = htmlspecialchars($row_baptism['mother_maiden_name']);
                                $contact_info = htmlspecialchars($row_baptism['contact_info']);
                                $remarks = htmlspecialchars($row_baptism['remarks']);

                                // Start a new row after every 3 cards
                                if ($cardCounter > 0 && $cardCounter % 3 == 0) {
                                    echo '</div><div class="row">';
                                }
                        ?>

                        <!-- Card for each baptismal request -->
                        <div class="col-12 col-md-4 mb-4">
                            <div class="card ">
                                <div class="card-header fs-5 text-light bg-dark">
                                    # <?php echo $baptism_id . ' - ' . $baptism_full_name; ?>
                                    <small class="fs-6 d-block">Requested: <?php echo $formatted_created_at; ?></small>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                        <strong>Full Name:</strong> <?php echo $baptism_full_name; ?> <br>
                                        <strong>Birth Date:</strong> <?php echo $formatted_birth_date; ?> <br>
                                        <strong>Father's Name:</strong> <?php echo $father_name; ?> <br>
                                        <strong>Mother's Name:</strong> <?php echo $mother_maiden_name; ?>
                                        <br>
                                        <strong>Baptism Date:</strong>
                                        <?php echo $formatted_baptism_date; ?> <br>
                                        <strong>Contact Info:</strong> <?php echo $contact_info; ?> <br>
                                        <strong>Remarks:</strong> <?php echo $remarks; ?> <br>
                                    </p>
                                    <form method="post" action="">
                                        <input type="hidden" name="baptism_id" value="<?php echo $baptism_id; ?>">

                                        <div class="d-flex justify-content-between">
                                            <!-- Decline Button -->
                                            <button type="submit" name="decline_baptism"
                                                value="<?php echo $baptism_id; ?>"
                                                class="btn btn-outline-danger me-2">Decline</button>

                                            <!-- Approve Button -->
                                            <button type="submit" name="approve_baptism"
                                                value="<?php echo $baptism_id; ?>" class="btn btn-info">Approve</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                        <?php
                                $cardCounter++;
                            }

                            echo '</div>'; // Close the last row
                        } else {
                            echo "<p>No pending baptismal requests found.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Completed and Declined Baptismal Requests (4 columns) -->
        <div class="col-12 col-lg-4">
            <!-- Function to display baptism requests -->
            <?php
            function displayBaptismTable($title, $result, $bgColor, $status)
            {
                echo '<div class="card mb-3">';
                echo '<div class="card-header ' . $bgColor . ' text-light text-center fw-bold fs-5">' . $title . '</div>';
                echo '<div class="card-body">';
                if ($result && $result->num_rows > 0) {
                    echo '<table class="table data-table">';
                    echo '<thead><tr><th>ID</th><th>Name</th><th>Baptism Date</th></tr></thead><tbody>';

                    while ($row_baptism = $result->fetch_assoc()) {
                        $formatted_baptism_date = new DateTime($row_baptism['preferred_baptism_date']);
                        $formatted_baptism_date_str = $formatted_baptism_date->format('M j, Y');
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row_baptism['baptism_id']) . '</td>';
                        echo '<td class="text-info">' . htmlspecialchars($row_baptism['baptism_full_name']) . '</td>';
                        echo '<td>' . $formatted_baptism_date_str . '</td>';
                        echo '</tr>';
                    }

                    echo '</tbody></table>';
                } else {
                    echo "<p>No $status baptismal requests found.</p>";
                }
                echo '</div></div>';
            }

            // Display completed and declined baptismal requests
            displayBaptismTable('Approved Baptism Schedule', $result_completed_baptism, 'bg-success', 'completed');
            displayBaptismTable('Declined Baptism Schedule', $result_declined_baptism, 'bg-danger', 'declined');
            ?>
        </div>
    </div>
</div>

<br>
<hr class="py-4">
<!-- Certificate Request Section -->
<div class="container-fluid">
    <h2 class="bg-dark fw-bold text-light text-center py-2">Certificate Request</h2>
    <div class="row">
        <!-- Left Side: Certificate Requests (8 columns) -->
        <div class="col-12 col-lg-8">
            <div class="card text-bg-secondary">
                <div class="card-header text-dark fw-bold fs-5 py-4">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            Pending Requests
                        </div>
                        <div class="col-6 text-end">
                            <button class="btn btn-primary me-4">Print <i class="material-icons">print</i></button>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <div class="row text-dark">
                        <?php
                        if ($result_certificate && $result_certificate->num_rows > 0) {
                            $cardCounter = 0;
                            echo '<div class="row">'; // Open the first row

                            // Loop through each certificate request record
                            while ($row_certificate = $result_certificate->fetch_assoc()) {
                                $cert_id = htmlspecialchars($row_certificate['request_id']);
                                $requester_name = htmlspecialchars($row_certificate['requester_name']);
                                $request_date = new DateTime($row_certificate['request_date']);
                                $formatted_request_date = $request_date->format('M j, Y');

                                // Start new row after every 3 cards
                                if ($cardCounter > 0 && $cardCounter % 3 == 0) {
                                    echo '</div><div class="row">'; // Close and start new row
                                }
                        ?>

                        <!-- Card for each certificate request -->
                        <div class="col-12 col-md-4 mb-4">
                            <div class="card consistent-height">
                                <div class="card-header fs-5 text-light bg-dark">
                                    # <?php echo $cert_id . ' - ' . $requester_name; ?>

                                    <small class="fs-6 d-block">Requested:
                                        <?php echo $formatted_request_date; ?></small>
                                </div>
                                <div class="card-body fs-4">
                                    <p class="card-text">
                                        <strong>Certificate Name:</strong>
                                        <?php echo htmlspecialchars($row_certificate['requester_name']); ?> <br>
                                        <strong>Contact:</strong>
                                        <?php echo htmlspecialchars($row_certificate['requester_contact']); ?> <br>
                                        <strong>Purpose:</strong>
                                        <?php echo htmlspecialchars($row_certificate['request_purpose']); ?> <br>
                                        <strong>Remarks:</strong>
                                        <?php echo htmlspecialchars($row_certificate['remarks']); ?> <br>

                                    </p>
                                    <form method="post" action="" class="d-flex justify-content-between">
                                        <input type="hidden" name="request_id" value="<?php echo $cert_id; ?>">

                                        <!-- Decline Button -->
                                        <button type="submit" name="decline_request" value="<?php echo $cert_id; ?>"
                                            class="btn btn-outline-danger me-2">
                                            Decline
                                        </button>

                                        <!-- Approve Button -->
                                        <button type="submit" name="approve_request" value="<?php echo $cert_id; ?>"
                                            class="btn btn-info">
                                            Approve
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <?php
                                $cardCounter++; // Increment card counter
                            }

                            echo '</div>'; // Close the last row
                        } else {
                            echo "<p>No pending certificate requests found.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Completed Certificate Requests (4 columns) -->
        <div class="col-12 col-lg-4">
            <div class="card mb-3">
                <div class="card-header bg-success text-light text-center fw-bold fs-5">
                    <a>Approved Certificate Requests</a>
                </div>
                <div class="card-body text-body-tertiary">
                    <?php
                if ($result_completed_certificate && $result_completed_certificate->num_rows > 0) {
                    echo '<table id="completedCertificateTable" class="table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>ID</th>';
                    echo '<th>Name</th>';
                    echo '<th>Purpose</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    while ($row_completed_certificate = $result_completed_certificate->fetch_assoc()) {
                        $request_id_completed = htmlspecialchars($row_completed_certificate['request_id']);
                        $name_completed_certificate = htmlspecialchars($row_completed_certificate['requester_name']);
                        $purpose_completed_certificate = htmlspecialchars($row_completed_certificate['request_purpose']);

                        echo '<tr>';
                        echo '<td>' . $request_id_completed . '</td>';
                        echo '<td class="text-info">' . $name_completed_certificate . '</td>';
                        echo '<td>' . $purpose_completed_certificate . '</td>';
                        echo '</tr>';
                    }

                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo "<p>No completed certificate requests found.</p>";
                }
                ?>
                </div>
            </div>
            <br>
            <!-- Right Side: Declined Certificate Requests (4 columns) -->
            <div class="card mb-3">
                <div class="card-header bg-danger text-light text-center fw-bold fs-5">
                    <a>Declined Certificate Requests</a>
                </div>
                <div class="card-body text-body-tertiary">
                    <?php
                if ($result_declined_certificate && $result_declined_certificate->num_rows > 0) {
                    echo '<table id="declinedCertificateTable" class="table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>ID</th>';
                    echo '<th>Name</th>';
                    echo '<th>Purpose</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    while ($row_declined_certificate = $result_declined_certificate->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row_declined_certificate['request_id']) . '</td>';
                        echo '<td class="text-info">' . htmlspecialchars($row_declined_certificate['requester_name']) . '</td>';
                        echo '<td>' . htmlspecialchars($row_declined_certificate['request_purpose']) . '</td>';
                        echo '</tr>';
                    }

                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo "<p>No declined certificate requests found.</p>";
                }
                ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Reusable function to initialize DataTable with common options
    function initializeDataTable(tableId) {
        $(tableId).DataTable({
            "paging": true, // Enable pagination
            "searching": true, // Enable searching
            "ordering": true, // Enable sorting
            "info": true, // Show info
            "lengthChange": false, // Allow changing number of entries
            "pageLength": 6 // Set entries to show per page
        });
    }

    // Initialize DataTable for individual tables
    initializeDataTable('#completedCertificateTable');
    initializeDataTable('#declinedCertificateTable');

    // Initialize DataTable for all tables with the class 'data-table'
    $('.data-table').each(function() {
        $(this).DataTable({
            "paging": true, // Enable pagination
            "searching": true, // Enable searching
            "ordering": true, // Enable sorting
            "info": true, // Show info
            "lengthChange": false, // Allow changing number of entries
            "pageLength": 6 // Set entries to show per page
        });
    });
});
</script>

<?php include('footeradmin.php'); ?>