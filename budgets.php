<?php
require_once 'db.php';
require_once 'auth.php';
requireLogin();

$result = $conn->query("
  SELECT b.*, p.name AS project_name
  FROM budgets b
  JOIN projects p ON b.project_id = p.id
");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Budgets - ShiftSync</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <h1>Budgets & Cost Tracking</h1>
  <a href="dashboard.php">← Back to Dashboard</a> |
  <a href="create_budget.php">+ Add Budget</a>
  <table border="1" cellpadding="10">
    <tr>
      <th>Project</th>
      <th>Planned Amount</th>
      <th>Spent Amount</th>
      <th>Notes</th>
      <th>Actions</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['project_name']) ?></td>
        <td>$<?= number_format($row['planned_amount'], 2) ?></td>
        <td>$<?= number_format($row['spent_amount'], 2) ?></td>
        <td><?= htmlspecialchars($row['notes']) ?></td>
        <td>
          <a href="edit_budget.php?id=<?= $row['id'] ?>">Edit</a> |
          <a href="delete_budget.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this budget?');">Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>