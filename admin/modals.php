<!-- event Modal---->
<div class="modal fade" id="insertEventModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col">
                    <h1 class="modal-title fs-5">Create New Event</h1>
                </div>
                <div class="col-1 float-end">
                    <button type="button" class="btn" data-bs-dismiss="modal"><i
                            class="material-icons icons-sm opacity-10">close</i></button>
                </div>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <!--form //add css input kg title-->
                    <div class="mb-3 p-2">
                        <label for="eventTitle" class="form-label fs-4">Title</label>
                        <input class="form-control" type="text" name="eventTitle" id="eventTitle"
                            placeholder="Write your event name here">
                    </div>
                    <div class="mb-3 text-bg-light p-2">
                        <label for="eventDesc" class="form-label fs-4">Description</label>
                        <textarea class="form-control" name="eventDesc" id="eventDesc" rows="5"
                            placeholder="Enter your event message here..."></textarea>
                    </div>
                    <div class="col-auto justify-content-evenly d-flex">
                        <div class="col-6 mb-3 p-2">
                            <label for="timeDate" class="form-label fs-4">Time</label>
                            <input class="form-control" type="time" name="eventTime" id="eventTime">
                        </div>
                        <div class="col-6 mb-3 p-2">
                            <label for="timeDate" class="form-label fs-4">Date</label>
                            <input class="form-control" type="date" name="eventDate" id="eventDate">
                        </div>
                    </div>
                    <div class="mb-3 text-bg-light p-2">
                        <label for="eventLoc" class="form-label fs-4">Location</label>
                        <input class="form-control" type="text" name="eventLoc" id="eventLoc">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="save_event" id="save_event" class="btn btn-info">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Announcement Modal -->
<div class="modal fade" id="insertAnnounceModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Create New Announcement</h1>
                <button type="button" class="btn" data-bs-dismiss="modal"><i
                        class="material-icons icons-sm opacity-10">close</i></button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <div class="mb-3 p-2">
                        <div class="form-group row">
                            <div class="col-4">
                                <select class="form-select fs-6 px-3 border border-info" id="category" name="category">
                                    <option value="" disabled selected>Choose Category</option>
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
                        </div>
                    </div>

                    <div class="mb-3 p-2">
                        <div class="row">
                            <label for="announceMsg" class="col-form-label col-2 fs-5">Message</label>
                            <div class="col-12 text-bg-light fs-5">
                                <textarea class="form-control" name="announceMsg" id="announceMsg" rows="5"
                                    placeholder="Enter your announcement message here..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 p-2">
                        <label for="announceDt" class="form-label fs-4">Date and Time</label>
                        <input class="form-control" type="datetime-local" name="announceDt" id="announceDt">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="save_announce" id="save_announce" class="btn btn-info">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>