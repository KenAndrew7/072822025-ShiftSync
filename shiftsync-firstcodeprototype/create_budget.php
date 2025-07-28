<?php
require_once 'db.php';
require_once 'auth.php';
requireLogin();

$projects = $conn->query("SELECT * FROM projects");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $project_id = $_POST['project_id'];
  $planned_amount = $_POST['planned_amount'];
  $spent_amount = $_POST['spent_amount'];
  $notes = $_POST['notes'];

  $stmt = $conn->prepare("INSERT INTO budgets (project_id, planned_amount, spent_amount, notes) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("idds", $project_id, $planned_amount, $spent_amount, $notes);
  $stmt->execute();

  header('Location: budgets.php');
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Budget - ShiftSync</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <h1>Add Budget</h1>
  <form method="POST">
    <label>Project:</label>
    <select name="project_id" required>
      <?php while($p = $projects->fetch_assoc()): ?>
        <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['name']) ?></option>
      <?php endwhile; ?>
    </select><br>
    <label>Planned Amount:</label>
    <input type="number" name="planned_amount" step="0.01" required><br>
    <label>Spent Amount:</label>
    <input type="number" name="spent_amount" step="0.01" value="0"><br>
    <label>Notes:</label>
    <textarea name="notes"></textarea><br>
    <button type="submit">Add Budget</button>
  </form>
</body>
</html>