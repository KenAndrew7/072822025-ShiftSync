<?php
require_once 'db.php';
require_once 'auth.php';
requireLogin();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = trim($_POST['name']);
  $description = trim($_POST['description']);

  $stmt = $conn->prepare("INSERT INTO projects (name, description) VALUES (?, ?)");
  $stmt->bind_param("ss", $name, $description);
  $stmt->execute();

  header('Location: projects.php');
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Project - ShiftSync</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <h1>Add Project</h1>
  <form method="POST">
    <input type="text" name="name" placeholder="Project Name" required><br>
    <textarea name="description" placeholder="Description"></textarea><br>
    <button type="submit">Add Project</button>
  </form>
</body>
</html>