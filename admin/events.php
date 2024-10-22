<?php
include('header.php');
include('eventCreate.php');

// Check if status and message are set in the URL
if (isset($_GET['status']) && isset($_GET['message'])) {
    $status = $_GET['status'];
    $message = $_GET['message'];

    // Determine alert type based on status
    if ($status === 'success') {
        echo '<div class="alert alert-success text-light fs-6  text-danger alert-dismissible fade show" role="alert">
               <strong> ' . htmlspecialchars($message) . '</strong>
                 <button type="button" class="btn-close text-light" data-bs-dismiss="alert" aria-label="Close"><i class="material-icons">close </i></button>
              </div>';
    } elseif ($status === 'error') {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                ' . htmlspecialchars($message) . '
                <button type="button" class="btn-close text-light" data-bs-dismiss="alert" aria-label="Close"><i class="material-icons">close </i></button>
              </div>';
    }
}
?>

<br>

<?php
include 'eventShow.php';
include 'footeradmin.php';
?>