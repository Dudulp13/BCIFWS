<?php
include "../includes/database.php";


if (isset($_POST["save_event"])) {
// validate + anti sql inject
$eventName = $conn->real_escape_string($_POST["eventTitle"]);
$eventDesc = $conn->real_escape_string($_POST["eventDesc"]);
$eventTime = $conn->real_escape_string($_POST["eventTime"]);
$eventDate = $conn->real_escape_string($_POST["eventDate"]);
$eventLoc = $conn->real_escape_string($_POST["eventLoc"]);

// db query
$insert_query = "INSERT INTO `events` (`title`, `description`, `time`, `date`, `location`)
VALUES ('$eventName', '$eventDesc', '$eventTime', '$eventDate', '$eventLoc')";

if (mysqli_query($conn, $insert_query)) {

$_SESSION['status'] = "Event successfully added!";
} else {
$_SESSION['status'] = "Failed to add event: " . $conn->error;
}

}