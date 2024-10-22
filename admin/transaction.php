<?php
include("../includes/database.php"); // Include database connection
include('header.php'); // Include the header section
include('modalAdmin.php'); // Include modal for adding records

// Function to fetch data from the database
function fetchData($conn, $query) {
    return $conn->query($query);
}

// Queries for fetching data
$dailyRecordsQuery = "SELECT * FROM daily_records";
$incomeSourcesQuery = "
    SELECT category,
           SUM(CASE WHEN QUARTER(date) = 1 THEN amount ELSE 0 END) AS q1,
           SUM(CASE WHEN QUARTER(date) = 2 THEN amount ELSE 0 END) AS q2,
           SUM(CASE WHEN QUARTER(date) = 3 THEN amount ELSE 0 END) AS q3,
           SUM(CASE WHEN QUARTER(date) = 4 THEN amount ELSE 0 END) AS q4,
           SUM(amount) AS total_income
    FROM daily_records
    WHERE type = 'Income'
    GROUP BY category";
$expendituresQuery = "
    SELECT category,
           SUM(CASE WHEN QUARTER(date) = 1 THEN amount ELSE 0 END) AS q1,
           SUM(CASE WHEN QUARTER(date) = 2 THEN amount ELSE 0 END) AS q2,
           SUM(CASE WHEN QUARTER(date) = 3 THEN amount ELSE 0 END) AS q3,
           SUM(CASE WHEN QUARTER(date) = 4 THEN amount ELSE 0 END) AS q4,
           SUM(amount) AS total_expenses
    FROM daily_records
    WHERE type = 'Expense'
    GROUP BY category";

// Monthly income and expense queries
$monthlyIncomeQuery = "
    SELECT YEAR(date) AS year, MONTH(date) AS month, SUM(amount) AS total_income
    FROM daily_records
    WHERE type = 'Income'
    GROUP BY year, month
    ORDER BY year ASC, month ASC"; // Order by year and month in ascending order

$monthlyExpensesQuery = "
    SELECT YEAR(date) AS year, MONTH(date) AS month, SUM(amount) AS total_expenses
    FROM daily_records
    WHERE type = 'Expense'
    GROUP BY year, month
    ORDER BY year ASC, month ASC"; // Order by year and month in ascending order


// New query for budget allocations
$budgetsQuery = "
    SELECT id, year, quarter, allocated_budget, actual_spent, remaining_budget, added_by, created_at
    FROM church_budget
    ORDER BY quarter";

// Fetch data
$dailyRecords = fetchData($conn, $dailyRecordsQuery);
$incomeSources = fetchData($conn, $incomeSourcesQuery);
$expenditures = fetchData($conn, $expendituresQuery);
$monthlyIncome = fetchData($conn, $monthlyIncomeQuery);
$monthlyExpenses = fetchData($conn, $monthlyExpensesQuery);
$budgets = fetchData($conn, $budgetsQuery);

// Process Monthly Data
$monthlyData = [];
while ($row = $monthlyIncome->fetch_assoc()) {
    $monthKey = $row['year'] . '-' . str_pad($row['month'], 2, '0', STR_PAD_LEFT); // Format month with leading zero
    $monthlyData[$monthKey]['total_income'] = $row['total_income'];
}
while ($row = $monthlyExpenses->fetch_assoc()) {
    $monthKey = $row['year'] . '-' . str_pad($row['month'], 2, '0', STR_PAD_LEFT); // Format month with leading zero
    $monthlyData[$monthKey]['total_expenses'] = $row['total_expenses'];
}

// Manual descriptions for Income Sources
$incomeDescriptions = [
    'Offerings' => 'Voluntary gifts beyond tithes, for special causes or needs.',
    'Donations' => 'General contributions, often one-time, to support church projects or charities.',
    'Tithes' => 'A set 10% of income, given as a biblical obligation to support the church.',
];

// Manual descriptions for Expenditures
$expenditureDescriptions = [
    'Building Projects' => 'Construction, renovation, and structural improvements of church buildings.',
    'Mission Programs' => 'Programs supporting outreach, evangelism, and community service initiatives.',
    'Operational Costs' => 'Recurring expenses including electricity, water, internet, and general maintenance.',
    'Worship Activities' => 'Costs for worship equipment, resources, and materials used in services.'
];
?>
<?php
if (isset($_GET['msg'])) {
    echo '
    <div class="alert alert-success  text-light alert-dismissible fade show" role="alert">
        ' . htmlspecialchars($_GET['msg']) . '
        <button type="button" class="btn-close text-light" data-bs-dismiss="alert" aria-label="Close"><i class="material-icons">close </i></button>
    </div>';
}
?>

