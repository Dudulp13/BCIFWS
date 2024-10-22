<?php include 'navbarTop.php';
include 'submit_prayer.php';
include '../includes/modals.php' ;
?>
<style>
#wrap1 {
    margin-bottom: 100px;
    margin-top: px;

}


#wrapTop {
    margin-bottom: 20px;

}


.card {
    background-color: #E8F1F2;
}

.card-title h3,
.card-body p,
.form-label {
    font-family: 'Roboto', sans-serif;
    font-size: x-large;
    color: #3A4040;
}

.blockquote {
    border-left: 4px solid #007bff;
    padding-left: 1rem;
    color: #fafafa;
}


blockquote p {
    font-size: 1.1rem;
    line-height: 1.5;
}

/* Background Image for the row */
.bg-image {
    background-image: url('../img/jesus.jpg');
    background-size: cover;
    background-position: center;
    height: 700px;
    position: relative;
}


.bg-image .col-12 {
    height: 70%;
    /* adapat sa size ka row*/
}

.bg-image h1,
.bg-image p {
    color: #ffffff !important;
    /* Force white color */
}

.card-text {}


.calendar {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 20px 0;
}

.calendar-header {
    display: flex;
    justify-content: space-between;
    width: 100%;
    margin-bottom: 10px;
}

.calendar-days {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 5px;
    width: 100%;
}

.day {
    padding: 10px;
    text-align: center;
    color: black;
    background-color: #d0e7e7;
}

.event {
    background-color: #007bff;
    color: white;
    border-radius: 50%;
    padding: 2px;
    margin: 2px 0;
    font-size: 0.8rem;
}
</style>

<?php if ($alertMessage): ?>
<div class="container-fluid">
    <div class="alert text-light alert-<?php echo $alertType; ?> alert-dismissible fade show fixed-top mx-auto mt-3"
        role="alert" style="max-width: 500px;">
        <strong><?php echo ucfirst($alertType); ?>!</strong> <?php echo $alertMessage; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <i class="material-icons">close</i>
        </button>
    </div>
</div>
<?php endif; ?>





<!--Top section-->
<div class="container-fluid" id="wrapTop">
    <!-- Row with background image -->
    <div class="row bg-image fw-bold">
        <div class="col-12 d-flex flex-column justify-content-end align-items-center text-light pb-3" id="colspan">
            <!-- Watch Live Button -->
            <a href="https://www.facebook.com/bcif.santabarbara"
                class="btn btn-primary d-flex align-items-center fs-6 fw-bold mt-3" target="_blank"
                rel="noopener noreferrer">
                <i class="fas fa-play-circle fa-lg me-2"></i> Watch Live
            </a>
        </div>
    </div>
</div>
<br>

<!--  Carousel for Mission & Vision -->
<div class="container">
    <div id="missionVisionCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <!-- Verse of the Day Section (Set as active) -->
            <div class="carousel-item active">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center fs-3">Verse of the Day</h5>
                        <blockquote class="blockquote px-3">
                            <p class="text-center">
                                <!-- Replace with dynamic verse -->
                                "For I know the plans I have for you," declares the Lord, "plans to prosper you and not
                                to harm you, plans to give you hope and a future."
                                <small class="text-center">- Jeremiah 29:11</small>
                            </p>
                        </blockquote>
                    </div>
                    <!-- Controls under text -->
                    <div class="text-center mt-3">
                        <button class="btn float-start" type="button" data-bs-target="#missionVisionCarousel"
                            data-bs-slide="prev">
                            <i class="material-icons">arrow_back</i>
                        </button>
                        <button class="btn float-end" type="button" data-bs-target="#missionVisionCarousel"
                            data-bs-slide="next">
                            <i class="material-icons">arrow_forward</i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Mission Section -->
            <div class="carousel-item">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center fs-3">Our Mission</h5>
                        <blockquote class="blockquote px-3">
                            <p class=" pe-5 text-center">To raise up a world class, competent leaders and
                                missionaries that
                                extravagantly worship God and equipped through intentional discipleship and missions
                                training to Advance God's Kingdom.</p>
                        </blockquote>
                    </div>
                    <!-- Controls under text -->
                    <div class="text-center mt-3">
                        <button class="btn float-start" type="button" data-bs-target="#missionVisionCarousel"
                            data-bs-slide="prev">
                            <i class="material-icons">arrow_back</i>
                        </button>
                        <button class="btn float-end" type="button" data-bs-target="#missionVisionCarousel"
                            data-bs-slide="next">
                            <i class="material-icons">arrow_forward</i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Vision Section -->
            <div class="carousel-item">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center fs-3">Our Vision</h5>
                        <blockquote class="blockquote px-3">
                            <p class="pe-5 text-center">We are worshipping Ambassadors fulfilling the great
                                Commission exercising the power and authorization of the Lord Jesus Christ that brings
                                freedom and transformation for the Advancement of God's Kingdom.</p>
                        </blockquote>
                    </div>
                    <!-- Controls under text -->
                    <div class="text-center mt-3">
                        <button class="btn float-start" type="button" data-bs-target="#missionVisionCarousel"
                            data-bs-slide="prev">
                            <i class="material-icons">arrow_back</i>
                        </button>
                        <button class="btn float-end" type="button" data-bs-target="#missionVisionCarousel"
                            data-bs-slide="next">
                            <i class="material-icons">arrow_forward</i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>

