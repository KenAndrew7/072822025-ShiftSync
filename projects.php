<?php
include 'db.php';

$result = $db->query("SELECT * FROM projects");
?>

<h1>Projects</h1>
<a href="create_project_form.php">Add Project</a>
<ul>
<?php while ($row = $result->fetchArray(SQLITE3_ASSOC)): ?>
  <li><?php echo htmlspecialchars($row['name']); ?> - <?php echo htmlspecialchars($row['description']); ?></li>
<?php endwhile; ?>
</ul>
