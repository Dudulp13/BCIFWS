<?php
include("header.php");
include("../includes/database.php");

// Number of results per page
$results_per_page = 8;

// Total number of results
$total_results_sql = "SELECT COUNT(*) FROM users";
$total_results_result = mysqli_query($conn, $total_results_sql);

// Check for SQL errors
if (!$total_results_result) {
    die('Error: ' . mysqli_error($conn));
}

$total_results_row = mysqli_fetch_row($total_results_result);
$total_results = $total_results_row[0];
$total_pages = ceil($total_results / $results_per_page);

// Current page
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($current_page > $total_pages) $current_page = $total_pages;
if ($current_page < 1) $current_page = 1;

// Calculate offset
$offset = ($current_page - 1) * $results_per_page;

// Results for the current page
$sql = "SELECT * FROM users ORDER BY username ASC LIMIT $offset, $results_per_page";
$result = mysqli_query($conn, $sql);

// Check for SQL errors
if (!$result) {
    die('Error: ' . mysqli_error($conn));
}
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
    justify-content: end;
    margin: 20px 0;
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

.pagination a.disabled {
    color: #6c757d;
    pointer-events: none;
    cursor: default;
}
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box clearfix">
                <div class="table-responsive">
                    <table class="table user-list">
                        <thead class="table-info">
                            <tr>
                                <th><span>Name</span></th>
                                <th><span>Role</span></th>
                                <th><span>Ministry</span></th>
                                <th><span>Contact</span></th>
                                <th><span>Email</span></th>
                                <th><span>Created</span></th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['role']); ?></td>
                                <td><?php echo htmlspecialchars($row['ministry']); ?></td>
                                <td><?php echo htmlspecialchars($row['contact']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                                <td>
                                    <div class="btn-group  justify-content-evenly " role="group">
                                        <button type="button" class="btn btn-info"><i
                                                class="material-icons opacity-10">edit</i>Edit</button>
                                        <button type="button" class="btn btn-outline-danger">Delete<i
                                                class="material-icons opacity-10">delete</i></button>

                                    </div>
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
                </div>
            </div>
        </div>
    </div>
    <!-- Pagination controls -->
    <div class="row">
        <div class="col-12">
            <div class="pagination">
                <a href="?page=<?php echo max($current_page - 1, 1); ?>"
                    class="<?php if ($current_page <= 1) echo 'disabled'; ?>">
                    <i class="material-icons opacity-10">arrow_back</i>
                </a>
                <?php for ($page = 1; $page <= $total_pages; $page++): ?>
                <a href="?page=<?php echo $page; ?>" class="<?php if ($page == $current_page) echo 'active'; ?>">
                    <?php echo $page; ?>
                </a>
                <?php endfor; ?>
                <a href="?page=<?php echo min($current_page + 1, $total_pages); ?>"
                    class="<?php if ($current_page >= $total_pages) echo 'disabled'; ?>">
                    <i class="material-icons opacity-10">arrow_forward</i>
                </a>
            </div>
        </div>
    </div>
</div>

<?php
include("../includes/footer.php");
?>