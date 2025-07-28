<?php
require_once 'db.php';
require_once 'auth.php';
requireLogin();

$id = $_GET['id'];

$projects = $conn->query("SELECT * FROM projects");

$stmt = $conn->prepare("SELECT * FROM budgets WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$budget = $stmt->get_result()->fetch_assoc();

if (!$budget) {
  echo "Budget not found.";
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $project_id = $_POST['project_id'];
  $planned_amount = $_POST['planned_amount'];
  $spent_amount = $_POST['spent_amount'];
  $notes = $_POST['notes'];

  $stmt = $conn->prepare("UPDATE budgets SET project_id=?, planned_amount=?, spent_amount=?, notes=? WHERE id=?");
  $stmt->bind_param("iddsi", $project_id, $planned_amount, $spent_amount, $notes, $id);
  $stmt->execute();

  header('Location: budgets.php');
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Budget - ShiftSync</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <h1>Edit Budget</h1>
  <form method="POST">
    <label>Project:</label>
    <select name="project_id" required>
      <?php while($p = $projects->fetch_assoc()): ?>
        <option value="<?= $p['id'] ?>" <?= ($p['id'] == $budget['project_id']) ? 'selected' : '' ?>>
          <?= htmlspecialchars($p['name']) ?>
        </option>
      <?php endwhile; ?>
    </select><br>
    <label>Planned Amount:</label>
    <input type="number" name="planned_amount" step="0.01" value="<?= $budget['planned_amount'] ?>" required><br>
    <label>Spent Amount:</label>
    <input type="number" name="spent_amount" step="0.01" value="<?= $budget['spent_amount'] ?>"><br>
    <label>Notes:</label>
    <textarea name="notes"><?= htmlspecialchars($budget['notes']) ?></textarea><br>
    <button type="submit">Update Budget</button>
  </form>
</body>
</html>