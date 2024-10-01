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

</head>

<body class="g-sidenav-show  bg-gray-200">
    <!-- sidebar -->
    <aside
        class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0">
                <span class="ms-1 font-weight-bold text-white">BCIF Admin Dashboard</span>
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white " href="../admin/index.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Create
                    </h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../admin/announcement.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">campaign</i>
                        </div>
                        <span class="nav-link-text ms-1">Announcement</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../admin/event.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text ms-1">Event</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Finance
                    </h6>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white " href="../admin/transaction.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">Transactions</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="../admin/finance/generate.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">ios_share</i>
                        </div>
                        <span class="nav-link-text ms-1">Export</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Forms
                    </h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">book</i>
                        </div>
                        <span class="nav-link-text ms-1">Prayer Request</span>
                        <span class="badge bg-warning ms-2">New</span> <!-- Badge for Prayer Request -->
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">water_drop</i>
                        </div>
                        <span class="nav-link-text ms-1">Baptismal</span>
                        <span class="badge bg-success ms-2">5</span> <!-- Badge for Baptismal -->
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">wc</i>
                        </div>
                        <span class="nav-link-text ms-1">Wedding</span>
                        <span class="badge bg-danger ms-2">3</span> <!-- Badge for Wedding -->
                    </a>
                </li>

                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Management
                    </h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="../admin/membersTest.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">groups</i>
                        </div>
                        <span class="nav-link-text ms-1">Members</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="../admin/management/ministry.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">church</i>
                        </div>
                        <span class="nav-link-text ms-1">Ministry</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="#">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">backup</i>
                        </div>
                        <span class="nav-link-text ms-1">Back up</span>
                    </a>
                </li>
            </ul>

        </div>
        <div class="sidenav-footer position-absolute w-100 bottom-0 ">
            <div class="mx-3">
                <a class="btn btn-outline-secondary mt-4 w-100" href="../visitor/homeV.php" type="button">Logout</a>
            </div>
        </div>
    </aside> <!-- sidebar end-->

    <!-- center main wrapper-->
    <main class="main-content position-right max-height-vh-100 h-100 border-radius-lg px-3">
        <!-- Navbar top container -->
        <div class="container-fluid mt-4">
            <nav class="navbar navbar-expand-sm  mx-2 py-3">
                <div class="container-fluid">
                    <!-- Navbar Toggler (for mobile view) -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="material-icons opacity-10">menu</i>
                    </button>

                    <!-- Navbar Content -->
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <!-- Search Form -->
                        <form class="col-11 d-flex me-auto bg-outline-dark" role="search">
                            <input class="form-control me-2 " type="search" placeholder="Looking for something?"
                                aria-label="Search">
                            <button class="btn btn-dark my-2" type="submit">
                                Search
                            </button>
                        </form>

                        <!-- Navbar Items -->
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="../img/profile.jpg" width="40" height="40" class="rounded-circle"
                                        alt="Profile Picture">
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">Dashboard</a></li>
                                    <li><a class="dropdown-item" href="#">Edit Profile</a></li>
                                    <li><a class="dropdown-item" href="#">Log Out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <br>



            <!-- End Navbar -->

            <script src="../assets/bootstrap.bundle.min.js"></script>