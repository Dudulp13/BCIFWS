<?php
include('../includes/database.php');
include('memberHeader.php');

// Number of items per page
$items_per_page = 6;

// Get the current page number
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $items_per_page;

// Search and Filter options
$search = isset($_GET['search']) ? $_GET['search'] : '';
$filter_location = isset($_GET['filter_location']) ? $_GET['filter_location'] : '';
$filter_date = isset($_GET['filter_date']) ? $_GET['filter_date'] : '';

// Filter SQL
$sql_filter = " WHERE 1=1 ";
if ($search) {
    $sql_filter .= " AND (title LIKE '%" . mysqli_real_escape_string($conn, $search) . "%' OR description LIKE '%" . mysqli_real_escape_string($conn, $search) . "%')";
}
if ($filter_location) {
    $sql_filter .= " AND location = '" . mysqli_real_escape_string($conn, $filter_location) . "'";
}
if ($filter_date) {
    $sql_filter .= " AND date = '" . mysqli_real_escape_string($conn, $filter_date) . "'";
}

// Total items count
$sql_count = "SELECT COUNT(*) AS total FROM events $sql_filter";
$result_count = mysqli_query($conn, $sql_count);
$row_count = mysqli_fetch_assoc($result_count);
$total_items = $row_count['total'];
$total_pages = ceil($total_items / $items_per_page);

// Fetch the events for the current page
$sql = "SELECT * FROM events $sql_filter ORDER BY date ASC LIMIT $start, $items_per_page";
$result = mysqli_query($conn, $sql);
?>

<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Events</h2>
            <small>same issue wid anncment</small>
            <form class="form-inline" method="GET">
                <input type="text" name="search" class="form-control mr-2" placeholder="Search events..."
                    value="<?php echo $search; ?>">
                <input type="date" name="filter_date" class="form-control mr-2" value="<?php echo $filter_date; ?>">
                <select name="filter_location" class="form-control mr-2">
                    <option value="">Filter by Location</option>
                    <option value="Location1" <?php echo $filter_location == 'Location1' ? 'selected' : ''; ?>>Location1
                    </option>
                    <option value="Location2" <?php echo $filter_location == 'Location2' ? 'selected' : ''; ?>>Location2
                    </option>
                    <!-- Add more locations as needed -->
                </select>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>

        <div class="card-body">
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
            <div class="row">
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <?php
                        $eventId = htmlspecialchars($row['id']);
                        $date = new DateTime($row['date']);
                        $formattedDate = $date->format('l, F j, Y');
                        $time = new DateTime($row['time']);
                        $formattedTime = $time->format('g:i A');
                        ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($row['description']); ?></p>
                            <p><strong>Location:</strong> <?php echo htmlspecialchars($row['location']); ?></p>
                            <p><strong>Date:</strong> <?php echo $formattedDate; ?></p>
                            <p><strong>Time:</strong> <?php echo $formattedTime; ?></p>
                            <a href="joinEvent.php?id=<?php echo $eventId; ?>"
                                class="btn btn-success float-end">Join</a>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            <?php else: ?>
            <div class="alert alert-warning">No events found.</div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <div class="card-footer">
            <nav>
                <ul class="pagination justify-content-center">
                    <!-- Left Arrow for Previous Page -->
                    <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link"
                            href="?page=<?php echo ($page - 1); ?>&search=<?php echo $search; ?>&filter_location=<?php echo $filter_location; ?>&filter_date=<?php echo $filter_date; ?>">
                            <i class="material-icons">arrow_back</i>
                        </a>
                    </li>
                    <?php endif; ?>

                    <!-- Page Numbers -->
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                        <a class="page-link"
                            href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>&filter_location=<?php echo $filter_location; ?>&filter_date=<?php echo $filter_date; ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                    <?php endfor; ?>

                    <!-- Right Arrow for Next Page -->
                    <?php if ($page < $total_pages): ?>
                    <li class="page-item">
                        <a class="page-link"
                            href="?page=<?php echo ($page + 1); ?>&search=<?php echo $search; ?>&filter_location=<?php echo $filter_location; ?>&filter_date=<?php echo $filter_date; ?>">
                            <i class="material-icons">arrow_forward</i>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>

            </nav>
        </div>
    </div>
</div>

<?php include('../includes/footer.php');
mysqli_close($conn);
?>