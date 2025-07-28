<?php
require_once 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);

  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result()->fetch_assoc();

  if ($result && password_verify($password, $result['password'])) {
    $_SESSION['user_id'] = $result['id'];
    header('Location: dashboard.php');
    exit();
  } else {
    $error = "Invalid login!";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login - ShiftSync</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <h1>Login</h1>
  <?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>
  <form method="POST">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Login</button>
  </form>
  <p>New? <a href="signup.php">Sign up here</a></p>
</body>
</html>