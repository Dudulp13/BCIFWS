<style>
/* Modal Background and Content */
.modal-content {
    border-radius: 10px;
    /* Rounded corners for the modal */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    /* Subtle shadow for depth */
    overflow: hidden;
    /* Ensure content stays within rounded corners */
}

/* Modal Header */
.modal-header {
    background-color: #007bff;
    /* Bootstrap primary color */
    color: #ffffff;
    /* White text color */
    border-bottom: 2px solid #0056b3;
    /* Darker blue border */
}

/* Modal Title */
.modal-title {
    font-size: 1.25rem;
    /* Heading font size */
    font-weight: 700;
    /* Bold font */
}

/* Modal Body */
.modal-body {
    padding: 30px;
    /* Increased padding for breathing room */
    background-color: #f7f7f7;
    /* Light grey background */
    color: #333;
    /* Dark text for readability */
}

/* Subheading Style */
.modal-body h5 {
    font-size: 2rem;
    /* Subheading font size */
    margin-bottom: 15px;
    /* Spacing below subheading */
    color: #0056b3;
    /* Darker blue for subheading */
}

/* Paragraph Style */
.modal-body p {
    font-size: 1.25rem;
    /* Font size for paragraphs */
    line-height: 1.5;
    /* Improved line height for readability */
}

/* Form Labels */
.form-label {
    font-weight: 500;
    /* Semi-bold for labels */
    color: #555;
    /* Dark grey for labels */
}

/* Input Fields and Textareas */
.form-control {
    border-radius: 5px;
    /* Rounded edges for input fields */
    border: 1px solid #ccc;
    /* Light grey border */
    transition: border-color 0.3s;
    /* Transition effect for focus */
    font-size: 1.25rem;
    /* Increased font size for better readability */
    padding: 10px;
    /* Padding for a better touch target */
}

/* Select Fields */
.form-select {
    font-size: 1.25rem;
    /* Increased font size for select fields */
    padding: 10px;
    /* Padding for a better touch target */
}

/* Input Focus Effect */
.form-control:focus {
    border-color: #007bff;
    /* Change border color on focus */
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    /* Subtle shadow on focus */
}

/* Button Styles */
.btn {
    border-radius: 5px;
    /* Rounded corners for buttons */
    padding: 10px 20px;
    /* Padding for buttons */
}

/* Primary Button */
.btn-primary {
    background-color: #007bff;
    /* Bootstrap primary color */
    border: none;
    /* Remove border */
}

.btn-primary:hover {
    background-color: #0056b3;
    /* Darker blue on hover */
}

/* Secondary Button */
.btn-secondary {
    background-color: #6c757d;
    /* Bootstrap secondary color */
    border: none;
    /* Remove border */
}

.btn-secondary:hover {
    background-color: #5a6268;
    /* Darker grey on hover */
}

/* Danger Button */
.btn-danger {
    background-color: #dc3545;
    /* Bootstrap danger color */
    border: none;
    /* Remove border */
}

.btn-danger:hover {
    background-color: #c82333;
    /* Darker red on hover */
}

/* Footer Style */
.modal-footer {
    background-color: #f7f7f7;
    /* Same as modal body */
    border-top: 2px solid #e9ecef;
    /* Light grey border on top */
}
</style>

<!-- Insert Announcement Modal -->
<div class="modal fade" id="insertAnnounceModal" tabindex="-1" aria-labelledby="insertAnnounceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title" id="insertAnnounceModalLabel">Create Announcement</p>

            </div>
            <div class="modal-body">
                <form action="announceCreate.php" method="post">
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" name="category" required>
                            <option value="" disabled selected>Select a category</option>
                            <option value="Children">Children</option>
                            <option value="Youth">Youth</option>
                            <option value="Outreach">Outreach</option>
                            <option value="Usher">Usher</option>
                            <option value="Media">Media</option>
                            <option value="Dance">Dance</option>
                            <option value="Music">Music</option>
                            <option value="General">General</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="announceMsg" class="form-label">Message</label>
                        <textarea class="form-control" name="announceMsg" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="time_date" class="form-label">Time & Date</label>
                        <input type="datetime-local" class="form-control" name="time_date" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="save_announce" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Announcement Modal -->
<div class="modal fade" id="editAnnouncementModal" tabindex="-1" aria-labelledby="editAnnouncementModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAnnouncementModalLabel">Edit Announcement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editAnnouncementForm" method="post" action="announceEdit.php">
                    <input type="hidden" id="announcementId" name="id" value="">
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category" required>
                            <option value="" disabled selected>Select a category</option>
                            <option value="Children">Children</option>
                            <option value="Youth">Youth</option>
                            <option value="Outreach">Outreach</option>
                            <option value="Usher">Usher</option>
                            <option value="Media">Media</option>
                            <option value="Dance">Dance</option>
                            <option value="Music">Music</option>
                            <option value="General">General</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="announceMsg" class="form-label">Message</label>
                        <textarea class="form-control" id="announceMsg" name="message" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="time_date" class="form-label">Time & Date</label>
                        <input type="datetime-local" class="form-control" id="time_date" name="time_date" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Announcement Modal -->
