<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="../img/bciflogo.png">
    <title>
        BCIF Web System
    </title>

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
<style>
#user-profile-section {
    padding-left: 1.5rem;

    margin-top: 1.5rem;
    margin-bottom: 1.5rem;

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

<body class="g-sidenav-show  bg-gray-200">
    <!-- sidebar -->
    <aside
        class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0">

                <span class="ms-1 fw-bold text-white">BCIF Santa Barbara</span>
            </a>
        </div>
        <div id="user-profile-section" class="text-white">
            <h6 class="text-light">Profile Information</h6>
            <div class="user-info">
                <div class="user-profile">
                    <span>John Doe</span>
                </div>
                <div class="user-created">
                    <span>Joined: Jan 15, 2021</span>
                </div>
                <div class="user-role">
                    <span>Role: Member</span>
                </div>
            </div>
        </div>



        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" href="../member/memberDash.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Home</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">View
                    </h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="../member/memberAnnounce.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">campaign</i>
                        </div>
                        <span class="nav-link-text ms-1">Announcements</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../member/memberEvent.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text ms-1">Events</span>
                    </a>
                </li>

                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Request
                    </h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="#">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">book</i>
                        </div>
                        <span class="nav-link-text ms-1">Prayer </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="baptismal.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">water_drop</i>
                        </div>
                        <span class="nav-link-text ms-1">Baptismal</span>
                    </a>
                </li>

                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Accessibility
                    </h6>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white " href="../member/memberProfile.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white " href="../member/memberMinistry.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">church</i>
                        </div>
                        <span class="nav-link-text ms-1">Ministry</span>
                    </a>
                </li>
            </ul>

        </div>
        <div class="sidenav-footer position-absolute w-100 bottom-0 ">
            <div class="mx-3">
                <a class="btn btn-outline-secondary mt-4 w-100" href="home.php" type="button">Logout</a>
            </div>
        </div>
    </aside> <!-- sidebar end-->
    <!-- center main wrapper-->
    <main class="main-content position-right max-height-vh-100 h-100 border-radius-lg px-3">
        <!--  navbar-->