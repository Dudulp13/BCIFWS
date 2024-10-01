<?php include ('navbarTop.php'); ?>

<style>
/* Container Styling */
#bcif-events-container {
    background-color: #f4f4f9;
    padding: 2rem 1rem;
}

.calendar-container {
    margin-top: 1rem;
    background-color: #ffffff;
    padding: 1rem;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Header Styling */
.bcif-header-title {
    color: #003366;
    font-family: 'Arial', sans-serif;
    font-size: 2.5rem;
    font-weight: bold;
}

.bcif-header-subtitle {
    color: #666666;
    font-size: 1.2rem;
    font-family: 'Arial', sans-serif;
}

/* Error Message Styling */
.bcif-error-message {
    color: #ff0000;
    text-align: center;
}

/* Accordion Styling */
.bcif-accordion-item {
    background-color: #f9f9f9;
    border-radius: 8px;
    border: none;
    margin-bottom: 1rem;
}

.bcif-accordion-button {
    background-color: #003366;
    color: #fff;
    border-radius: 8px;
    font-size: 1.2rem;
    padding: 0.8rem 1.2rem;
    font-weight: bold;
    width: 100%;
}

.bcif-accordion-button.collapsed {
    background-color: #005bb5;
}

.bcif-accordion-button:hover {
    background-color: #002244;
}

.bcif-event-title {
    font-size: 1.2rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 70%;
}

.bcif-event-date {
    color: #FFD700;
    font-size: 1rem;
    margin-left: auto;
}

/* Accordion Body Styling */
.bcif-accordion-body {
    background-color: #ffffff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 1.2rem;
    color: #333;
    position: relative;
}

.bcif-accordion-body strong {
    color: #003366;
}

/* Ensure body text wraps properly */
.bcif-accordion-body p {
    word-wrap: break-word;
    overflow-wrap: break-word;
}

/* Button Container */
.bcif-button-container {
    display: flex;
    justify-content: flex-end;
    position: absolute;
    bottom: 1rem;
    right: 1rem;
}

#accordButton {
    padding: 0.5rem 1.5rem;
}

.btn-primary {
    background-color: #007bff;
    border: none;
    padding: 0.75rem 1.5rem;
}

.bcif-no-events {
    text-align: center;
    color: #666666;
    font-size: 1.2rem;
    padding: 2rem;
}

.bcif-pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.bcif-pagination .page-item {
    margin: 0 5px;
}

.bcif-pagination .page-link {
    padding: 0.5rem 1rem;
    border: 1px solid #003366;
    color: #003366;
    text-decoration: none;
}

.bcif-pagination .page-link:hover {
    background-color: #005bb5;
    color: white;
}

.bcif-pagination .page-link.active {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
}

/* Calendar Styling */
.calendar {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 10px;
    width: 300px;
    /* Fixed width */
    height: 300px;
    /* Fixed height */
    overflow: hidden;
    /* Prevent overflow */
}

.day {
    border: 1px solid #ccc;
    padding: 20px;
    /* Keep padding to separate the number and event */
    height: 100px;
    /* Keep fixed height */
    position: relative;
    display: flex;
    /* Use flexbox to position children */
    flex-direction: column;
    /* Arrange children vertically */
    justify-content: flex-start;
    /* Align items at the top */
}

.event {
    background: #007bff;
    /* Default event color */
    color: #fff;
    /* Text color (if needed) */
    padding: 5px;
    /* Padding for event */
    margin-top: 5px;
    /* Space between the day number and the event */
    border-radius: 5px;
    /* Rounded corners */
    flex-shrink: 0;
    /* Prevent shrinking */
}
</style>