<?php include ('../includes/database.php');
$query = "SELECT COUNT(*) as total FROM prayers";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalCount = $row['total'];
} else {
    $totalCount = 0; // Default to 0 if query fails
}
?>

<div class="container mt-5" id="wrap1">
    <div class="card-group justify-items-center">
        <!--text image area-->
        <div class="card bg-transparent">
            <div class="card-body text-center">
                <h4 class="text-center pt-3">We’re Here to Pray with You</h4>
                <p class="text-center fs-5">At <strong>BCIF</strong>, we
                    believe in the power of prayer.
                    Share your prayer request, and our prayer team will lift you up.</p>
                <img src="../img/prayer.jpg" class="card-img w-90 mx-auto" alt="praying image">
            </div>
            <div class="card-footer text-center text-body-secondary mx-3">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="icon-circle me-2">
                        <i class="fas fa-users fa-lg"></i>
                    </div>
                    <span class="fs-5"><strong><?php echo htmlspecialchars($totalCount); ?></strong></span>
                </div>
                <p class="mb-0 ms-3">people have sent a request.</p>
            </div>
        </div>
        <!--form area-->
        <div class="card">
            <div class="card-header bg-dark text-light fs-4">Prayer Request</div>
            <div class="card-body">
                <form class="needs-validation" id="prayer_req" method="POST" action="" novalidate>
                    <!-- Prayer Request Input -->
                    <div class="mb-2">
                        <label for="prayerRequest" class="form-label">How can we pray for you?</label>
                        <textarea class="form-control ps-3" id="prayerRequest" name="prayerRequest" rows="4"
                            placeholder="Write your prayer request here" required></textarea>
                        <div class="invalid-feedback">
                            Please provide your prayer request.
                        </div>
                    </div>

                    <!-- Prayer Type -->
                    <div class="mb-2">
                        <label class="form-label">Prayer Type</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="prayerType" id="private" value="private"
                                required>
                            <label class="form-check-label" for="private">Private (Only shared with the prayer
                                team)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="prayerType" id="public" value="public"
                                required>
                            <label class="form-check-label" for="public">Public (Shared with the community)</label>
                        </div>
                        <div class="invalid-feedback">
                            Please select a prayer type.
                        </div>
                    </div>

                    <!-- Follow-Up Request -->
                    <div class="mb-3">
                        <label class="form-label">Would you like someone from our team to reach out to you?</label>
                        <div class="form-check">
                            <input class="form-check-input " type="radio" name="followUp" id="followYes" value="yes"
                                onclick="togglePersonalDetails(true)" required>
                            <label class="form-check-label" for="followYes">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="followUp" id="followNo" value="no"
                                onclick="togglePersonalDetails(false)" required>
                            <label class="form-check-label" for="followNo">No</label>
                        </div>
                        <div class="invalid-feedback">
                            Please select an option for follow-up.
                        </div>
                    </div>

                    <!-- Personal Details (Hidden by Default) -->
                    <div class="container mt-4" id="personalDetails" style="display: none;">
                        <div class="row d-flex">
                            <div class="col mb-3">
                                <label for="name" class="form-label">Name <small
                                        class="text-muted">(Required)</small></label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter your name" disabled>
                                <div class="invalid-feedback">
                                    Please enter your name.
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="phone" class="form-label">Contact Details
                                    <small class="text-muted">(Required)</small>
                                </label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="Email / Mobile / Telephone" disabled>
                                <div class="invalid-feedback">
                                    Please enter any of the following contact details.
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary btn-lg">Submit Request</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function togglePersonalDetails(show) {
    var nameField = document.getElementById('name');
    var phoneField = document.getElementById('phone');
    var personalDetails = document.getElementById('personalDetails');

    if (show) {
        personalDetails.style.display = 'block';
        nameField.disabled = false;
        phoneField.disabled = false;
        nameField.required = true;
        phoneField.required = true;
    } else {
        personalDetails.style.display = 'none';
        nameField.disabled = true;
        phoneField.disabled = true;
        nameField.required = false;
        phoneField.required = false;
    }
}
</script>

