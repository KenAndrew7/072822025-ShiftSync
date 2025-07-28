<?php
require_once 'db.php';
require_once 'auth.php';
requireLogin();

$projects = $conn->query("SELECT * FROM projects");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $role = $_POST['role'];
  $assigned_project_id = $_POST['assigned_project_id'] ?: null;

  $stmt = $conn->prepare("INSERT INTO resources (name, role, assigned_project_id) VALUES (?, ?, ?)");
  $stmt->bind_param("ssi", $name, $role, $assigned_project_id);
  $stmt->execute();

  header('Location: resources.php');
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Resource - ShiftSync</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <h1>Add Resource</h1>
  <form method="POST">
    <label>Name:</label>
    <input type="text" name="name" required><br>
    <label>Role:</label>
    <input type="text" name="role"><br>
    <label>Assigned Project:</label>
    <select name="assigned_project_id">
      <option value="">-- None --</option>
      <?php while($p = $projects->fetch_assoc()): ?>
        <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['name']) ?></option>
      <?php endwhile; ?>
    </select><br>
    <button type="submit">Add Resource</button>
  </form>
</body>
</html>