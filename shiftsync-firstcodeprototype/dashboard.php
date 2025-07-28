<?php
require_once 'db.php';
require_once 'auth.php';
requireLogin();

// Total Projects
$result = $conn->query("SELECT COUNT(*) AS total FROM projects");
$total_projects = $result->fetch_assoc()['total'];

// Total Planned Budget
$result = $conn->query("SELECT SUM(planned_amount) AS total FROM budgets");
$total_planned = $result->fetch_assoc()['total'] ?? 0;

// Total Spent Budget
$result = $conn->query("SELECT SUM(spent_amount) AS total FROM budgets");
$total_spent = $result->fetch_assoc()['total'] ?? 0;

// Total Hours Logged
$result = $conn->query("SELECT SUM(hours) AS total FROM time_entries");
$total_hours = $result->fetch_assoc()['total'] ?? 0;

?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard - ShiftSync</title>
  <link rel="stylesheet" href="assets/style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <h1>Welcome to ShiftSync Dashboard</h1>
  <p><a href="logout.php">Logout</a></p>

  <div style="width: 600px;">
    <canvas id="overviewChart"></canvas>
  </div>

  <ul>
    <li><a href="projects.php">Manage Projects</a></li>
    <li><a href="time_entries.php">Manage Time Entries</a></li>
    <li><a href="resources.php">Manage Resources</a></li>
    <li><a href="budgets.php">Manage Budgets</a></li>
  </ul>

  <script>
    const ctx = document.getElementById('overviewChart').getContext('2d');
    const overviewChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Projects', 'Planned Budget', 'Spent Budget', 'Hours Logged'],
        datasets: [{
          label: 'Project Performance',
          data: [
            <?= $total_projects ?>,
            <?= $total_planned ?>,
            <?= $total_spent ?>,
            <?= $total_hours ?>
          ],
          backgroundColor: [
            '#007bff',
            '#28a745',
            '#dc3545',
            '#ffc107'
          ]
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            display: false
          }
        },
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
</body>
</html>