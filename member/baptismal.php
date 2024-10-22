<?php
include("memberHeader.php");
include("../includes/database.php");
?>

<!-- Baptism Scheduling Form -->
<div class="container mt-5">
    <h3>Schedule a Baptism</h3>
    <form method="POST">
        <input type="hidden" name="request_type" value="baptism_schedule">

        <div class="mb-3">
            <label for="baptism_full_name" class="form-label">Full Name of Baptism Candidate</label>
            <input type="text" name="baptism_full_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="birth_date" class="form-label">Birth Date</label>
            <input type="date" name="birth_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="father_name" class="form-label">Father's Name</label>
            <input type="text" name="father_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="mother_maiden_name" class="form-label">Mother's Maiden Name</label>
            <input type="text" name="mother_maiden_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="preferred_baptism_date" class="form-label">Preferred Baptism Date</label>
            <input type="date" name="preferred_baptism_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="contact_info" class="form-label">Contact Information</label>
            <input type="text" name="contact_info" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="remarks" class="form-label">Remarks</label>
            <textarea name="remarks" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Baptism Schedule</button>
    </form>
</div>

<!-- Baptismal Certificate Request Form -->
<div class="container mt-5">
    <h3>Request Baptismal Certificate</h3>
    <form class="form" method="POST">
        <input type="hidden" name="request_type" value="certificate_request">

        <div class="mb-3">
            <label for="full_name" class="form-label">Full Name on Baptismal Record</label>
            <input type="text" name="full_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="requester_name" class="form-label">Requester's Name</label>
            <input type="text" name="requester_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="requester_contact" class="form-label">Contact Information</label>
            <input type="text" name="requester_contact" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="request_purpose" class="form-label">Purpose of Request</label>
            <textarea name="request_purpose" class="form-control" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="remarks" class="form-label">Remarks (Optional)</label>
            <textarea name="remarks" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Certificate Request</button>
    </form>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check which form was submitted
    if (isset($_POST['request_type'])) {
        if ($_POST['request_type'] === 'certificate_request') {
            // Handle Baptismal Certificate Request Form Submission
            $full_name = $_POST['full_name'];
            $requester_name = $_POST['requester_name'];
            $requester_contact = $_POST['requester_contact'];
            $request_purpose = $_POST['request_purpose'];
            $remarks = $_POST['remarks'];

            // Insert into baptism_request table using prepared statements
            $stmt = $conn->prepare("INSERT INTO baptism_request (full_name, requester_name, requester_contact, request_purpose, remarks) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $full_name, $requester_name, $requester_contact, $request_purpose, $remarks);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success mt-3'>Request submitted successfully.</div>";
            } else {
                echo "<div class='alert alert-danger mt-3'>Error: " . $stmt->error . "</div>";
            }
            $stmt->close();
        } elseif ($_POST['request_type'] === 'baptism_schedule') {
            // Handle Baptism Scheduling Form Submission
            $baptism_full_name = $_POST['baptism_full_name'];
            $birth_date = $_POST['birth_date'];
            $father_name = $_POST['father_name'];
            $mother_maiden_name = $_POST['mother_maiden_name'];
            $preferred_baptism_date = $_POST['preferred_baptism_date'];
            $contact_info = $_POST['contact_info'];
            $remarks = $_POST['remarks'];

            // Insert into baptism_schedule table using prepared statements
            $stmt = $conn->prepare("INSERT INTO baptism_schedule (baptism_full_name, birth_date, father_name, mother_maiden_name, preferred_baptism_date, contact_info, remarks) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $baptism_full_name, $birth_date, $father_name, $mother_maiden_name, $preferred_baptism_date, $contact_info, $remarks);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success mt-3'>Baptism scheduled successfully.</div>";
            } else {
                echo "<div class='alert alert-danger mt-3'>Error: " . $stmt->error . "</div>";
            }
            $stmt->close();
        }
    }
}

include("../admin/footeradmin.php");
$conn->close();
?>