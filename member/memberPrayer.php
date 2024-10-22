<? include ('memberHeader.php');
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