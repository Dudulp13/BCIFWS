<?php
include('../includes/database.php');
include('modals.php');

// Number of items per page
$items_per_page = 10;

// Get the current page number
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the starting item
$start = ($page - 1) * $items_per_page;

// Get the total number of items
$sql_count = "SELECT COUNT(*) AS total FROM events";
$result_count = mysqli_query($conn, $sql_count);
$row_count = mysqli_fetch_assoc($result_count);
$total_items = $row_count['total'];

// Calculate the total number of pages
$total_pages = ceil($total_items / $items_per_page);

// Fetch the events for the current page
$sql = "SELECT * FROM events ORDER BY date ASC LIMIT $start, $items_per_page";
$result = mysqli_query($conn, $sql);
?>

<style>
.table {
    width: 100%;
}

.table td,
.table th {
    max-width: 100px;
    word-wrap: break-word;
    white-space: normal;
    max-height: 100px;
    overflow-y: auto;
}

.pagination {
    display: flex;
    justify-content: start;
    margin-top: 20px;
}

.pagination a {
    margin: 0 5px;
    text-decoration: none;
    padding: 5px 10px;
    border: 1px solid #ddd;
    color: #007bff;
}

.pagination a.active {
    background-color: #007bff;
    color: white;
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
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Time</th>
                    <th>Date</th>
                    <th>Location</th>
                    <th>Created at</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <div class="pagination">
                <?php
            // Previous page link
            if ($page > 1) {
                echo '<a href="?page=' . ($page - 1) . '"> <i class="material-icons opacity-10">arrow_back</i></a>';
            }

            // Page number links
            for ($i = 1; $i <= $total_pages; $i++) {
                $active = ($i == $page) ? 'active' : '';
                echo '<a href="?page=' . $i . '" class="' . $active . '">' . $i . '</a>';
            }

            // Next page link
            if ($page < $total_pages) {
                echo '<a href="?page=' . ($page + 1) . '"><i class="material-icons opacity-10">arrow_forward</i></a>';
            }
            ?>
            </div><br>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $eventId = htmlspecialchars($row['id']);
                        $date = new DateTime($row['date']);
                        $formattedDate = $date->format('l, F j, Y');
                        $time = new DateTime($row['time']);
                        $formattedTime = $time->format('g:i A');
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td class="description-cell"><?php echo htmlspecialchars($row['description']); ?></td>
                    <td><?php echo htmlspecialchars($formattedTime); ?></td>
                    <td><?php echo htmlspecialchars($formattedDate); ?></td>
                    <td><?php echo htmlspecialchars($row['location']); ?></td>
                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                    <td class="align-items-center justify-content-between">
                        <a href="editEvent.php?id=<?php echo $eventId; ?>" class="btn btn-outline-info"><i
                                class="material-icons opacity-10">edit</i>Edit</a>
                        <a href="deleteEvent.php?id=<?php echo $eventId; ?>" class="btn btn-outline-danger"
                            onclick="return confirm('Are you sure you want to delete this event?');">Delete<i
                                class="material-icons opacity-10">delete</i></a>

                    </td>
                </tr>
                <?php
                    }
                } else {
                    echo '<tr><td colspan="7">No Record Found</td></tr>';
                }
                ?>
            </tbody>
        </table>
        <br>
    </div>
</div>

<?php
mysqli_close($conn);
?>