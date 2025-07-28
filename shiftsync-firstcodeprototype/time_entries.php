<?php
require_once 'db.php';
require_once 'auth.php';
requireLogin();

$result = $conn->query("
  SELECT t.*, p.name AS project_name
  FROM time_entries t
  JOIN projects p ON t.project_id = p.id
");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Time Tracking - ShiftSync</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <h1>Time Tracking & Billing</h1>
  <a href="dashboard.php">← Back to Dashboard</a> |
  <a href="create_time.php">+ Add Time Entry</a>
  <table border="1" cellpadding="10">
    <tr>
      <th>Project</th>
      <th>Date</th>
      <th>Hours</th>
      <th>Description</th>
      <th>Actions</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['project_name']) ?></td>
        <td><?= htmlspecialchars($row['date']) ?></td>
        <td><?= htmlspecialchars($row['hours']) ?></td>
        <td><?= htmlspecialchars($row['description']) ?></td>
        <td>
          <a href="edit_time.php?id=<?= $row['id'] ?>">Edit</a> |
          <a href="delete_time.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this entry?');">Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>