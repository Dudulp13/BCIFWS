<?php
include('../includes/database.php');
include('memberHeader.php');

// Number of items per page
$items_per_page = 10;

// Get current page number
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $items_per_page;

// Search and Filter options
$search = isset($_GET['search']) ? $_GET['search'] : '';
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';

// Filter SQL
$sql_filter = " WHERE 1=1 ";
if ($search) {
    $sql_filter .= " AND (announce_msg LIKE '%" . mysqli_real_escape_string($conn, $search) . "%')";
}
if ($filter) {
    $sql_filter .= " AND ministry_cat = '" . mysqli_real_escape_string($conn, $filter) . "'";
}

// Total items count
$sql_count = "SELECT COUNT(*) AS total FROM announcements $sql_filter";
$result_count = mysqli_query($conn, $sql_count);
$row_count = mysqli_fetch_assoc($result_count);
$total_items = $row_count['total'];
$total_pages = ceil($total_items / $items_per_page);

// Fetch announcements
$sql = "SELECT * FROM announcements $sql_filter ORDER BY created_at DESC LIMIT $start, $items_per_page";
$result = mysqli_query($conn, $sql);
?>

<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Announcements</h2>
            <small>fix this bug, wala ga reset. proper naming para 1 target lang sa style</small>
            <form class="form-inline" method="GET">
                <select name="filter" class="form-control mr-2">
                    <option value="">select category</option>
                    <option value="Youth" <?php echo $filter == 'Youth' ? 'selected' : ''; ?>>Youth</option>
                    <option value="General" <?php echo $filter == 'General' ? 'selected' : ''; ?>>General</option>

                </select>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>

        <div class="card-body">
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
            <div class="row">
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['ministry_cat']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($row['announce_msg']); ?></p>
                            <p><small class="text-muted">Posted:
                                    <?php echo (new DateTime($row['created_at']))->format('F j, Y, g:i A'); ?></small>
                            </p>
                            <p><small class="text-muted">Time:
                                    <?php echo (new DateTime($row['time_date']))->format('g:i A d-m-Y'); ?></small></p>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            <?php else: ?>
            <div class="alert alert-warning">No announcements found.</div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <div class="card-footer">
            <nav>
                <ul class="pagination justify-content-center">
                    <?php if ($page > 1): ?>
                    <li class="page-item"><a class="page-link"
                            href="?page=1&search=<?php echo $search; ?>&filter=<?php echo $filter; ?>">First</a></li>
                    <li class="page-item"><a class="page-link"
                            href="?page=<?php echo ($page - 1); ?>&search=<?php echo $search; ?>&filter=<?php echo $filter; ?>">Previous</a>
                    </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                        <a class="page-link"
                            href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>&filter=<?php echo $filter; ?>"><?php echo $i; ?></a>
                    </li>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages): ?>
                    <li class="page-item"><a class="page-link"
                            href="?page=<?php echo ($page + 1); ?>&search=<?php echo $search; ?>&filter=<?php echo $filter; ?>">Next</a>
                    </li>
                    <li class="page-item"><a class="page-link"
                            href="?page=<?php echo $total_pages; ?>&search=<?php echo $search; ?>&filter=<?php echo $filter; ?>">Last</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>
<?php
mysqli_close($conn);
?>