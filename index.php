<?php
// Redirect to login if not logged in
session_start();

if (isset($_SESSION['user_id'])) {
  header("Location: dashboard.php");
} else {
  header("Location: login.php");
}
exit();
?>
