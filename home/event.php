<?php
include('navbarTop.php');
include('../includes/modals.php');
include('../includes/database.php'); // Database connection

// Fetch all events from the database
$sql = "SELECT * FROM events WHERE date >= NOW() ORDER BY date";
$result = mysqli_query($conn, $sql);

// Check for errors
if (!$result) {
    echo "<p class='bcif-error-message'>Error fetching events: " . mysqli_error($conn) . "</p>";
    exit();
}

// Fetch events
$events = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Function to format event date and time
function formatEventDateTime($date, $time) {
    if (empty($date) || empty($time)) {
        return "Date or time not provided.";
    }
    $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', "$date $time");

    // If the date and time format is valid, format them separately with <br>
    if ($dateTime) {
        $formattedDate = $dateTime->format('M j, Y'); // Format as Jan, 1, 2024
        $formattedTime = $dateTime->format('g:i A'); // Format time as 12-hour AM/PM
        return $formattedDate . '<br>' . $formattedTime; // Add <br> between date and time
    } else {
        return "Invalid date or time format.";
    }
}

// Function to render event description
function renderDescription($description, $eventId) {
    $shortDescription = htmlspecialchars(substr($description, 0, 100)); // Show first 100 chars
    $fullDescription = nl2br(htmlspecialchars($description)); // Full description

    return "
        <div class='description-column' id='desc-{$eventId}'>
            <span class='short-description'>{$shortDescription}</span>
            <span class='full-description' style='display:none;'>{$fullDescription}</span>
        </div>
    ";
}
?>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
<style>
.bcif-header-title {
    color: #3A4040;
    font-size: 2rem;
}

.bcif-header-subtitle {
    color: #3A4040;
    font-size: 1.5rem;
}

/* Styling for the description column */
.description-column {
    word-wrap: break-word;
    white-space: normal;
    min-width: 200px;
}

.table th,
.table td {
    color: #3A4040;
}

.table th {
    background-color: #e8f1f2;
    color: #1b98e0;
}

/* Styling for the actions column buttons */
.actions-column {
    display: flex;
    gap: 5px;
}

@media (max-width: 768px) {
    .bcif-header-title {
        font-size: 1.8rem;
    }

    .bcif-header-subtitle {
        font-size: 1.25rem;
    }

    .description-column {
        min-width: 150px;
    }

    .actions-column {
        flex-direction: column;
    }
}

@media (max-width: 576px) {
    .bcif-header-title {
        font-size: 1.5rem;
    }

    .bcif-header-subtitle {
        font-size: 1rem;
    }
}
</style>

<div class="container-fluid my-3" id="bcif-events-container">
    <div class="row text-center mb-1">
        <div class="col-12">
            <h1 class="bcif-header-title">Church Events</h1>
            <p class="bcif-header-subtitle">Stay updated with our upcoming events</p>
        </div>
    </div>
    <br>

    <div class="table-responsive">
        <table id="eventsTable" class="table ">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Location</th>
                    <th class="description-column">Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($events) > 0): ?>
                <?php foreach ($events as $event): ?>
                <tr>
                    <td><?php echo htmlspecialchars($event['title']); ?></td>
                    <td><?php echo formatEventDateTime($event['date'], $event['time']); ?></td>
                    <td><?php echo htmlspecialchars($event['location']); ?></td>
                    <td><?php echo renderDescription($event['description'], $event['id']); ?></td>
                    <td>
                        <div class="actions-column">
                            <button class="btn btn-outline-secondary view-details"
                                data-event-id="<?php echo $event['id']; ?>">
                                See more </button>
                            <button class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#registerEvent"
                                data-event-title="<?= htmlspecialchars($event['title']) ?>">
                                Register
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No events available.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<!-- Include DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


<script>
$(document).ready(function() {
    $('#eventsTable').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "order": [
            [1, 'asc']
        ],
        "pageLength": 10,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        "columnDefs": [{
                "width": "100px",
                "targets": 4
            }, // Set width for actions column
            {
                "width": "200px",
                "targets": 2
            } // Set width for location column
        ],
        "autoWidth": false // Disable auto width calculation by DataTables
    });

    // Toggle full/short description when "View Details" is clicked
    $('#eventsTable').on('click', '.view-details', function() {
        var eventId = $(this).data('event-id');
        var fullDesc = $('#desc-' + eventId).find('.full-description');
        var shortDesc = $('#desc-' + eventId).find('.short-description');

        if (fullDesc.is(':visible')) {
            fullDesc.hide();
            shortDesc.show();
            $(this).text('see more');
        } else {
            fullDesc.show();
            shortDesc.hide();
            $(this).text('see less');
        }
    });
});
</script>

<?php
include('footers.php');
?>