<?php
include('memberHeader.php');
include('../includes/database.php');


// SQL query to fetch events based on selected sorting criteria
$sql = "SELECT * FROM events order by date";
$result = mysqli_query($conn, $sql);

// Check for errors in the query
if (!$result) {
    echo "Error fetching events: " . mysqli_error($conn);
    exit();
}

// Fetch events
$events = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!-- Event section -->
<div class="container">
    <div class="row text-dark">
        <div class="col-12 text-center mb-4">
            <p class="fs-2 text-dark text-uppercase fw-bold"><strong>Upcoming Events</strong></p>
        </div>
    </div>
    <!-- Bootstrap Carousel for Events -->
    <div id="eventsCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php if (!empty($events)): ?>
            <?php foreach ($events as $index => $event): ?>
            <div class="carousel-item <?php if ($index === 0) echo 'active'; ?>">
                <div class="card">
                    <div class="card-body d-flex">
                        <div
                            class="col-md-4 text-center border-right d-flex flex-column align-items-center justify-content-center">
                            <?php
                                    // Format the date
                                    $date = new DateTime($event['date']);
                                    $formattedtime = new DateTime($event['time']);
                                    $formattedtime = $formattedtime->format('g:i A');
                                    $day = $date->format('j');
                                    $month = $date->format('M Y');
                                    ?>
                            <small class="text-muted fs-5"><?= htmlspecialchars($formattedtime) ?></small>
                            <h5 class="card-date mb-0 fs-2"><?= htmlspecialchars($day) ?></h5>
                            <small class="text-muted fs-5"><?= htmlspecialchars($month) ?></small>
                        </div>
                        <div class="col-md-8">
                            <h5 class="card-title"><?= htmlspecialchars($event['title']) ?></h5>
                            <p class="card-text"><strong>Location:</strong> <?= htmlspecialchars($event['location']) ?>
                            </p>
                            <p class="card-text" id="hr"><?= htmlspecialchars($event['description']) ?></p>
                            <a href="memberEvent.php" class="btn btn-outline-info mt-2">More Details</a>
                            <button class="btn btn-success mt-2 float-end"
                                onclick="alert('Target Event registration modal')">Join</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <p class="text-danger text-center fs-5">We currently have no events. Stay tuned.</p>
            <?php endif; ?>
        </div>

        <!-- Carousel controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#eventsCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#eventsCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<?php
// Free the result set
mysqli_free_result($result);
// Close the database connection
mysqli_close($conn);
?>


<!-- Bootstrap JS (required for carousel) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>