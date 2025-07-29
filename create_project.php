<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $description = $_POST['description'];

  $stmt = $db->prepare("INSERT INTO projects (name, description) VALUES (:name, :description)");
  $stmt->bindValue(':name', $name, SQLITE3_TEXT);
  $stmt->bindValue(':description', $description, SQLITE3_TEXT);
  $stmt->execute();

  header("Location: projects.php");
}
?>
