<?php
include('../includes/database.php');
include('modalAdmin.php');

// Fetch the announcements from the database
$sql = "SELECT * FROM announcements ORDER BY created_at DESC"; // Default sorting by created_at
$result = mysqli_query($conn, $sql);
?>
<style>
.table {
    width: 100%;
    border-collapse: collapse;
}

.table td,
.table th {
    max-width: 600px;
    word-wrap: break-word;
    white-space: normal;
    max-height: 100px;
    overflow-y: auto;
    padding: 8px;
    text-align: left;
}

.description-cell {
    max-width: 200px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .table thead {
        display: none;
    }

    .table tr {
        display: block;
        margin-bottom: 15px;
    }

    .table td {
        display: flex;
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


<div class="container-fluid">
    <div class="jumbotron">
        <div class="row justify-content-between">
            <div class="col-auto">
                <h2>Announcements</h2>
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-info btn-lg" data-bs-toggle="modal"
                    data-bs-target="#insertAnnounceModal">
                    <i class="material-icons opacity-10">add</i> Create
                </button>
            </div>
        </div>

        <table id="announcementsTable" class="table table-responsive fs-5 text-dark">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Message</th>
                    <th>Date & Time</th>
                    <th>Posted Created</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $announce_id = htmlspecialchars($row['id']);
                        $ministry = htmlspecialchars($row['ministry_cat']);
                        $announce_msg = htmlspecialchars($row['announce_msg']);

                        // Format date and time
                        $time_date = new DateTime($row['time_date']);
                        $formatted_time_date = $time_date->format('g:i A M j, Y');
                        $created = new DateTime($row['created_at']);
                        $posted = $created->format('g:i A M j, Y');
                ?>
                <tr>
                    <td data-label="ID"><?php echo $announce_id; ?></td>
                    <td data-label="Category"><?php echo $ministry; ?></td>
                    <td data-label="Message" class="description-cell"><?php echo $announce_msg; ?></td>
                    <td data-label="Time & Date">
                        <?php
                        // Split formatted time and date with <br>
                        $timeDate = new DateTime($row['time_date']);
                        echo htmlspecialchars($timeDate->format('g:i A')) . '<br>' . htmlspecialchars($timeDate->format('M j, Y'));
                            ?>
                    </td>
                    <td data-label="Created At">
                        <?php
                        // Split posted date and time with <br>
                        $created = new DateTime($row['created_at']);
                        echo htmlspecialchars($created->format('g:i A')) . '<br>' . htmlspecialchars($created->format('M j, Y'));
                     ?>
                    </td>
                    <td data-label="Actions" class="text-center justify-content-between">
                        <!-- Delete button -->
                        <button class="btn btn-outline-danger me-3" data-bs-toggle="modal"
                            data-bs-target="#deleteAnnouncementModal" data-id="<?php echo $announce_id; ?>">
                            <i class="material-icons opacity-10">delete</i> Delete
                        </button>
                        <!-- Edit button -->
                        <button class="btn btn-outline-info" data-bs-toggle="modal"
                            data-bs-target="#editAnnouncementModal" data-id="<?php echo $announce_id; ?>"
                            data-category="<?php echo $ministry; ?>" data-message="<?php echo $announce_msg; ?>"
                            data-time="<?php echo $row['time_date']; ?>">
                            <i class="material-icons opacity-10">edit</i> Edit
                        </button>
                    </td>
                </tr>

                <?php
                    }
                } else {
                    echo '<tr><td colspan="6">No Record Found</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- JavaScript to populate modal -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Event listener for the edit button
    const editButtons = document.querySelectorAll(
        '[data-bs-toggle="modal"][data-bs-target="#editAnnouncementModal"]');

    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Get data attributes from the button
            document.getElementById('announcementId').value = this.getAttribute('data-id');
            document.getElementById('category').value = this.getAttribute('data-category');
            document.getElementById('announceMsg').value = this.getAttribute('data-message');
            document.getElementById('time_date').value = this.getAttribute('data-time');
        });
    });

    // Select all delete buttons
    const deleteButtons = document.querySelectorAll(
        '[data-bs-toggle="modal"][data-bs-target="#deleteAnnouncementModal"]');

    // Loop through the buttons
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('deleteAnnouncementId').value = this.getAttribute(
                'data-id');
        });
    });

    // Confirm delete button click
    document.getElementById('confirmDeleteButton').addEventListener('click', function() {
        const id = document.getElementById('deleteAnnouncementId').value;
        window.location.href = 'announceDelete.php?id=' + id;
    });
});
</script>

<script>
$(document).ready(function() {
    $('#announcementsTable').DataTable({
        "paging": true, // paging
        "info": true, // info text
        "order": [], // default sorting
        "searching": true, // searching functionality
        "lengthChange": true // page length dropdown
    });
});
</script>