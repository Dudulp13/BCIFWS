<?php
// Include header and database connection
include("header.php");
include("../includes/database.php");

// Fetch users from the database using prepared statements
$query = "SELECT * FROM users";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
?>


<?php
// Display message if available
if (isset($_GET['message']) && isset($_GET['alertType'])) {
    echo '<div class="alert fs-5 text-light alert-' . htmlspecialchars($_GET['alertType']) . ' alert-dismissible fade show" role="alert">';
    echo htmlspecialchars($_GET['message']);
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="material-icons">close </i></button>
              </div>';
    echo '</div>';
}
?>


<style>
/* Add necessary styles */
.modal-content {
    border-radius: 15px;
}

.form-label {
    font-weight: bold;
    color: #333;
}

.form-control {
    color: #333;
    background-color: #E8F0FE;
}

.form-control:focus {
    background-color: #F5F5F5;
    outline: none;
}

.custom-text-color {
    color: #E0FFFF;
}


.user-image {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    margin: 20px auto;
}
</style>

<div class="container-fluid mt-5">
    <h2 class="mb-4">Users List</h2>
    <div class="col-md-12">
        <div class="form-floating mb-4">
            <input type="text" id="searchInput" class="form-control px-3" placeholder="Search user..."
                aria-label="Search" aria-describedby="basic-addon1">
            <label for="searchInput" class="fs-4 px-3 d-flex justify-content-start align-items-center text-dark">
                Search
                <i class="material-icons ms-2">search</i>
            </label>
        </div>

    </div>


    <div class="row" id="usersContainer">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
        <div class="col-md-4 mb-3 user-card" data-username="<?php echo htmlspecialchars($row['username']); ?>"
            data-email="<?php echo htmlspecialchars($row['email']); ?>"
            data-first_name="<?php echo htmlspecialchars($row['first_name']); ?>"
            data-last_name="<?php echo htmlspecialchars($row['last_name']); ?>"
            data-address="<?php echo htmlspecialchars($row['address']); ?>"
            data-role="<?php echo htmlspecialchars($row['role']); ?>"
            data-ministry="<?php echo htmlspecialchars($row['ministry']); ?>"
            data-contact="<?php echo htmlspecialchars($row['contact']); ?>"
            data-birthday="<?php echo htmlspecialchars($row['birthday']); ?>"
            data-pp_url="<?php echo htmlspecialchars($row['pp_url']); ?>">



            <div class="card">
                <div class="row g-0">
                    <div class="col-md-4 bg-dark text-light text-center">
                        <img src="<?php echo htmlspecialchars($row['pp_url']); ?>" class="user-image"
                            alt="Profile Picture">
                        <p class="card-title username custom-text-color">
                            <strong>@</strong><?php echo htmlspecialchars($row['username']); ?>
                        </p>

                        <p class="card-text"><strong>ID:</strong> <?php echo htmlspecialchars($row['id']); ?></p>
                        <p class="card-text"><strong>Role:</strong> <?php echo htmlspecialchars($row['role']); ?>
                        </p>
                        <p class="card-text"><strong>Ministry:</strong>
                            <?php echo htmlspecialchars($row['ministry']); ?></p>


                    </div>
                    <div class="col-md-8">
                        <div class="card-body text-dark">
                            <p><strong>Name:</strong>
                                <?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></p>
                            <p><strong>Email:</strong> <span
                                    class="email"><?php echo htmlspecialchars($row['email']); ?></span></p>
                            <p><strong>Address:</strong> <span
                                    class="address"><?php echo htmlspecialchars($row['address']); ?></span></p>
                            <p><strong>Contact:</strong> <span
                                    class="contact"><?php echo htmlspecialchars($row['contact']); ?></span></p>
                            <p><strong>Birthday:</strong> <span
                                    class="birthday"><?php echo date('M j, Y', strtotime($row['birthday'])); ?></span>
                            </p>
                            <p><strong>Joined:</strong> <span
                                    class="joined"><?php echo date('M j, Y', strtotime($row['created_at'])); ?></span>
                            </p>


                            <div class="d-flex justify-content-between mt-auto">
                                <button class="btn btn-outline-danger btn-sm deleteBtn"
                                    data-user-id="<?php echo htmlspecialchars($row['id']); ?>">Delete</button>
                                <button class="btn btn-outline-info btn-sm editBtn"
                                    data-user-id="<?php echo htmlspecialchars($row['id']); ?>">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?php
            }
        } else {
            echo "<p class='text-center'>No users found.</p>";
        }
        ?>
    </div>
</div>


