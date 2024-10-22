<?php

include 'header.php';       // Common header for the page
include '../includes/database.php'; // Database connection
include 'modalAdmin.php';
include 'announceCreate.php';       // Modal dialogs
include 'eventCreate.php';
include 'footeradmin.php';
?>

<style>
.overflow-cell {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    max-width: 200px;
}


.row {
    margin-top: 1rem;
    margin-bottom: 1rem;
}

.card-text {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.card-text-long {
    display: -webkit-box;
    -webkit-line-clamp: 5;
    /* Number of lines to show */
    -webkit-box-orient: vertical;
    overflow: hidden;
    /* Hide text overflow */
    text-overflow: ellipsis;
    white-space: normal;
    /* Allow wrapping within the defined lines */
}

.card-header .cardCat {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
</style>

<?php
if (isset($_GET['msg'])) {
    echo '
    <div class="alert alert-success  text-light alert-dismissible fade show" role="alert">
        ' . htmlspecialchars($_GET['msg']) . '
        <button type="button" class="btn-close text-light" data-bs-dismiss="alert" aria-label="Close"><i class="material-icons">close </i></button>
    </div>';
}
?>
<?php

// SQL query to count requests of prayer, certificate, baptismal
$total_requests_sql = "
    SELECT COUNT(*) AS total FROM prayers WHERE status='pending'
    UNION ALL
    SELECT COUNT(*) AS total FROM cert_request WHERE status='pending'
    UNION ALL
    SELECT COUNT(*) AS total FROM baptism_schedule WHERE status='pending'
";

$total_requests_result = $conn->query($total_requests_sql);
$total_requests_count = 0; // Default to 0
if ($total_requests_result) {
    // Initialize an array to hold counts
    $total_counts = [];

    // Fetch all counts
    while ($row = $total_requests_result->fetch_assoc()) {
        $total_counts[] = $row['total'];
    }

    // Sum the counts from all tables
    $total_requests_count = array_sum($total_counts);
}

//-----------------------------------------------------------------------

// SQL query to count users
$countSql = "SELECT COUNT(*) AS total FROM users";
$countResult = $conn->query($countSql);

if ($countResult) {
// Fetch the result
$row = $countResult->fetch_assoc();
$totalCount = $row['total'];
} else {
$totalCount = "Error retrieving count: " . $conn->error;
}

//-----------------------------------------------------------------------

// Query to count total events
$sql_count = "SELECT COUNT(*) as total_events FROM events";
$result_count = mysqli_query($conn, $sql_count);

// Check if query was successful
if ($result_count) {
    // Fetch the total events count
    $row_count = mysqli_fetch_assoc($result_count);
    $total_events = $row_count['total_events'];
} else {
    $total_events = 0; // Default to 0 if query fails
}
?>


<!-- Cards -->
<div class="mx-3 mb-4 ">
    <h2>Dashboard</h2>
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 d-flex ">
            <div class="card w-100">
                <!-- Card 1 -->
                <div class="card-header p-3">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-success shadow-dark text-center border-radius-xl position-absolute">
                        <i class="material-icons opacity-10">edit_note</i>
                    </div>
                    <div class="card-text text-end">
                        <p class="text-md mb-0 text-capitalize">Events Created</p>
                        <h4><?= $total_events ?></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 d-flex">
            <div class="card w-100">
                <!-- Card 2 -->
                <div class="card-header p-3">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-info shadow-dark text-center border-radius-xl position-absolute">
                        <i class="material-icons opacity-10">group</i>
                    </div>
                    <div class="card-text text-end ">
                        <p class="text-md mb-0 text-capitalize">Total Users</p>
                        <h4><?php echo htmlspecialchars($totalCount); ?></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 d-flex">
            <div class="card w-100">
                <!-- Card 3 -->
                <div class="card-header p-3">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-dark shadow-success text-center border-radius-xl position-absolute">
                        <i class="material-icons opacity-10">church</i>
                    </div>
                    <div class="card-text text-end">
                        <p class="text-md mb-0 text-capitalize">Ministries</p>
                        <h4>5</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 d-flex">
            <div class="card w-100">
                <!-- Card 4 -->
                <div class="card-header p-3 ">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-warning shadow-dark text-center border-radius-xl position-absolute">
                        <i class="material-icons opacity-10">weekend</i>
                    </div>
                    <div class="card-text text-end ">
                        <p class="text-md mb-0 text-capitalize">Pending Requests</p>
                        <h4><?php echo htmlspecialchars($total_requests_count); ?></h4> <!-- Display the count -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include("../includes/database.php");

// Fetch Quarterly Totals for Income and Expenses
$quarterly_totals_query = "
    SELECT
        QUARTER(date) as quarter,
        YEAR(date) as year,
        SUM(CASE WHEN type = 'Income' THEN amount ELSE 0 END) as total_income,
        SUM(CASE WHEN type = 'Expense' THEN amount ELSE 0 END) as total_expenses
    FROM daily_records
    GROUP BY year, quarter
    ORDER BY year, quarter
";

$quarterly_totals = $conn->query($quarterly_totals_query);

// Initialize chart data arrays
$incomeData = [];
$expensesData = [];
$netIncomeData = [];
$quarters = [];

// Initialize total income and expenses
$totalIncome = 0;
$totalExpenses = 0;

// Initialize arrays for months per quarter
$quarterMonths = [
    1 => "Jan, Feb, Mar",
    2 => "Apr, May, Jun",
    3 => "Jul, Aug, Sep",
    4 => "Oct, Nov, Dec"
];

// Populate chart data
while ($row = $quarterly_totals->fetch_assoc()) {
    $incomeData[] = (float) $row['total_income'];
    $expensesData[] = (float) $row['total_expenses'];

    // Calculate net income for each quarter
    $netIncomeData[] = (float) $row['total_income'] - (float) $row['total_expenses'];

    // Update total income and expenses
    $totalIncome += (float) $row['total_income'];
    $totalExpenses += (float) $row['total_expenses'];

    // Format as "Year Quarter X (Jan, Feb, Mar)" (e.g., "2024 Quarter 1 (Jan, Feb, Mar)")
    $quarters[] = $row['year'] . ' Quarter ' . $row['quarter'] . ' (' . $quarterMonths[$row['quarter']] . ')';
}

// Calculate overall net income
$netIncome = $totalIncome - $totalExpenses;

// Add "Total" as the final data point in the series
$incomeData[] = $totalIncome;
$expensesData[] = $totalExpenses;
$netIncomeData[] = $netIncome;
$quarters[] = "Total"; // Label for the total values
?>

<!-- Chart container -->
<div id="financialChartContainer" class="mx-3" style="height: 500px;"></div>

<!-- Load Highcharts Library -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
// Data from PHP
var incomeData = <?php echo json_encode($incomeData); ?>;
var expensesData = <?php echo json_encode($expensesData); ?>;
var netIncomeData = <?php echo json_encode($netIncomeData); ?>;
var quarters = <?php echo json_encode($quarters); ?>;

// Create the chart
var chart = Highcharts.chart('financialChartContainer', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Quarterly Financial Summary'
    },
    xAxis: {
        categories: quarters
    },
    yAxis: {
        title: {
            text: 'Amount (₱)'
        }
    },
    series: [{
        name: 'Income',
        data: incomeData,
        color: '#28a745',
        dataLabels: {
            enabled: true,
            format: '₱{y:,.0f}'
        }
    }, {
        name: 'Expenses',
        data: expensesData,
        color: '#dc3545',
        dataLabels: {
            enabled: true,
            format: '₱{y:,.0f}'
        }
    }, {
        name: 'Net Income',
        data: netIncomeData,
        color: '#1b98e0',
        dataLabels: {
            enabled: true,
            format: '₱{y:,.0f}',
            style: {
                color: '#000000'
            }
        }
    }],
    tooltip: {
        shared: true,
        pointFormat: '<span style="color:{point.color}">\u25CF</span> {series.name}: <b>₱{point.y:,.0f}</b><br/>',
        valueDecimals: 2
    },
    colors: ['#28a745', '#dc3545', '#1b98e0']
});
</script>



