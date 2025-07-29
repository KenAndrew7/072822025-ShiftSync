<?php
// SQLite connection
$db = new SQLite3('shiftsync.sqlite');

// Check if the tables exist, if not, create them
$db->exec("CREATE TABLE IF NOT EXISTS users (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  username TEXT UNIQUE,
  password TEXT
)");

$db->exec("CREATE TABLE IF NOT EXISTS projects (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT,
  description TEXT
)");

$db->exec("CREATE TABLE IF NOT EXISTS time_entries (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  project_id INTEGER,
  date TEXT,
  hours REAL,
  description TEXT,
  FOREIGN KEY (project_id) REFERENCES projects(id)
)");

$db->exec("CREATE TABLE IF NOT EXISTS resources (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT,
  role TEXT,
  assigned_project_id INTEGER,
  FOREIGN KEY (assigned_project_id) REFERENCES projects(id)
)");

$db->exec("CREATE TABLE IF NOT EXISTS budgets (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  project_id INTEGER,
  planned_amount REAL,
  spent_amount REAL,
  notes TEXT,
  FOREIGN KEY (project_id) REFERENCES projects(id)
)");
?>