<div class="modal fade" id="deleteAnnouncementModal" tabindex="-1" aria-labelledby="deleteAnnouncementModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title" id="deleteAnnouncementModalLabel">Delete Announcement</p>

            </div>
            <div class="modal-body ">
                <p>Are you sure you want to delete this announcement?</p>
                <input type="hidden" id="deleteAnnouncementId" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Insert Event Modal -->
<div class="modal fade" id="insertEventModal" tabindex="-1" aria-labelledby="insertEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title" id="insertEventModalLabel">Create Event</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createEventForm" method="POST" action="eventCreate.php">
                    <div class="mb-3">
                        <label for="eventTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="eventTitle" name="eventTitle" required>
                    </div>
                    <div class="mb-3">
                        <label for="eventDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="eventDescription" name="description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="eventTime" class="form-label">Time</label>
                        <input type="time" class="form-control" id="eventTime" name="time" required>
                    </div>
                    <div class="mb-3">
                        <label for="eventDate" class="form-label">Date</label>
                        <input type="date" class="form-control" id="eventDate" name="date" required>
                    </div>
                    <div class="mb-3">
                        <label for="eventLocation" class="form-label">Location</label>
                        <input type="text" class="form-control" id="eventLocation" name="location" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Event Modal -->
<div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title" id="editEventModalLabel">Edit Event</p>
            </div>
            <div class="modal-body">
                <form id="editEventForm" method="post" action="eventEdit.php">
                    <input type="hidden" id="eventId" name="eventId" value="">
                    <div class="mb-3">
                        <label for="eventTitle" class="form-label">Event Title</label>
                        <input type="text" class="form-control" id="eventTitle" name="eventTitle" required>
                    </div>
                    <div class="mb-3">
                        <label for="eventDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="eventDescription" name="description" rows="3"
                            required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="eventTime" class="form-label">Time</label>
                        <input type="time" class="form-control" id="eventTime" name="time" required>
                    </div>
                    <div class="mb-3">
                        <label for="eventDate" class="form-label">Date</label>
                        <input type="date" class="form-control" id="eventDate" name="date" required>
                    </div>
                    <div class="mb-3">
                        <label for="eventLocation" class="form-label">Location</label>
                        <input type="text" class="form-control" id="eventLocation" name="location" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete event  Modal -->
<div class="modal fade" id="deleteEventModal" tabindex="-1" aria-labelledby="deleteEventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title" id="deleteEventModalLabel">Delete Event</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this event?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>


<!-- Baptism Scheduling Modal -->
<div class="modal fade" id="baptismScheduleModal" tabindex="-1" aria-labelledby="baptismScheduleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="baptismScheduleModalLabel">Schedule a Baptism</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="baptismScheduleForm" method="POST" action="baptismal.php">
                    <input type="hidden" name="request_type" value="baptism_schedule">
                    <!-- Hidden input for request type -->

                    <!-- Full Name of the Person to be Baptized -->
                    <div class="mb-3">
                        <label for="baptismFullName" class="form-label">Full Name of the Person to be Baptized</label>
                        <input type="text" class="form-control" id="baptismFullName" name="baptism_full_name" required>
                    </div>

                    <!-- Date of Birth -->
                    <div class="mb-3">
                        <label for="baptismBirthDate" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="baptismBirthDate" name="birth_date" required>
                    </div>

                    <!-- Parents' Names -->
                    <div class="mb-3">
                        <label for="fatherName" class="form-label">Father's Name</label>
                        <input type="text" class="form-control" id="fatherName" name="father_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="motherName" class="form-label">Mother's Name</label>
                        <input type="text" class="form-control" id="motherName" name="mother_maiden_name" required>
                    </div>

                    <!-- Preferred Baptism Date -->
                    <div class="mb-3">
                        <label for="preferredBaptismDate" class="form-label">Preferred Baptism Date</label>
                        <input type="date" class="form-control" id="preferredBaptismDate" name="preferred_baptism_date"
                            required>
                    </div>

                    <!-- Contact Information -->
                    <div class="mb-3">
                        <label for="contactInfo" class="form-label">Contact Information (Phone/Email)</label>
                        <input type="text" class="form-control" id="contactInfo" name="contact_info" required>
                    </div>

                    <!-- Remarks (Optional) -->
                    <div class="mb-3">
                        <label for="baptismRemarks" class="form-label">Remarks (Optional)</label>
                        <textarea class="form-control" id="baptismRemarks" name="remarks" rows="3"
                            placeholder="Any special requests or instructions"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit Schedule</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Baptismal Certificate Request Modal -->