<!-- Add Record Button and Modal Trigger -->
<div class="row align-items-center mt-5">
    <div class="col">
        <h3>Daily Records</h3>
    </div>
    <div class="col text-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRecordModal">
            Add Daily Record
        </button>
    </div>
</div>
<!-- Daily Records Table -->
<table id="dailyRecordsTable" class="table text-dark">
    <thead class="bg-dark text-white">
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Type</th>
            <th>Category</th>
            <th>Description</th>
            <th>Amount</th>
            <th>Created By</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $dailyRecords->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo date('M j, Y', strtotime($row['date'])); ?></td>
            <td><?php echo $row['type']; ?></td>
            <td><?php echo $row['category']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td>₱<?php echo number_format($row['amount'], 2); ?></td>
            <td><?php echo $row['created_by']; ?></td>
            <td>
                <!-- Edit Button -->
                <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal"
                    data-bs-target="#editRecordModal" data-id="<?php echo $row['id']; ?>"
                    data-type="<?php echo $row['type']; ?>" data-category="<?php echo $row['category']; ?>"
                    data-description="<?php echo $row['description']; ?>" data-amount="<?php echo $row['amount']; ?>">
                    Edit
                </button>
                <!-- Delete Button -->
                <a href="delete_record.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-danger btn-sm"
                    onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<!-- Monthly Summary Table -->