<br>
<?php
include('../includes/database.php');

// SQL query
$sql = "SELECT * FROM events WHERE date >= NOW() ORDER BY date";
$result = mysqli_query($conn, $sql);

// Check for errors in the query
if (!$result) {
    echo "Error fetching events: " . mysqli_error($conn);
    exit();
}

// Fetch events
$events = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!-- Events / Calendar section -->
<div class="container-fluid bcif-events" id="eventsection" name="eventsection">
    <div class="row text-light">
        <div class="col-12 text-center bg-dark m-auto py-3">
            <div class="fs-4">BCIF Santa Barbara</div>
            <p class="fs-2 text-uppercase fw-bold"><strong>Upcoming Events</strong></p>
        </div>
    </div><br>

    <!-- Main Row for Events and Calendar -->
    <div class="row p-3 justify-content-between" id="event-section">
        <!-- Events Carousel (7 columns) -->
        <div class="col-md-7 col-sm-12 me-sm-3 ">
            <div id="eventCarousel" class="carousel slide mt-3" data-bs-ride="carousel">
                <div class="carousel-inner justify-content-center">
                    <?php if (!empty($events)): ?>
                    <?php foreach ($events as $index => $event): ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                        <!-- Event Card -->
                        <div class="card ">
                            <div class="card-body d-flex flex-column flex-md-row">
                                <div
                                    class="col-12 col-md-4 text-center border-md-end mb-3 mb-md-0 d-flex flex-column align-items-center justify-content-center">
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
                                <div class="col-12 col-md-8 d-flex flex-column">
                                    <h5 class="card-title fs-3"><?= htmlspecialchars($event['title']) ?></h5>
                                    <p class="card-text"><strong>Location:</strong>
                                        <?= htmlspecialchars($event['location']) ?></p>
                                    <p class="card-text"><?= htmlspecialchars($event['description']) ?></p>
                                    <div class="mt-auto d-flex justify-content-md-end justify-content-end">
                                        <!-- Register button with event title data -->
                                        <button class="btn btn-outline-info mt-2" data-bs-toggle="modal"
                                            data-bs-target="#registerEvent"
                                            data-event-title="<?= htmlspecialchars($event['title']) ?>">Register</button>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <!-- Carousel controls -->
                                <div class="text-center mt-3">
                                    <button class="btn btn-outline-secondary me-2" type="button"
                                        data-bs-target="#eventCarousel" data-bs-slide="prev">
                                        Previous
                                    </button>
                                    <button class="btn btn-outline-secondary" type="button"
                                        data-bs-target="#eventCarousel" data-bs-slide="next">
                                        Next
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <?php endforeach; ?>

                    <?php else: ?>
                    <div class="carousel-item active">
                        <p class="text-danger text-center fs-5">We currently have no event. Stay tuned.</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div><br>

        </div>

        <div class="col-md-3 col-sm-12 calendar-container" id="calendarWrap">
            <div class="calendar" id="calendar"></div>
            <div class="d-flex justify-content-center">
                <div class="d-flex align-items-center" role="group" aria-label="Basic mixed styles example">
                    <p class="border border-info rounded text-info text-center m-1 p-2">Event</p>
                    <p class="border border-danger rounded text-danger text-center m-1 p-2 ">Service 8:00 AM</p>
                    <p class="border border-success rounded text-success text-center m-1 p-2 ">Prayer Meeting 6:00 PM
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Get all buttons that trigger the modal
    const registerButtons = document.querySelectorAll('[data-bs-target="#registerEvent"]');

    //  event listener to each button
    registerButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Get the event title
            const eventTitle = this.getAttribute('data-event-title');
            const prefixText = "Thank you for your interest in joining the event  ";
            const fullTitle = prefixText + eventTitle;

            // Set the value of the hidden input field and display the event title
            document.getElementById('eventName').value =
                eventTitle;
            document.getElementById('displayEventName').innerText =
                fullTitle; // Display the modified title
        });
    });
    </script>


