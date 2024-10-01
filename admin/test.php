<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Button Example</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h1>Your Content Here</h1>
        <!-- Your content to print -->
        <div id="printable-area">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Header 1</th>
                        <th>Header 2</th>
                        <th>Header 3</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Row 1, Cell 1</td>
                        <td>Row 1, Cell 2</td>
                        <td>Row 1, Cell 3</td>
                    </tr>
                    <tr>
                        <td>Row 2, Cell 1</td>
                        <td>Row 2, Cell 2</td>
                        <td>Row 2, Cell 3</td>
                    </tr>
                    <!-- More rows as needed -->
                </tbody>
            </table>
        </div>
        <!-- Print Button -->
        <button class="btn btn-primary" onclick="printContent('printable-area')">Print</button>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
    function printContent(id) {
        var content = document.getElementById(id).innerHTML;
        var originalContent = document.body.innerHTML;

        document.body.innerHTML = content;
        window.print();
        document.body.innerHTML = originalContent;
    }
    </script>
</body>

</html>