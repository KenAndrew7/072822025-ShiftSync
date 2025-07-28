<?php
require_once 'db.php';
require_once 'auth.php';
requireLogin();

$id = $_GET['id'];

$projects = $conn->query("SELECT * FROM projects");

$stmt = $conn->prepare("SELECT * FROM time_entries WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$entry = $stmt->get_result()->fetch_assoc();

if (!$entry) {
  echo "Time entry not found.";
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $project_id = $_POST['project_id'];
  $date = $_POST['date'];
  $hours = $_POST['hours'];
  $description = $_POST['description'];

  $stmt = $conn->prepare("UPDATE time_entries SET project_id=?, date=?, hours=?, description=? WHERE id=?");
  $stmt->bind_param("isdsi", $project_id, $date, $hours, $description, $id);
  $stmt->execute();

  header('Location: time_entries.php');
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Time Entry - ShiftSync</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <h1>Edit Time Entry</h1>
  <form method="POST">
    <label>Project:</label>
    <select name="project_id" required>
      <?php while($p = $projects->fetch_assoc()): ?>
        <option value="<?= $p['id'] ?>" <?= $p['id'] == $entry['project_id'] ? 'selected' : '' ?>>
          <?= htmlspecialchars($p['name']) ?>
        </option>
      <?php endwhile; ?>
    </select><br>
    <label>Date:</label>
    <input type="date" name="date" value="<?= $entry['date'] ?>" required><br>
    <label>Hours:</label>
    <input type="number" name="hours" step="0.1" value="<?= $entry['hours'] ?>" required><br>
    <label>Description:</label>
    <textarea name="description"><?= htmlspecialchars($entry['description']) ?></textarea><br>
    <button type="submit">Update Entry</button>
  </form>
</body>
</html>