</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const events = <?php echo json_encode($events); ?>; // Convert PHP events to JavaScript array

    function renderCalendar(year, month) {
        // Clear previous calendar
        calendarEl.innerHTML = '';

        // Create header
        const header = document.createElement('div');
        header.classList.add('calendar-header');
        const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August",
            "September", "October", "November", "December"
        ];
        header.innerHTML = `
            <button class="btn" id="prev"><i class="material-icons">arrow_back</i></button>
            <h3>${monthNames[month]} ${year}</h3>
            <button class="btn" id="next"><i class="material-icons">arrow_forward</i></button>
        `;

        calendarEl.appendChild(header);

        // Create day names
        const daysHeader = document.createElement('div');
        daysHeader.classList.add('calendar-days');
        const dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        dayNames.forEach(day => {
            const dayEl = document.createElement('div');
            dayEl.innerText = day;
            daysHeader.appendChild(dayEl);
        });
        calendarEl.appendChild(daysHeader);

        // Calculate first day of the month and number of days
        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);
        const totalDays = lastDay.getDate();

        // Fill in the calendar
        for (let i = 0; i < firstDay.getDay(); i++) {
            const emptyDay = document.createElement('div');
            emptyDay.classList.add('day');
            daysHeader.appendChild(emptyDay);
        }

        for (let day = 1; day <= totalDays; day++) {
            const dayEl = document.createElement('div');
            dayEl.classList.add('day');
            dayEl.innerText = day;
            dayEl.dataset.date = `${year}-${month + 1}-${day}`;

            // Get the date for the current day
            const currentDate = new Date(year, month, day);
            const dayOfWeek = currentDate.getDay(); // 0 = Sunday, 4 = Thursday

            // Apply colors to Sunday (red) and Thursday (green)
            if (dayOfWeek === 0) {
                dayEl.style.color = 'red'; // Sunday
            } else if (dayOfWeek === 4) {
                dayEl.style.color = 'green'; // Thursday
            }

            // Check for events on this day
            const eventForDay = events.filter(event => {
                const eventDate = new Date(event.date);
                return eventDate.getFullYear() === year && eventDate.getMonth() === month && eventDate
                    .getDate() === day;
            });

            if (eventForDay.length > 0) {
                eventForDay.forEach(event => {
                    const eventEl = document.createElement('div');
                    eventEl.classList.add('event');
                    eventEl.style.backgroundColor = event.color ||
                        '#1b98e0'; // Default blue color for event
                    eventEl.style.width = '20%';
                    eventEl.style.height = '10px';

                    dayEl.appendChild(eventEl);
                });
            }

            daysHeader.appendChild(dayEl);
        }

        calendarEl.appendChild(daysHeader);

        // Attach event listeners for navigation
        document.getElementById('prev').addEventListener('click', () => {
            month--;
            if (month < 0) {
                month = 11;
                year--;
            }
            renderCalendar(year, month);
        });

        document.getElementById('next').addEventListener('click', () => {
            month++;
            if (month > 11) {
                month = 0;
                year++;
            }
            renderCalendar(year, month);
        });
    }

    // Initial render
    const now = new Date();
    renderCalendar(now.getFullYear(), now.getMonth());
});
</script>

<?php
// Free the result set
mysqli_free_result($result);
// Close the database connection
mysqli_close($conn);
?>

<?php include ('footers.php') ?>