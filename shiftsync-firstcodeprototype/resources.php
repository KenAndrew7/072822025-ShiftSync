<?php
require_once 'db.php';
require_once 'auth.php';
requireLogin();

$result = $conn->query("
  SELECT r.*, p.name AS project_name
  FROM resources r
  LEFT JOIN projects p ON r.assigned_project_id = p.id
");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Resources - ShiftSync</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <h1>Resources</h1>
  <a href="dashboard.php">← Back to Dashboard</a> |
  <a href="create_resource.php">+ Add Resource</a>
  <table border="1" cellpadding="10">
    <tr>
      <th>Name</th>
      <th>Role</th>
      <th>Assigned Project</th>
      <th>Actions</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['role']) ?></td>
        <td><?= htmlspecialchars($row['project_name'] ?? 'Unassigned') ?></td>
        <td>
          <a href="edit_resource.php?id=<?= $row['id'] ?>">Edit</a> |
          <a href="delete_resource.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this resource?');">Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>