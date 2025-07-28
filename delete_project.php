<?php
require_once 'db.php';
require_once 'auth.php';
requireLogin();

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM projects WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header('Location: projects.php');
exit();