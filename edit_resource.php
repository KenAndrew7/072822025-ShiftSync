<?php
require_once 'db.php';
require_once 'auth.php';
requireLogin();

$id = $_GET['id'];

$projects = $conn->query("SELECT * FROM projects");

$stmt = $conn->prepare("SELECT * FROM resources WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resource = $stmt->get_result()->fetch_assoc();

if (!$resource) {
  echo "Resource not found.";
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $role = $_POST['role'];
  $assigned_project_id = $_POST['assigned_project_id'] ?: null;

  $stmt = $conn->prepare("UPDATE resources SET name=?, role=?, assigned_project_id=? WHERE id=?");
  $stmt->bind_param("ssii", $name, $role, $assigned_project_id, $id);
  $stmt->execute();

  header('Location: resources.php');
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Resource - ShiftSync</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <h1>Edit Resource</h1>
  <form method="POST">
    <label>Name:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($resource['name']) ?>" required><br>
    <label>Role:</label>
    <input type="text" name="role" value="<?= htmlspecialchars($resource['role']) ?>"><br>
    <label>Assigned Project:</label>
    <select name="assigned_project_id">
      <option value="">-- None --</option>
      <?php while($p = $projects->fetch_assoc()): ?>
        <option value="<?= $p['id'] ?>" <?= ($p['id'] == $resource['assigned_project_id']) ? 'selected' : '' ?>>
          <?= htmlspecialchars($p['name']) ?>
        </option>
      <?php endwhile; ?>
    </select><br>
    <button type="submit">Update Resource</button>
  </form>
</body>
</html>