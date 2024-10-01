<?php include("../includes/database.php");
include('header.php')?>

<style>
.budget-table,
.expenditure-table,
.summary-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.budget-table th,
.budget-table td,
.expenditure-table th,
.expenditure-table td,
.summary-table th,
.summary-table td {
    border: 1px solid #dee2e6;
    padding: 10px;
    text-align: left;
}

.budget-table th,
.expenditure-table th,
.summary-table th {
    background-color: #f8f9fa;
    text-align: center;
}

.summary-row,
.total-row {
    font-weight: bold;
}
</style>

<!-- Generate Financial Report Section -->
<div class="col-6 mb-4">
    <div class="card">
        <div class="card-header">
            <h5><i class="bi bi-file-earmark-text"></i> Export section: Generate Financial Report</h5>
            <small>modal then pop up fields onclick lang, follow bcif print format / download </small>
        </div>
        <div class="card-body">
            <form action="generate_report.php" method="POST">
                <div class="mb-3">
                    <label for="startDate" class="form-label">Start Date:</label>
                    <input type="date" class="form-control" id="startDate" name="startDate" required>
                </div>
                <div class="mb-3">
                    <label for="endDate" class="form-label">End Date:</label>
                    <input type="date" class="form-control" id="endDate" name="endDate" required>
                </div>
                <button type="submit" class="btn btn-outline-info"><i class="material-icons">print</i>Print</button>
                <button type="submit" class="btn btn-outline-info"><i
                        class="material-icons">download</i>Download</button>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid mt-5">
    <div class="report-header">
        <h3>Financial Statements</h3>
    </div>

    <!-- Quarterly Budget Section -->
    <div class="container mt-5">
        <h4 class="mb-4">Quarterly Budget</h4>
        <div class="table-responsive">
            <table class="table budget-table">
                <thead>
                    <tr>
                        <th>Quarter</th>
                        <th>Allocated Budget (₱)</th>
                        <th>Actual Spent (₱)</th>
                        <th>Remaining Budget (₱)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">Quarter 1</td>
                        <td>₱500,000</td>
                        <td>₱450,000</td>
                        <td>₱50,000</td>
                    </tr>
                    <tr>
                        <td class="text-center">Quarter 2</td>
                        <td>₱600,000</td>
                        <td>₱500,000</td>
                        <td>₱100,000</td>
                    </tr>
                    <tr>
                        <td class="text-center">Quarter 3</td>
                        <td>₱700,000</td>
                        <td>₱650,000</td>
                        <td>₱50,000</td>
                    </tr>
                    <tr>
                        <td class="text-center">Quarter 4</td>
                        <td>₱550,000</td>
                        <td>₱400,000</td>
                        <td>₱150,000</td>
                    </tr>
                    <tr>
                        <td class="text-center font-weight-bold">Total</td>
                        <td class="font-weight-bold">₱2,350,000</td>
                        <td class="font-weight-bold">₱2,000,000</td>
                        <td class="font-weight-bold">₱350,000</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quarterly Income section -->
    <div class="container mt-5">
        <h4 class="text-start">Income Source Table</h4>
        <table class="table table-bordered mt-4">
            <thead class="thead-light">
                <tr>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Quarter 1</th>
                    <th>Quarter 2</th>
                    <th>Quarter 3</th>
                    <th>Quarter 4</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Data for the income sources
                $income_sources = [
                    ['category' => 'Donations', 'description' => 'Anonymous donations', 'quarter1' => 250000, 'quarter2' => 300000, 'quarter3' => 350000, 'quarter4' => 400000],
                    ['category' => 'Fundraisers', 'description' => 'Merchandise sales', 'quarter1' => 300000, 'quarter2' => 400000, 'quarter3' => 500000, 'quarter4' => 600000],
                    ['category' => 'Tithes and Offerings', 'description' => 'Special offerings for events', 'quarter1' => 300000, 'quarter2' => 350000, 'quarter3' => 400000, 'quarter4' => 450000]
                ];

                // Unique categories to avoid duplicates
                $unique_categories = [];

                // Displaying each income source
                foreach ($income_sources as $source) {
                    $key = "{$source['category']}_{$source['description']}";

                    if (!isset($unique_categories[$key])) {
                        $unique_categories[$key] = $source;
                        echo "<tr>
                                <td>{$source['category']}</td>
                                <td>{$source['description']}</td>
                                <td>₱".number_format($source['quarter1'])."</td>
                                <td>₱".number_format($source['quarter2'])."</td>
                                <td>₱".number_format($source['quarter3'])."</td>
                                <td>₱".number_format($source['quarter4'])."</td>
                              </tr>";
                    }
                }
                ?>
                <tr class="font-weight-bold">
                    <td>Total Income</td>
                    <td>
                        <hr>
                    </td>
                    <td>₱<?php echo number_format(array_sum(array_column($income_sources, 'quarter1'))); ?></td>
                    <td>₱<?php echo number_format(array_sum(array_column($income_sources, 'quarter2'))); ?></td>
                    <td>₱<?php echo number_format(array_sum(array_column($income_sources, 'quarter3'))); ?></td>
                    <td>₱<?php echo number_format(array_sum(array_column($income_sources, 'quarter4'))); ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Expenditure Categories Section -->
    <div class="container mt-5">
        <h4 class="mb-4">Expenditure Categories</h4>
        <div class="table-responsive">
            <table class="table expenditure-table">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Quarter 1 (₱)</th>
                        <th>Quarter 2 (₱)</th>
                        <th>Quarter 3 (₱)</th>
                        <th>Quarter 4 (₱)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Data for expenditure categories
                    $expenditures = [
                        ['category' => 'Salaries and Wages', 'quarter1' => 75000, 'quarter2' => 80000, 'quarter3' => 90000, 'quarter4' => 95000],
                        ['category' => 'Utilities', 'quarter1' => 10000, 'quarter2' => 12000, 'quarter3' => 13000, 'quarter4' => 15000],
                        ['category' => 'Maintenance', 'quarter1' => 15000, 'quarter2' => 20000, 'quarter3' => 20000, 'quarter4' => 25000],
                        ['category' => 'Events and Outreach', 'quarter1' => 20000, 'quarter2' => 25000, 'quarter3' => 30000, 'quarter4' => 35000]
                    ];

                    // Displaying each expenditure
                    foreach ($expenditures as $expense) {
                        echo "<tr>
                                <td>{$expense['category']}</td>
                                <td>₱".number_format($expense['quarter1'])."</td>
                                <td>₱".number_format($expense['quarter2'])."</td>
                                <td>₱".number_format($expense['quarter3'])."</td>
                                <td>₱".number_format($expense['quarter4'])."</td>
                              </tr>";
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td class="total-row">Total Expenditure</td>
                        <td class="total-row">
                            ₱<?php echo number_format(array_sum(array_column($expenditures, 'quarter1'))); ?></td>
                        <td class="total-row">
                            ₱<?php echo number_format(array_sum(array_column($expenditures, 'quarter2'))); ?></td>
                        <td class="total-row">
                            ₱<?php echo number_format(array_sum(array_column($expenditures, 'quarter3'))); ?></td>
                        <td class="total-row">
                            ₱<?php echo number_format(array_sum(array_column($expenditures, 'quarter4'))); ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>


</div>

<?php include('../includes/footer.php'); ?>