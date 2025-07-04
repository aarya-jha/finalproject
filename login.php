<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $u = $_POST['username'];
  $p = $_POST['password'];
  $res = $conn->query("SELECT * FROM users WHERE username='$u'");
  $row = $res->fetch_assoc();

  if ($row && password_verify($p, $row['password'])) {
    $_SESSION['user_id'] = $row['id'];
    header("Location: products.php");
    exit();
  } else {
    $error = "Login failed. Invalid username or password.";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
</head>

<body>
<nav>
  <a href="index.php">Home</a>
  <a href="register.php">Register</a>
  <a href="login.php">Login</a>
  <a href="products.php">Products</a>
</nav>

<div class="container">
  <h2>Login</h2>
  <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
  <<form method="POST" id="loginForm" onsubmit="return validateForm('loginForm')">
    <label>Username:</label><br>
    <input name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
  </form>
</div>
<script src="script.js"></script>
</body>
</html>