<br>
<!--event -->
<div class="row mb-4 mx-1">
    <div class="col-12 mb-md-0">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row justify-content-between">
                    <div class="col-12 col-md-6">
                        <h2>Events</h2>
                    </div>
                    <div
                        class="col-12 col-md-6 d-flex justify-content-md-end justify-content-center align-items-center mt-2 mt-md-0">
                        <!-- Create modal trigger -->
                        <button type="button" class="btn btn-info me-2" data-bs-toggle="modal"
                            data-bs-target="#insertEventModal">
                            <i class="material-icons opacity-10">add</i> Create
                        </button>
                        <a href="events.php"
                            class="btn btn-outline-info d-flex justify-content-center align-items-center"
                            aria-expanded="false" aria-controls="moreContent">
                            View all <i class="material-icons opacity-10">trending_flat</i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body bg-light px-3 pb-2">
                <div class="table-responsive">
                    <table class="table  table-bordered text-dark ">
                        <thead class="table-dark">
                            <tr class="fs-5">
                                <th>Title</th>
                                <th>Description</th>
                                <th>Time</th>
                                <th>Date</th>
                                <th>Location</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // limit fetch 6
                            $sql = "SELECT * FROM events ORDER BY date DESC LIMIT 9";
                            $result = mysqli_query($conn, $sql);

                            if ($result && mysqli_num_rows($result) > 0)
                                //display event loop
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $eventId = htmlspecialchars($row['id']);

                                    // Format date and time
                                    $date = new DateTime($row['date']);
                                    $formattedDate = $date->format('l, M j, Y'); // month, day, year

                                    $time = new DateTime($row['time']);
                                    $formattedTime = $time->format('g:i A');
                                    ?>
                            <tr class="fs-5">
                                <td><?php echo htmlspecialchars($row['title']); ?></td>
                                <td class="overflow-cell"><?php echo htmlspecialchars($row['description']); ?></td>
                                <td><?php echo htmlspecialchars($formattedTime); ?></td>
                                <td><?php echo htmlspecialchars($formattedDate); ?></td>
                                <td><?php echo htmlspecialchars($row['location']); ?></td>
                            </tr>
                            <?php
                                }
                            else {
                                echo '<tr><td colspan="6">No Record Found</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<br>
<?php
// Fetch announcements
$announcesql = "SELECT * FROM announcements WHERE DATE(created_at) >= CURDATE() ORDER BY created_at ASC LIMIT 6";
$announceresult = mysqli_query($conn, $announcesql);

if (!$announceresult) {
    echo "Error executing query: " . mysqli_error($conn);
}
?>

<!--  announce section  -->
<div class="container-fluid">
    <div class="row">
        <!-- Announcements Section -->
        <div class="col-12 col-lg-8">
            <div class="card text-bg-secondary">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-12 col-md-7">
                            <h2>Announcements</h2>
                        </div>
                        <div
                            class="col-12 col-md-5 d-flex  justify-content-md-end justify-content-center align-items-center mt-md-0">
                            <!-- Modal trigger -->
                            <button type="button" class="btn btn-info mx-2" data-bs-toggle="modal"
                                data-bs-target="#insertAnnounceModal">
                                <i class="material-icons opacity-10">add</i> Create
                            </button>
                            <a href="announce.php" class="btn btn-outline-info me-4">
                                View all <i class="material-icons opacity-10">trending_flat</i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body fs-4">
                    <div class="row text-dark">
                        <?php if ($announceresult && $announceresult->num_rows > 0) {
                            $cardCounter = 0;
                            echo '<div class="row">'; // Open the first row

                            // Loop through the results
                            while ($row = $announceresult->fetch_assoc()) {
                                $announce_id = htmlspecialchars($row['id']);
                                $ministry = htmlspecialchars($row['ministry_cat']);
                                $description = htmlspecialchars($row['announce_msg']);
                                $posted = new DateTime($row['created_at']);
                                $formattedDate = $posted->format('M j, Y'); // format: July 1, 2021
                                $formattedTime = $posted->format('g:i A'); // format: 4:30 PM

                                // New row after every 3 cards
                                if ($cardCounter > 0 && $cardCounter % 3 == 0) {
                                    echo '</div><div class="row">'; // close and start new
                                }
                        ?>
                        <div class="col-12 col-md-4 mb-4">
                            <div class="card">
                                <div class="card-header text-light bg-dark">
                                    Category: <?php echo $ministry; ?>
                                    <p class="card-text fs-6">
                                        Posted: <?php echo $formattedTime .' '. $formattedDate; ?>
                                    </p>
                                </div>
                                <div class="card-body">
                                    <p class="card-text-long fs-5">
                                        <?php echo $description; ?> <br>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <?php
                                $cardCounter++; // Increment the card counter
                            }

                            echo '</div>'; // Close the last row
                        } else {
                            echo "<p>No Announcement found.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4" id="biblebdaywrap">
            <!-- Birthday Section -->
            <div class="card mb-3">
                <div class="card-header bg-dark text-light text-center fw-bold fs-4">
                    <a>Upcoming Birthday Celebrants</a>
                </div>
                <div class="card-body text-body-tertiary">
                    <?php

                            $bdaysql = "SELECT first_name, last_name, birthday, ministry FROM users WHERE
                                    (MONTH(birthday) = MONTH(CURDATE()) AND DAY(birthday) >= DAY(CURDATE())) OR
                                    (MONTH(birthday) > MONTH(CURDATE()))
                                ORDER BY MONTH(birthday), DAY(birthday)";
                            $bdayresult = $conn->query($bdaysql);

                            if ($bdayresult->num_rows > 0) {
                                // ID to the table for DataTables target
                                echo '<table id="birthdayTable" class="table">';
                                echo '<thead class="text-dark">';
                                echo '<tr>';
                                echo '<th>Name</th>';
                                echo '<th>Date</th>';
                                echo '<th>Ministry</th>';
                                echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';

                                while ($row = $bdayresult->fetch_assoc()) {
                                    $name = htmlspecialchars($row['first_name'] . ' ' . $row['last_name']);
                                    // Format birthday (M = Short month name, j = Day without leading zeros)
                                    $formattedDate = date('M j', strtotime($row['birthday']));
                                    $ministry = htmlspecialchars($row['ministry']); // Ensure ministry is safely displayed

                                    // Display each row with name, date, and ministry
                                    echo '<tr>';
                                    echo '<td class="text-info">' . $name . '</td>';
                                    echo '<td class="text-primary   ">' . $formattedDate . '</td>';
                                    echo '<td class="text-secondary">' . $ministry . '</td>';
                                    echo '</tr>';
                                }

                                echo '</tbody>';
                                echo '</table>';
                            } else {
                                // Show message if no birthdays found
                                echo "<p>No upcoming birthdays found.</p>";
                            }
                            ?>
                </div>
            </div>

            <script>
            $(document).ready(function() {
                // Initialize DataTables for the birthday table
                $('#birthdayTable').DataTable({
                    "paging": true, //  pagination
                    "searching": false, //  searching
                    "ordering": false, //  sorting
                    "info": false, // Disable info display
                    "lengthChange": false, //  "show entries" option
                    "order": [
                        [1, "desc"] // Sort by the second column (date) in descending order
                    ],
                    "pageLength": 10 // entries to show per page
                });
            });
            </script>


        </div>
    </div>
</div>


<br>