<h3 class="mt-5">Monthly Summary</h3>
<table id="monthlySummaryTable" class="table text-dark">
    <thead class="bg-dark text-light">
        <tr>
            <th>Month</th>
            <th>Total Income</th>
            <th>Total Expenses</th>
            <th>Net Income</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $totalIncome = $totalExpenses = 0;

        foreach ($monthlyData as $month => $data) {
            $totalIncomeMonth = $data['total_income'] ?? 0;
            $totalExpensesMonth = $data['total_expenses'] ?? 0;
            $netIncome = $totalIncomeMonth - $totalExpensesMonth;

            // Convert month key to date format
            [$year, $monthNumber] = explode('-', $month);
            $monthName = DateTime::createFromFormat('!m', $monthNumber)->format('F');

            echo "<tr>";
            echo "<td>$monthName $year</td>";
            echo "<td>₱" . number_format($totalIncomeMonth, 2) . "</td>";
            echo "<td>₱" . number_format($totalExpensesMonth, 2) . "</td>";
            echo "<td>₱" . number_format($netIncome, 2) . "</td>";
            echo "</tr>";

            // Accumulate totals
            $totalIncome += $totalIncomeMonth;
            $totalExpenses += $totalExpensesMonth;
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td><strong>Total</strong></td>
            <td><strong>₱<?php echo number_format($totalIncome, 2); ?></strong></td>
            <td><strong>₱<?php echo number_format($totalExpenses, 2); ?></strong></td>
            <td><strong>₱<?php echo number_format($totalIncome - $totalExpenses, 2); ?></strong></td>
        </tr>
    </tfoot>
</table>

<!-- Income Sources Table -->
<h3 class="mb-4">Income Sources</h3>
<table id="incomeSourcesTable" class="table text-dark">
    <thead class="bg-dark text-light">
        <tr>
            <th>Category</th>
            <th>Description</th>
            <th>Q1</th>
            <th>Q2</th>
            <th>Q3</th>
            <th>Q4</th>
            <th>Total Income</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $incomeSources->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['category']; ?></td>
            <td><?php echo $incomeDescriptions[$row['category']] ?? 'No description available'; ?></td>
            <td>₱<?php echo number_format($row['q1'], 2); ?></td>
            <td>₱<?php echo number_format($row['q2'], 2); ?></td>
            <td>₱<?php echo number_format($row['q3'], 2); ?></td>
            <td>₱<?php echo number_format($row['q4'], 2); ?></td>
            <td>₱<?php echo number_format($row['total_income'], 2); ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<!-- Expenditures Table -->
<h3 class="mb-4">Expenditures</h3>
<table id="expendituresTable" class="table text-dark">
    <thead class="bg-dark text-light">
        <tr>
            <th>Category</th>
            <th>Description</th>
            <th>Q1</th>
            <th>Q2</th>
            <th>Q3</th>
            <th>Q4</th>
            <th>Total Expenses</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $expenditures->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['category']; ?></td>
            <td><?php echo $expenditureDescriptions[$row['category']] ?? 'No description available'; ?></td>
            <td>₱<?php echo number_format($row['q1'], 2); ?></td>
            <td>₱<?php echo number_format($row['q2'], 2); ?></td>
            <td>₱<?php echo number_format($row['q3'], 2); ?></td>
            <td>₱<?php echo number_format($row['q4'], 2); ?></td>
            <td>₱<?php echo number_format($row['total_expenses'], 2); ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<br>
<!-- Add Budget Button and Modal Trigger -->
<div class="row align-items-center mt-5">
    <div class="col">
        <h3>Budget Allocations</h3>
    </div>
    <div class="col text-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBudgetModal">
            Add Budget
        </button>
    </div>
</div>

<!-- Budgets Table -->
<table id="budgetsTable" class="table text-dark">
    <thead class="bg-dark text-light">
        <tr>
            <th>Year</th>
            <th>Quarter</th>
            <th>Allocated Budget</th>
            <th>Actual Spent</th>
            <th>Remaining Budget</th>
            <th>Added By</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $budgets->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['year']; ?></td>
            <td><?php echo $row['quarter']; ?></td>
            <td>₱<?php echo number_format($row['allocated_budget'], 2); ?></td>
            <td>₱<?php echo number_format($row['actual_spent'], 2); ?></td>
            <td>₱<?php echo number_format($row['allocated_budget'] - $row['actual_spent'], 2); ?></td>
            <td></td>
            <td><?php echo date('M j, Y', strtotime($row['created_at'])); ?></td>
            <td>
                <button type="button" class="btn btn-outline-info btn-sm editBudgetBtn" data-bs-toggle="modal"
                    data-id="<?php echo $row['id']; ?>" data-quarter="<?php echo htmlspecialchars($row['quarter']); ?>"
                    data-allocated="<?php echo htmlspecialchars($row['allocated_budget']); ?>"
                    data-spent="<?php echo htmlspecialchars($row['actual_spent']); ?>"
                    data-year="<?php echo htmlspecialchars($row['year']); ?>" data-bs-target="#editBudgetModal">
                    Edit
                </button>
                <a href="delete_budget.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-danger btn-sm"
                    onclick="return confirm('Are you sure you want to delete this budget?');">Delete</a>
            </td>

        </tr>
        <?php endwhile; ?>
    </tbody>
</table>


<!-- Add Budget Modal -->
<div class="modal fade" id="addBudgetModal" tabindex="-1" aria-labelledby="addBudgetModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBudgetModalLabel">Add Budget</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="add_budget.php" method="POST">
                    <div class="mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input type="number" class="form-control" name="year" required>
                    </div>
                    <div class="mb-3">
                        <label for="quarter" class="form-label">Quarter</label>
                        <select class="form-select" name="quarter" required>
                            <option value="Q1">Q1 (Jan, Feb, Mar)</option>
                            <option value="Q2">Q2 (Apr, May, Jun)</option>
                            <option value="Q3">Q3 (Jul, Aug, Sep)</option>
                            <option value="Q4">Q4 (Oct, Nov, Dec)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="allocated_budget" class="form-label">Allocated Budget</label>
                        <input type="number" class="form-control" name="allocated_budget" required>
                    </div>
                    <div class="mb-3">
                        <label for="actual_spent" class="form-label">Actual Spent</label>
                        <input type="number" class="form-control" name="actual_spent" required>
                    </div>
                    <input type="hidden" name="added_by" value="">
                    <button type="submit" class="btn btn-primary">Add Budget</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Budget Modal -->
<div class="modal fade" id="editBudgetModal" tabindex="-1" aria-labelledby="editBudgetModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBudgetModalLabel">Edit Budget</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="edit_budget.php" method="POST">
                    <input type="hidden" name="id" id="editBudgetId">
                    <div class="mb-3">
                        <label for="editYear" class="form-label">Year</label>
                        <input type="number" class="form-control" id="editYear" name="year" required>
                    </div>
                    <div class="mb-3">
                        <label for="editQuarter" class="form-label">Quarter</label>
                        <select class="form-select" id="editQuarter" name="quarter" required>
                            <option value="Q1">Q1 (Jan, Feb, Mar)</option>
                            <option value="Q2">Q2 (Apr, May, Jun)</option>
                            <option value="Q3">Q3 (Jul, Aug, Sep)</option>
                            <option value="Q4">Q4 (Oct, Nov, Dec)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editAllocatedBudget" class="form-label">Allocated Budget</label>
                        <input type="number" class="form-control" id="editAllocatedBudget" name="allocated_budget"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="editActualSpent" class="form-label">Actual Spent</label>
                        <input type="number" class="form-control" id="editActualSpent" name="actual_spent" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Budget</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Initialize DataTables for all tables -->
<script>
$(document).ready(function() {
    $('#dailyRecordsTable').DataTable();
    $(document).ready(function() {
        $('#monthlySummaryTable').DataTable({
            order: [
                [0, 'asc']
            ]
        });
    });

    $('#incomeSourcesTable').DataTable();
    $('#expendituresTable').DataTable();
    $('#budgetsTable').DataTable();
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.btn-outline-info'); // Select edit buttons
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Get data attributes from the button
            const id = this.getAttribute('data-id');
            const type = this.getAttribute('data-type');
            const category = this.getAttribute('data-category');
            const description = this.getAttribute('data-description');
            const amount = this.getAttribute('data-amount');

            // Populate the modal form fields
            document.getElementById('editRecordId').value = id;
            document.getElementById('editType').value = type; // Set selected type
            document.getElementById('editCategory').value = category; // Set selected category
            document.getElementById('editDescription').value = description;
            document.getElementById('editAmount').value = amount;
        });
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get all edit buttons
    const editBudgetButtons = document.querySelectorAll('.editBudgetBtn');

    // Loop through each button and attach a click event listener
    editBudgetButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Get data attributes from the button
            const id = this.getAttribute('data-id');
            const year = this.getAttribute('data-year');
            const quarter = this.getAttribute('data-quarter');
            const allocated = this.getAttribute('data-allocated');
            const spent = this.getAttribute('data-spent');

            // Populate the modal input fields
            document.getElementById('editBudgetId').value = id;
            document.getElementById('editYear').value = year;
            document.getElementById('editQuarter').value = quarter;
            document.getElementById('editAllocatedBudget').value = allocated;
            document.getElementById('editActualSpent').value = spent;
        });
    });
});
</script>