<div class="container-fluid mt-5" id="bcif-events-container">
    <div class="row text-center mb-4">
        <div class="col-12">
            <h1 class="bcif-header-title">Church Events</h1>
            <p class="bcif-header-subtitle">Stay updated with our upcoming events</p>

        </div>
    </div>

    <?php
    include("../includes/database.php");

    // Pagination setup
    $eventsPerPage = 5; // Number of events per page
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($currentPage - 1) * $eventsPerPage;

    // SQL query to count total events
    $countSql = "SELECT COUNT(*) AS total FROM events";
    $countResult = mysqli_query($conn, $countSql);
    $totalEvents = mysqli_fetch_assoc($countResult)['total'];
    $totalPages = ceil($totalEvents / $eventsPerPage);

    // SQL query to fetch events for the current page
    $sql = "SELECT * FROM events ORDER BY date ASC LIMIT $eventsPerPage OFFSET $offset";
    $result = mysqli_query($conn, $sql);

    // Check for errors
    if (!$result) {
        echo "<p class='bcif-error-message'>Error fetching events: " . mysqli_error($conn) . "</p>";
        exit();
    }

    // Fetch events
    $events = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Format date function
    function formatEventDate($dateString) {
        $date = new DateTime($dateString);
        return $date->format('M j, Y \a\t g:i A');
    }
    ?>

    <br>


    <div class="container-fluid">
        <div class="row">
            <!-- Events Column on the Left -->
            <div class="col-md-4 col-sm-6 pt-5">
                <?php if (count($events) > 0): ?>
                <?php foreach ($events as $index => $event): ?>
                <div class="accordion-item bcif-accordion-item mb-4" id="bcif-event-<?php echo $index; ?>">
                    <h2 class="accordion-header" id="heading-<?php echo $index; ?>">
                        <button
                            class="accordion-button bcif-accordion-button <?php echo $index === 0 ? '' : 'collapsed'; ?>"
                            type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo $index; ?>"
                            aria-expanded="<?php echo $index === 0 ? 'true' : 'false'; ?>"
                            aria-controls="collapse-<?php echo $index; ?>">
                            <div class="d-flex justify-content-between w-100">
                                <span
                                    class="bcif-event-title col-6"><?php echo htmlspecialchars($event['title']); ?></span>
                                <span
                                    class="bcif-event-date col-4"><?php echo formatEventDate($event['date']); ?></span>
                            </div>
                        </button>
                    </h2>
                    <div id="collapse-<?php echo $index; ?>"
                        class="accordion-collapse collapse <?php echo $index === 0 ? 'show' : ''; ?>"
                        aria-labelledby="heading-<?php echo $index; ?>" data-bs-parent="#bcif-events-accordion">
                        <div class="accordion-body bcif-accordion-body">
                            <p><strong>Location:</strong> <?php echo htmlspecialchars($event['location']); ?></p>
                            <p><strong>Details:</strong> <?php echo htmlspecialchars($event['description']); ?></p>
                            <div class="text-end">
                                <button class="btn btn-outline-info" onclick="alert('targeta ang modal form')"
                                    id="accordButton">
                                    Register
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                <p class="bcif-no-events">No events available at the moment.</p>
                <?php endif; ?>

                <!-- Pagination (for Events) -->
                <div class="container-fluid bcif-pagination justify-content-start position-end">
                    <?php if ($currentPage > 1): ?>
                    <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>"><i
                            class="material-icons">arrow_back</i></a>
                    <?php endif; ?>
                    <?php for ($page = 1; $page <= $totalPages; $page++): ?>
                    <a class="page-link <?php echo $currentPage === $page ? 'active' : ''; ?>"
                        href="?page=<?php echo $page; ?>">
                        <?php echo $page; ?>
                    </a>
                    <?php endfor; ?>
                    <?php if ($currentPage < $totalPages): ?>
                    <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>"><i
                            class="material-icons">arrow_forward</i></a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Calendar  Right  Col-->
            <div class="col-md-4 col-sm-12 calendar-container">
                <h5 class="text-center">BCIF Calendar</h5>
                <div class="d-flex justify-content-center mb-3">
                    <div class="btn-group" role="group" aria-label="Event Filter Buttons">
                        <button class="btn btn-secondary" id="missedEventsButton">Missed </button>
                        <button class="btn btn-success" id="ongoingEventsButton">On-going </button>
                        <button class="btn btn-warning" id="upcomingEventsButton">Up-coming </button>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <button id="prevMonth" class="btn"><i class="material-icons">arrow_back</i></button>
                    <h2 id="calendarMonthYear"></h2>
                    <button id="nextMonth" class="btn"><i class="material-icons">arrow_forward</i></button>
                </div>
                <div class="calendar" id="calendar" style="width: 300px; height: 300px;"></div>

            </div>
        </div>
    </div>
</div>

<script>
// array store event
const events = <?php echo json_encode($events); ?>;

// Initialize current month and year
let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();

// Function to render the calendar
function renderCalendar() {
    const calendar = document.getElementById('calendar');
    const monthYearDisplay = document.getElementById('calendarMonthYear');

    // Update the month/year display
    monthYearDisplay.innerText =
        `${new Date(currentYear, currentMonth).toLocaleString('default', { month: 'long' })} ${currentYear}`;

    // Get the first day of the month
    const firstDay = new Date(currentYear, currentMonth, 1).getDay();
    // Get the last date of the month
    const lastDate = new Date(currentYear, currentMonth + 1, 0).getDate();

    calendar.innerHTML = '';

    // Fill the calendar with empty days
    for (let i = 0; i < firstDay; i++) {
        const dayDiv = document.createElement('div');
        calendar.appendChild(dayDiv);
    }

    // Create day elements and append events
    for (let day = 1; day <= lastDate; day++) {
        const dayDiv = document.createElement('div');
        dayDiv.className = 'day';
        dayDiv.innerHTML = `<strong>${day}</strong>`;

        // Check for events on this day
        events.forEach(event => {
            const eventDate = new Date(event.date);
            if (eventDate.getDate() === day && eventDate.getMonth() === currentMonth && eventDate
                .getFullYear() === currentYear) {
                const eventDiv = document.createElement('div');
                eventDiv.className = 'event';
                eventDiv.style.backgroundColor = event.color;
                dayDiv.appendChild(eventDiv);
            }
        });

        calendar.appendChild(dayDiv); // attach dayDiv to the calendar
    }
}

// Function to handle month change
function changeMonth(direction) {
    if (direction === 'next') {
        if (currentMonth === 11) {
            currentMonth = 0;
            currentYear++;
        } else {
            currentMonth++;
        }
    } else if (direction === 'prev') {
        if (currentMonth === 0) {
            currentMonth = 11;
            currentYear--;
        } else {
            currentMonth--;
        }
    }
    renderCalendar(); // Re-render the calendar
}

// Attach event listeners to the buttons
document.getElementById('prevMonth').addEventListener('click', () => changeMonth('prev'));
document.getElementById('nextMonth').addEventListener('click', () => changeMonth('next'));

// Call the function to render the calendar on page load
renderCalendar();
</script>

<?php include ('footers.php'); ?>