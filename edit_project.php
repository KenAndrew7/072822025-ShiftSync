<?php
require_once 'db.php';
require_once 'auth.php';
requireLogin();

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM projects WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$project = $stmt->get_result()->fetch_assoc();
if (!$project) {
  echo "Project not found.";
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = trim($_POST['name']);
  $description = trim($_POST['description']);

  $stmt = $conn->prepare("UPDATE projects SET name=?, description=? WHERE id=?");
  $stmt->bind_param("ssi", $name, $description, $id);
  $stmt->execute();

  header('Location: projects.php');
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Project - ShiftSync</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <h1>Edit Project</h1>
  <form method="POST">
    <input type="text" name="name" value="<?= htmlspecialchars($project['name']) ?>" required><br>
    <textarea name="description"><?= htmlspecialchars($project['description']) ?></textarea><br>
    <button type="submit">Update Project</button>
  </form>
</body>
</html>