<div class="modal fade" id="baptismRequestModal" tabindex="-1" aria-labelledby="baptismRequestModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="baptismRequestModalLabel">Request Baptismal Certificate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="baptismRequestForm" method="POST" action="baptismal.php">
                    <input type="hidden" name="request_type" value="certificate_request">
                    <!-- Hidden input for request type -->

                    <!-- Full Name of the Baptized Person -->
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Full Name of Baptized Person</label>
                        <input type="text" class="form-control" id="fullName" name="full_name" required>
                    </div>

                    <!-- Requester's Name -->
                    <div class="mb-3">
                        <label for="requesterName" class="form-label">Your Name (Requesting Person)</label>
                        <input type="text" class="form-control" id="requesterName" name="requester_name" required>
                    </div>

                    <!-- Requester's Contact Information -->
                    <div class="mb-3">
                        <label for="requesterContact" class="form-label">Contact Information (Phone/Email)</label>
                        <input type="text" class="form-control" id="requesterContact" name="requester_contact" required>
                    </div>

                    <!-- Purpose of Request -->
                    <div class="mb-3">
                        <label for="requestPurpose" class="form-label">Purpose of Request</label>
                        <input type="text" class="form-control" id="requestPurpose" name="request_purpose"
                            placeholder="e.g. For Marriage, School, etc." required>
                    </div>

                    <!-- Remarks (Optional) -->
                    <div class="mb-3">
                        <label for="remarks" class="form-label">Remarks (Optional)</label>
                        <textarea class="form-control" id="remarks" name="remarks" rows="3"
                            placeholder="Any special instructions or notes"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Add Record Modal -->
<div class="modal fade" id="addRecordModal" tabindex="-1" aria-labelledby="addRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRecordModalLabel">Add Daily Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addRecordForm" method="POST" action="add_record.php">
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-control" id="type" name="type" required
                            onchange="toggleCategoryOptions('add')">
                            <option value="Income">Income</option>
                            <option value="Expense">Expense</option>
                        </select>
                    </div>

                    <div class="mb-3" id="categoryContainer">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="" disabled selected>Select Category</option>
                            <!-- Income Categories -->
                            <optgroup label="Income Categories" id="incomeCategories">
                                <option value="Donation">Donation</option>
                                <option value="Tithe">Tithe</option>
                                <option value="Offerings">Offerings</option>
                            </optgroup>

                            <!-- Expense Categories -->
                            <optgroup label="Expense Categories" id="expenseCategories">
                                <option value="Operational Costs">Operational Costs</option>
                                <option value="Mission Programs">Mission Programs</option>
                                <option value="Worship Activities">Worship Activities</option>
                                <option value="Building Projects">Building Projects</option>
                            </optgroup>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" step="0.01" class="form-control" id="amount" name="amount" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Record</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Edit Record Modal -->
<div class="modal fade" id="editRecordModal" tabindex="-1" aria-labelledby="editRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRecordModalLabel">Edit Daily Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="edit_record.php" method="POST">
                    <input type="hidden" name="id" id="editRecordId">
                    <div class="mb-3">
                        <label for="editType" class="form-label">Type</label>
                        <select class="form-control" id="editType" name="type" required
                            onchange="toggleCategoryOptions('edit')">
                            <option value="Income">Income</option>
                            <option value="Expense">Expense</option>
                        </select>
                    </div>
                    <div class="mb-3" id="editCategoryContainer">
                        <label for="editCategory" class="form-label">Category</label>
                        <select class="form-control" id="editCategory" name="category" required>
                            <option value="" disabled selected>Select Category</option>
                            <!-- Income Categories -->
                            <optgroup label="Income Categories" id="editIncomeCategories">
                                <option value="Donation">Donation</option>
                                <option value="Tithe">Tithe</option>
                                <option value="Offerings">Offerings</option>
                            </optgroup>

                            <!-- Expense Categories -->
                            <optgroup label="Expense Categories" id="editExpenseCategories">
                                <option value="Operational Costs">Operational Costs</option>
                                <option value="Mission Programs">Mission Programs</option>
                                <option value="Worship Activities">Worship Activities</option>
                                <option value="Building Projects">Building Projects</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editDescription" class="form-label">Description</label>
                        <input type="text" class="form-control" id="editDescription" name="description" required>
                    </div>
                    <div class="mb-3">
                        <label for="editAmount" class="form-label">Amount</label>
                        <input type="number" class="form-control" id="editAmount" name="amount" step="0.01" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Record</button>
                </form>
            </div>
        </div>
    </div>
</div>