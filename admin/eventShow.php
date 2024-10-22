<?php
include('../includes/database.php');
include('modalAdmin.php');

// Fetch all events
$sql = "SELECT * FROM events";
$result = mysqli_query($conn, $sql);
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
                <h2>Events</h2>
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-info btn-lg" data-bs-toggle="modal"
                    data-bs-target="#insertEventModal">
                    <i class="material-icons opacity-10">add</i> Create
                </button>
            </div>
        </div>

        <table id="eventsTable" class="table table-responsive fs-5 text-dark">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date & Time</th>
                    <th>Location</th>
                    <th>Created at</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <?php
                            // Extract and sanitize data
                            $eventId = htmlspecialchars($row['id']);
                            $title = htmlspecialchars($row['title']);
                            $description = htmlspecialchars($row['description']);
                            $location = htmlspecialchars($row['location']);
                            $createdAt = new DateTime($row['created_at']); // Create DateTime object
                            $formattedDate = htmlspecialchars($createdAt->format('M j, Y'));
                            $formattedTime = htmlspecialchars($createdAt->format('g:i A'));
                            $date = new DateTime($row['date']);
                            $time = new DateTime($row['time']);
                            $formattedDateTime = $time->format('g:i A') . ' ' . $date->format('M j, Y');
                            ?>
                <tr>
                    <td data-label="ID"><?php echo $eventId; ?></td>
                    <td data-label="Title"><?php echo $title; ?></td>
                    <td data-label="Description" class="description-cell"><?php echo $description; ?></td>
                    <td data-label="Date & Time">
                        <?php

                            echo $date->format('M j, Y'); // Format the date
                            echo '<br>'; // Line break
                            echo $time->format('g:i A'); // Format the time
                            ?>
                    </td>
                    <td data-label="Location"><?php echo $location; ?></td>
                    <td data-label="Created at">
                        <?php
                        echo $formattedDate . '<br>' . $formattedTime;
                    ?>
                    </td>
                    <td data-label="Actions" class="text-center">
                        <button class="btn btn-outline-danger ms-3" data-bs-toggle="modal"
                            data-bs-target="#deleteEventModal" data-id="<?php echo $eventId; ?>">
                            <i class="material-icons opacity-10">delete</i> Delete
                        </button>
                        <button class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#editEventModal"
                            data-id="<?php echo $eventId; ?>" data-title="<?php echo $title; ?>"
                            data-description="<?php echo $description; ?>"
                            data-time="<?php echo htmlspecialchars($row['time']); ?>"
                            data-date="<?php echo htmlspecialchars($row['date']); ?>"
                            data-location="<?php echo $location; ?>">
                            <i class="material-icons opacity-10">edit</i> Edit
                        </button>

                    </td>
                </tr>
                <?php endwhile; ?>
                <?php else: ?>
                <tr>
                    <td colspan="7">No Record Found</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#eventsTable').DataTable({
        "paging": true, // Enable paging
        "info": true, // Enable info text
        "order": [], // Disable default sorting
        "searching": true, // Enable searching functionality
        "lengthChange": true // Disable page length dropdown
    });

    // Populate the edit modal with the event data
    const editEventModal = document.getElementById('editEventModal');
    editEventModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;
        const eventId = button.getAttribute('data-id');
        const title = button.getAttribute('data-title');
        const description = button.getAttribute('data-description');
        const time = button.getAttribute('data-time');
        const date = button.getAttribute('data-date');
        const location = button.getAttribute('data-location');

        const modalTitle = editEventModal.querySelector('.modal-title');
        const idInput = editEventModal.querySelector('#eventId');
        const titleInput = editEventModal.querySelector('#eventTitle');
        const descriptionInput = editEventModal.querySelector('#eventDescription');
        const timeInput = editEventModal.querySelector('#eventTime');
        const dateInput = editEventModal.querySelector('#eventDate');
        const locationInput = editEventModal.querySelector('#eventLocation');

        modalTitle.textContent = 'Edit Event';
        idInput.value = eventId;
        titleInput.value = title;
        descriptionInput.value = description;
        timeInput.value = time;
        dateInput.value = date;
        locationInput.value = location;
    });

    const deleteEventModal = document.getElementById('deleteEventModal');
    deleteEventModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget; // Button that triggered the modal
        const eventId = button.getAttribute('data-id'); // Extract info from data-* attributes
        const confirmDeleteButton = deleteEventModal.querySelector('#confirmDelete');

        confirmDeleteButton.onclick = function() {
            window.location.href = 'eventDelete.php?id=' + eventId; // Redirect to the delete action
        };
    });
});
</script>