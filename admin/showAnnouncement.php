<?php
include('../includes/database.php');
include('../admin/modals.php');

// Number of items per page
$items_per_page = 10;

// Get the current page number
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the starting item
$start = ($page - 1) * $items_per_page;

// Get the total number of items
$sql_count = "SELECT COUNT(*) AS total FROM announcements";
$result_count = mysqli_query($conn, $sql_count);
$row_count = mysqli_fetch_assoc($result_count);
$total_items = $row_count['total'];

// Calculate the total number of pages
$total_pages = ceil($total_items / $items_per_page);

// Fetch the announcements for the current page
$sql = "SELECT * FROM announcements ORDER BY created_at DESC LIMIT $start, $items_per_page";
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
                <h2>Announcements</h2>
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-info btn-lg" data-bs-toggle="modal"
                    data-bs-target="#insertAnnounceModal">
                    <i class="material-icons opacity-10">add</i> Create
                </button>
            </div>
        </div>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Category</th>
                    <th>Message</th>
                    <th>Time & Date</th>
                    <th>Created At</th>
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
            </div>
            <br>
            <tbody>
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $announce_id = htmlspecialchars($row['id']);
                        $ministry = htmlspecialchars($row['ministry_cat']);
                        $announce_msg = htmlspecialchars($row['announce_msg']);

                        // Format date and time
                        $time_date = new DateTime($row['time_date']);
                        $formatted_time_date = $time_date->format('g:i A d-m-Y');
                        $created = new DateTime($row['created_at']);
                        $posted = $created->format('F j, Y, g:i A');
                ?>
                <tr>
                    <td><?php echo $ministry; ?></td>
                    <td class="description-cell"><?php echo $announce_msg; ?></td>
                    <td><?php echo $formatted_time_date; ?></td>
                    <td><?php echo $posted; ?></td>
                    <td class="text-center">
                        <a href="editAnnouncement.php?id=<?php echo $announce_id; ?>" class="btn btn-outline-info">
                            <i class="material-icons opacity-10">edit</i> Edit
                        </a>
                        <a href="deleteAnnouncement.php?id=<?php echo $announce_id; ?>" class="btn btn-outline-danger"
                            onclick="return confirm('Are you sure you want to delete this announcement?');">
                            Delete<i class="material-icons opacity-10">delete</i>
                        </a>
                    </td>
                </tr>
                <?php
                    }
                } else {
                    echo '<tr><td colspan="5">No Record Found</td></tr>';
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