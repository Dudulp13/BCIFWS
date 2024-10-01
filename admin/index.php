<?php

include_once 'header.php';       // Common header for the page
include_once '../includes/database.php'; // Database connection
include_once 'modals.php';
include 'createAnnouncement.php';       // Modal dialogs
include 'createEvent.php';
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

?>
<!-- Cards -->
<div class="container-fluid mr-2 mb-4 ">
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 d-flex ">
            <div class="card w-100">
                <!-- Card 1 -->
                <div class="card-header p-3">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-success shadow-dark text-center border-radius-xl position-absolute">
                        <i class="material-icons opacity-10">weekend</i>
                    </div>
                    <div class="card-text text-end">
                        <p class="text-md mb-0 text-capitalize">Monthly Donations</p>
                        <h4>₱1234</h4>
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
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <div class="card-text text-end ">
                        <p class="text-md mb-0 text-capitalize">Total Members</p>
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
                        class="icon icon-lg icon-shape bg-gradient-warning shadow-success text-center border-radius-xl position-absolute">
                        <i class="material-icons opacity-10">church</i>
                    </div>
                    <div class="card-text text-end">
                        <p class="text-md mb-0 text-capitalize">Ministry</p>
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
                        class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl position-absolute">
                        <i class="material-icons opacity-10">edit_note</i>
                    </div>
                    <div class="card-text text-end ">
                        <p class="text-md mb-0 text-capitalize">Requests</p>
                        <h4>1234</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<br>
<?php
// Fetch announcements
$announcesql = "SELECT * FROM announcements ORDER BY created_at ASC LIMIT 6";
$announceresult = mysqli_query($conn, $announcesql);

if (!$announceresult) {
    echo "Error executing query: " . mysqli_error($conn);
}
?>

<br>
<?php
// Fetch announcements
$announcesql = "SELECT * FROM announcements ORDER BY Time(created_at) DESC LIMIT 6";
$announceresult = mysqli_query($conn, $announcesql);

if (!$announceresult) {
    echo "Error executing query: " . mysqli_error($conn);
}
?>

<br>
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
                            <a href="announcement.php" class="btn btn-outline-info me-4">
                                View all <i class="material-icons opacity-10">trending_flat</i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
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
                        <div class="col-12 col-md-4 mb-1">
                            <div class="card">
                                <div class="card-header">
                                    Category: <?php echo $ministry; ?>
                                    <p class="card-text fw-light">
                                        Posted: <?php echo $formattedTime .' '. $formattedDate; ?>
                                    </p>
                                </div>
                                <div class="card-body">
                                    <p class="card-text-long fst-normal">
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

        <!-- Bible Verse Section -->
        <div class="col-12 col-lg-4" id="biblebdaywrap">
            <div class="card pb-3">
                <div class="card-header pb-0">
                    <div class="card-text fs-6">King James Version | John 3:16</div>
                </div>
                <div class="card-body fw-medium fst-italic">
                    API or .text Bible Verse Content here... API or .text Bible Verse Content here... API or .text Bible
                    Verse Content here... API or .text Bible Verse Content here... API or .text Bible Verse Content
                    here... API or .text Bible Verse Content here... API or .text Bible Verse Content here... API or
                    .text Bible Verse Content here... API or .text Bible Verse Content here... API or .text Bible Verse
                    Content here... API or .text Bible Verse Content here...
                </div>
                <div class="card-footer">
                    <button id="new-verse-button" class="btn btn-primary float-end">Get New Verse</button>
                </div>
            </div>

            <!-- Script to get new verse -->
            <script>
            document.getElementById('new-verse-button').addEventListener('click', function() {
                alert("New verse functionality not implemented yet!");
            });
            </script>

            <!-- Birthday Section -->
            <br>
            <div class="card">
                <div class="card-header fs-4">
                    <a>Upcoming Birthdays</a>
                </div>
                <div class="card-body text-body-tertiary">
                    <?php
                    $bdaysql = "SELECT first_name, last_name, birthday FROM users ORDER BY MONTH(birthday), DAY(birthday) ASC LIMIT 7";
                    $bdayresult = $conn->query($bdaysql);

                    if ($bdayresult->num_rows > 0) {
                        $counter = 1;
                        while ($row = $bdayresult->fetch_assoc()) {
                            $name = htmlspecialchars($row['first_name'] . ' ' . $row['last_name']);
                            $formattedDate = date('F j', strtotime($row['birthday']));
                            echo "<div '>
                                    <p>$counter. $name - $formattedDate</p>
                                </div>";
                            $counter++;
                        }
                    } else {
                        echo "<p>No birthdays found.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


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
                        <a href="event.php"
                            class="btn btn-outline-info d-flex justify-content-center align-items-center"
                            aria-expanded="false" aria-controls="moreContent">
                            View all <i class="material-icons opacity-10">trending_flat</i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
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
                            $sql = "SELECT * FROM events ORDER BY date ASC LIMIT 6";
                            $result = mysqli_query($conn, $sql);

                            if ($result && mysqli_num_rows($result) > 0)
                                //display event loop
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $eventId = htmlspecialchars($row['id']);

                                    // Format date and time
                                    $date = new DateTime($row['date']);
                                    $formattedDate = $date->format('l, F j, Y'); // month, day, year

                                    $time = new DateTime($row['time']);
                                    $formattedTime = $time->format('g:i A');
                                    ?>
                            <tr>
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