<script>
// Function to toggle category options based on selected type (for add modal)
function toggleAddCategoryOptions() {
    const typeSelect = document.getElementById('type');
    const selectedType = typeSelect.value;
    const incomeCategories = document.getElementById('incomeCategories');
    const expenseCategories = document.getElementById('expenseCategories');

    if (selectedType === 'Income') {
        incomeCategories.style.display = 'block';
        expenseCategories.style.display = 'none';
    } else {
        incomeCategories.style.display = 'none';
        expenseCategories.style.display = 'block';
    }
}

// Function to toggle category options based on selected type (for edit modal)
function toggleEditCategoryOptions() {
    const typeSelect = document.getElementById('editType');
    const selectedType = typeSelect.value;
    const editIncomeCategories = document.getElementById('editIncomeCategories');
    const editExpenseCategories = document.getElementById('editExpenseCategories');

    if (selectedType === 'Income') {
        editIncomeCategories.style.display = 'block';
        editExpenseCategories.style.display = 'none';
    } else {
        editIncomeCategories.style.display = 'none';
        editExpenseCategories.style.display = 'block';
    }
}

// Initial load for modals
document.addEventListener('DOMContentLoaded', function() {
    // Set initial visibility for add modal
    toggleAddCategoryOptions();

    // Add event listener to the add type select dropdown
    document.getElementById('type').addEventListener('change', toggleAddCategoryOptions);

    // Set initial visibility for edit modal when opened
    const editButtons = document.querySelectorAll('.btn-outline-info');
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const type = this.getAttribute('data-type');

            // Populate the edit modal fields
            document.getElementById('editType').value = type;

            // Show appropriate categories based on the selected type
            toggleEditCategoryOptions();
        });
    });
});
</script>

<?php include('footeradmin.php'); // Include the footer section ?>