<!-- Pagination -->
<div class="d-flex justify-content-center mt-4">
    <button class="btn btn-primary" id="prevPage" disabled>Previous</button>
    <span id="pageInfo" class="mx-2">Page 1</span>
    <button class="btn btn-primary" id="nextPage">Next</button>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editUserForm" method="POST" action="edit_user.php" enctype="multipart/form-data">
                <!-- Add enctype for file upload -->
                <input type="hidden" id="edit_user_id" name="id" value="">
                <input type="hidden" id="edit_pp_url" name="pp_url" value="">

                <div class="modal-header bg-dark">
                    <h5 class="modal-title fs-5 fw-bold text-light" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body my-3">
                    <div class="row">
                        <!-- Existing input fields for user data -->
                        <div class="col-md-12 mb-3">
                            <label for="edit_username" class="form-label">Username</label>
                            <input type="text" class="form-control ps-3" id="edit_username" name="username" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control ps-3" id="edit_first_name" name="first_name"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control ps-3" id="edit_last_name" name="last_name" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="edit_address" class="form-label">Address</label>
                            <input type="text" class="form-control ps-3" id="edit_address" name="address">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_email" class="form-label">Email</label>
                            <input type="email" class="form-control ps-3" id="edit_email" name="email" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_contact" class="form-label">Contact</label>
                            <input type="text" class="form-control ps-3" id="edit_contact" name="contact">
                        </div>
                    </div>
                    <div class="row">
                        <!-- Existing input fields for role, ministry, birthday -->
                        <div class="col-md-6 mb-3">
                            <label for="edit_role" class="form-label">Role</label>
                            <select class="form-select ps-3" id="edit_role" name="role" required>
                                <option value="">Select Role</option>
                                <option value="Admin">Admin</option>
                                <option value="Member">Member</option>
                                <option value="Ministry Leader">Ministry Leader</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_ministry" class="form-label">Ministry</label>
                            <select class="form-select ps-3" id="edit_ministry" name="ministry" required>
                                <option value="">Select Ministry</option>
                                <option value="Children">Children</option>
                                <option value="Dance">Dance</option>
                                <option value="Media">Media</option>
                                <option value="Usher">Usher</option>
                                <option value="Youth">Youth</option>
                                <option value="Outreach">Outreach</option>
                                <option value="Worship">Worship</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_birthday" class="form-label">Birthday</label>
                            <input type="date" class="form-control ps-3" id="edit_birthday" name="birthday">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_pp_url" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" id="edit_pp_url" name="profile_picture"
                                accept="image/*">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-light" id="deleteUserModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="fs-5 text-dark">Are you sure you want to delete this user?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>
</div>



<script>
$(document).ready(function() {

    // Add pagination functionality
    let currentPage = 1;
    const itemsPerPage = 6 // Number of user cards to display per page
    const totalUsers = $('.user-card').length;
    const totalPages = Math.ceil(totalUsers / itemsPerPage);

    function showPage(page) {
        $('.user-card').hide();
        $('.user-card').slice((page - 1) * itemsPerPage, page * itemsPerPage).show();
        $('#pageInfo').text(`Page ${page}`);
        $('#prevPage').prop('disabled', page === 1);
        $('#nextPage').prop('disabled', page === totalPages);
    }

    $('#prevPage').click(function() {
        if (currentPage > 1) {
            currentPage--;
            showPage(currentPage);
        }
    });

    $('#nextPage').click(function() {
        if (currentPage < totalPages) {
            currentPage++;
            showPage(currentPage);
        }
    });

    showPage(currentPage);
});


$(document).ready(function() {
    // Search functionality
    $('#searchInput').on('keyup', function() {
        var searchValue = $(this).val().toLowerCase();

        $('.user-card').each(function() {
            var username = $(this).data('username').toLowerCase();
            var email = $(this).data('email').toLowerCase();
            var firstName = $(this).data('first_name').toLowerCase();
            var lastName = $(this).data('last_name').toLowerCase();
            var role = $(this).data('role').toLowerCase();
            var ministry = $(this).data('ministry').toLowerCase();
            var contact = $(this).data('contact').toLowerCase();

            // Check if any field contains the search value
            if (username.includes(searchValue) ||
                email.includes(searchValue) ||
                firstName.includes(searchValue) ||
                lastName.includes(searchValue) ||
                role.includes(searchValue) ||
                ministry.includes(searchValue) ||
                contact.includes(searchValue)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});

// Edit button functionality
$('.editBtn').click(function() {
    const userId = $(this).data('user-id');
    const parentCard = $(this).closest('.user-card');

    $('#edit_user_id').val(userId);
    $('#edit_username').val(parentCard.data('username'));
    $('#edit_first_name').val(parentCard.data('first_name'));
    $('#edit_last_name').val(parentCard.data('last_name'));
    $('#edit_address').val(parentCard.find('.address').text()); // Address should also have a data attribute
    $('#edit_email').val(parentCard.data('email'));
    $('#edit_contact').val(parentCard.data('contact'));
    $('#edit_birthday').val(parentCard.data(
        'birthday')); // Make sure birthday is in the correct format (YYYY-MM-DD)
    $('#edit_role').val(parentCard.data('role'));
    $('#edit_ministry').val(parentCard.data('ministry'));
    $('#edit_pp_url').val(parentCard.data('pp_url')); // Set the profile picture URL if needed

    $('#editUserModal').modal('show');
});


$(document).ready(function() {
    let userIdToDelete = null;

    // Delete button functionality
    $('.deleteBtn').click(function() {
        userIdToDelete = $(this).data('user-id');
        $('#deleteUserModal').modal('show');
    });

    // Confirm delete button functionality
    $('#confirmDeleteBtn').click(function() {
        if (userIdToDelete) {
            window.location.href = 'delete_user.php?id=' + userIdToDelete;
        }
    });
});
</script>
<?php include("footeradmin.php"); ?>