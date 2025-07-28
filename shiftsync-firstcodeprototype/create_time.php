<?php
require_once 'db.php';
require_once 'auth.php';
requireLogin();

$projects = $conn->query("SELECT * FROM projects");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $project_id = $_POST['project_id'];
  $date = $_POST['date'];
  $hours = $_POST['hours'];
  $description = $_POST['description'];

  $stmt = $conn->prepare("INSERT INTO time_entries (project_id, date, hours, description) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("isds", $project_id, $date, $hours, $description);
  $stmt->execute();

  header('Location: time_entries.php');
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Time Entry - ShiftSync</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <h1>Add Time Entry</h1>
  <form method="POST">
    <label>Project:</label>
    <select name="project_id" required>
      <?php while($p = $projects->fetch_assoc()): ?>
        <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['name']) ?></option>
      <?php endwhile; ?>
    </select><br>
    <label>Date:</label>
    <input type="date" name="date" required><br>
    <label>Hours:</label>
    <input type="number" name="hours" step="0.1" required><br>
    <label>Description:</label>
    <textarea name="description"></textarea><br>
    <button type="submit">Add Entry</button>
  </form>
</body>
</html>