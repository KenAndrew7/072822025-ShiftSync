<?php
require_once 'db.php';
require_once 'auth.php';
requireLogin();

$result = $conn->query("SELECT * FROM projects");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Projects - ShiftSync</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <h1>Projects</h1>
  <a href="dashboard.php">← Back to Dashboard</a> |
  <a href="create_project.php">+ Add Project</a>
  <table border="1" cellpadding="10">
    <tr>
      <th>Name</th>
      <th>Description</th>
      <th>Actions</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['description']) ?></td>
        <td>
          <a href="edit_project.php?id=<?= $row['id'] ?>">Edit</a> |
          <a href="delete_project.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this project?');">Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>