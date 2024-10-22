<?php
include("../includes/database.php");

// Fetch data again to show in the print report
// This can be optimized by passing necessary data through the session or other methods
$daily_records_query = "SELECT * FROM daily_records";
$daily_records = $conn->query($daily_records_query);

$weekly_totals_query_display = "SELECT * FROM weekly_totals";
$weekly_totals = $conn->query($weekly_totals_query_display);

$quarterly_totals_query = "SELECT * FROM quarterly_totals";
$quarterly_totals = $conn->query($quarterly_totals_query);

$income_sources_query = "
    SELECT category,
           description,
           SUM(CASE WHEN QUARTER(date) = 1 THEN amount ELSE 0 END) AS q1,
           SUM(CASE WHEN QUARTER(date) = 2 THEN amount ELSE 0 END) AS q2,
           SUM(CASE WHEN QUARTER(date) = 3 THEN amount ELSE 0 END) AS q3,
           SUM(CASE WHEN QUARTER(date) = 4 THEN amount ELSE 0 END) AS q4,
           SUM(amount) AS total_income
    FROM daily_records
    WHERE type = 'Income'
    GROUP BY category";
$income_sources = $conn->query($income_sources_query);

$expenditures_query = "
    SELECT category, description,
    SUM(CASE WHEN QUARTER(date) = 1 THEN amount ELSE 0 END) AS q1,
    SUM(CASE WHEN QUARTER(date) = 2 THEN amount ELSE 0 END) AS q2,
    SUM(CASE WHEN QUARTER(date) = 3 THEN amount ELSE 0 END) AS q3,
    SUM(CASE WHEN QUARTER(date) = 4 THEN amount ELSE 0 END) AS q4,
    SUM(amount) AS total_incomes
    FROM daily_records
    WHERE type = 'Expense'
    GROUP BY category";
$expenditures = $conn->query($expenditures_query);

?>

<style>
@media print {

    .no-print {
        display: none;
    }

    /* Style the printed report */
    body {
        font-family: Arial, sans-serif;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }
}
</style>
</head>

<body>

    <div class="container">
        <h2>Financial Statements</h2>

        <!-- Daily Records Table -->
        <h3>Daily Records</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Created By</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $daily_records->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo date('M j, Y', strtotime($row['date'])); ?></td>
                    <td><?php echo $row['type']; ?></td>
                    <td><?php echo $row['category']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td>₱<?php echo number_format($row['amount'], 2); ?></td>
                    <td><?php echo $row['created_by']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Weekly Totals Table -->
        <h3>Weekly Summary</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Week Start Date</th>
                    <th>Week End Date</th>
                    <th>Total Income</th>
                    <th>Total Expenses</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $weekly_totals->fetch_assoc()):
                    $week_start = $row['week_start'];
                    $week_end = date('Y-m-d', strtotime($week_start . ' + 6 days'));
                ?>
                <tr>
                    <td><?php echo date('M j, Y', strtotime($week_start)); ?></td>
                    <td><?php echo date('M j, Y', strtotime($week_end)); ?></td>
                    <td>₱<?php echo number_format($row['total_income'], 2); ?></td>
                    <td>₱<?php echo number_format($row['total_expenses'], 2); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Quarterly Totals Table -->
        <h3>Quarterly Summary</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Quarter</th>
                    <th>Total Income</th>
                    <th>Total Expenses</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $quarterly_totals->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['year']; ?></td>
                    <td><?php echo $row['quarter']; ?></td>
                    <td>₱<?php echo number_format($row['total_daily_income'], 2); ?></td>
                    <td>₱<?php echo number_format($row['total_daily_expenses'], 2); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Income Source Section -->
        <h4>Income Source</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Quarter 1</th>
                    <th>Quarter 2</th>
                    <th>Quarter 3</th>
                    <th>Quarter 4</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $income_sources->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['category']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td>₱<?php echo number_format($row['q1'], 2); ?></td>
                    <td>₱<?php echo number_format($row['q2'], 2); ?></td>
                    <td>₱<?php echo number_format($row['q3'], 2); ?></td>
                    <td>₱<?php echo number_format($row['q4'], 2); ?></td>
                    <td>₱<?php echo number_format($row['total_income'], 2); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Expenditures Section -->
        <h4>Expenditures</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Quarter 1</th>
                    <th>Quarter 2</th>
                    <th>Quarter 3</th>
                    <th>Quarter 4</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $expenditures->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['category']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td>₱<?php echo number_format($row['q1'], 2); ?></td>
                    <td>₱<?php echo number_format($row['q2'], 2); ?></td>
                    <td>₱<?php echo number_format($row['q3'], 2); ?></td>
                    <td>₱<?php echo number_format($row['q4'], 2); ?></td>
                    <td>₱<?php echo number_format($row['total_incomes'], 2); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

    </div>

    <script>
    window.onload = function() {
        window.print();
    };
    </script>

</body>

</html>