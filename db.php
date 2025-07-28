<?php
$servername = "shiftsync.infinityfreeapp.com";
$username = "if0_39575199";
$password = "ShiftSync2025";
$dbname = "if0_39575199_shiftsync";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>