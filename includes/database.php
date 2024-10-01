<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "bcifws";

$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}