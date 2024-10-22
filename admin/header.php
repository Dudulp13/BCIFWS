<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="../img/bciflogo.png">
    <title>BCIF Web System</title>

    <!-- Google Fonts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link id="pagestyle" href="../assets/dashboard.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

</head>
<style>
#user-profile-section {
    padding-left: 1.5rem;
    margin-top: 1.5rem;
    margin-bottom: 1rem;

}

#user-profile-section h6 {
    font-size: 0.75rem;

    text-transform: uppercase;
    font-weight: bold;
    opacity: 0.8;
    margin-bottom: 1rem;
}

.user-info {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;

}

.user-info span {
    font-size: 0.875rem;

}
</style>

<body class="g-sidenav-show bg-gray-200">
    <!-- Sidebar -->
    <aside
        class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark"
        id="sidenav-main">
        <div class="sidenav-header text-center">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0">
                <span class="ms-1 font-weight-bold fs-5 text-white">BCIF Santa Barbara</span>
            </a>
        </div>
        <div id="user-profile-section" class="text-white">
            <h6 class="text-light">Profile Information</h6>
            <div class="user-info">
                <div class="user-profile">
                    <span>John Doe</span>
                </div>
                <div class="user-role">
                    <span>Role: Member</span>
                </div>
            </div>
        </div>

        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" href="index.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Create</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="announce.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">campaign</i>
                        </div>
                        <span class="nav-link-text ms-1">Announcement</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="events.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text ms-1">Event</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Finance</h6>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="transaction.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">Records</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="download_dailyrecord.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">download</i>
                        </div>
                        <span class="nav-link-text ms-1">Download</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="print_report.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">print</i>
                        </div>
                        <span class="nav-link-text ms-1">Print</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">View</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="prayers.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">book</i>
                        </div>
                        <span class="nav-link-text ms-1">Prayer Request</span>
                        <!-- Badge for prayer request -->
                        <span id="prayerRequestBadge" class="badge bg-warning ms-2">0</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="baptism.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">water_drop</i>
                        </div>
                        <span class="nav-link-text ms-1">Baptismal</span>
                        <span id="baptismBadge" class="badge bg-warning ms-2">0</span> <!-- Badge for Baptismal -->
                    </a>
                </li>

                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Management</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="users.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">groups</i>
                        </div>
                        <span class="nav-link-text ms-1">Users</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="ministry.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">church</i>
                        </div>
                        <span class="nav-link-text ms-1">Ministry</span>
                    </a>
                </li>
            </ul>
            <hr class="horizontal light mt-0 mb-2">
            <div class="sidenav-footer mx-3">
                <a class="btn btn-outline-secondary mt-2 w-100" href="../home/home.php" type="button">Logout</a>
            </div>
        </div>

    </aside> <!-- sidebar end-->

    <!-- Center main wrapper-->
    <main class="main-content position-right max-height-vh-100 h-100 border-radius-lg px-3">
        <!-- Navbar top container -->
        <nav>
            <div class="container-fluid d-flex mt-3 justify-content-end">
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown"
                        aria-expanded="false" style="border: none; background: transparent; padding: 0;">
                        <img src="../img/raymond.png" alt="Profile" class="rounded-circle"
                            style="width: 40px; height: 40px;">
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="index.php">Dashboard</a></li>
                        <li><a class="dropdown-item" href="edit_profile.php">Edit Profile</a></li>
                        <li><a class="dropdown-item" href="../home/home.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <script>
        function fetchPrayerRequestsCount() {
            fetch('prayer_notif.php')
                .then(response => response.json())
                .then(data => {
                    const prayerRequestBadge = document.getElementById('prayerRequestBadge');
                    // Update badge with the new count
                    if (data.count !== undefined) {
                        prayerRequestBadge.innerText = data.count; // Update the badge text with count
                    } else {
                        console.error('Error fetching prayer requests count:', data.error);
                    }
                })
                .catch(error => console.error('Error fetching prayer requests count:', error));
        }

        // Fetch prayer requests count every 5 seconds
        setInterval(fetchPrayerRequestsCount, 5000);

        // Initial fetch to set the count on page load
        fetchPrayerRequestsCount();

        function fetchBaptismRequestsCount() {
            fetch('baptismal_notif.php') // Call the PHP script
                .then(response => response.json())
                .then(data => {
                    const baptismBadge = document.querySelector('#baptismBadge'); // Badge element
                    if (data.total_pending !== undefined) {
                        baptismBadge.innerText = data.total_pending; // Update the badge text
                    } else {
                        console.error('Error fetching pending baptism count:', data.error);
                    }
                })
                .catch(error => console.error('Error fetching pending baptism count:', error));
        }

        // Fetch the pending count every 5 seconds
        setInterval(fetchBaptismRequestsCount, 5000);

        // Initial fetch to set the count on page load
        fetchBaptismRequestsCount();
        </script>