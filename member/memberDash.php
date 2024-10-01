<?php include('memberHeader.php') ; ?>

<style>
.bcif-events {
    margin-bottom: 120px;
}

b.bcif-events {
    background-color: #F8F9FA;
}

.bcif-events .card {
    border: 1px solid #008080;
}


.bcif-events .card-date {
    color: #FF6F61;
    /* fink */
}

.bcif-events #hr {
    color: gray;
    font-weight: lighter;
    font-family: Arial, Helvetica, sans-serif;
}
</style>



<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="hr bg-dark w-100 text-light text-center col-md-6 pt-2 my-auto">
            <div class="card-body">
                <div class="card-title pt-3">
                    <p class="fs-4">"Do not be anxious about anything, but in every situation, by prayer
                        and petition, with thanksgiving, present your requests to God."</p>
                    <footer class="verse-footer">
                        - <cite title="Source Title">Verse source here</cite>
                    </footer>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include("../includes/database.php");


// SQL query
$sql = "SELECT * FROM events ORDER BY date asc LIMIT 4";
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
<div class="container bcif-events">
    <div class="row text-dark">
        <div class="col-12 text-center mb-4">

            <p class="fs-2 text-dark text-uppercase fw-bold"><strong>Upcoming Events</strong></p>
        </div>
    </div>

    <div class="row">
        <?php if (!empty($events)): ?>
        <?php foreach ($events as $event): ?>
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body d-flex">
                    <div
                        class="col-md-4 text-center border-right d-flex flex-column align-items-center justify-content-center">
                        <?php
                    // Format the date
                    $date = new DateTime($event['date']);
                    $formattedtime = new DateTime($event['time']);
                    $formattedtime = $formattedtime->format('g:i A');  // Fixing the syntax here
                    $day = $date->format('j');
                    $month = $date->format('M Y');
                ?>
                        <small class="text-muted fs-5"><?= htmlspecialchars($formattedtime) ?></small>
                        <h5 class="card-date mb-0 fs-2"><?= htmlspecialchars($day) ?></h5>
                        <small class="text-muted fs-5"><?= htmlspecialchars($month) ?></small>
                    </div>
                    <div class="col-md-8">
                        <h5 class="card-title"><?= htmlspecialchars($event['title']) ?></h5>
                        <p class="card-text"><strong>Location:</strong> <?= htmlspecialchars($event['location']) ?></p>
                        <p class="card-text" id="hr"><?= htmlspecialchars($event['description']) ?></p>
                        <a href="memberEvent.php" class="btn btn-outline-info mt-2">more details</a>
                        <!-- Join button -->
                        <button class="btn btn-success mt-2 float-end"
                            onclick="alert('target Event registration modal')">Join</button>
                    </div>
                </div>
            </div>
        </div>

        <?php endforeach; ?>
        <?php else: ?>
        <p class="text-danger text-center fs-5">We currently have no event. Stay tuned.</p>
        <?php endif; ?>
    </div>
</div>
<br>


<?php
// Free the result set
mysqli_free_result($result);
// Close the database connection
mysqli_close($conn);
?>