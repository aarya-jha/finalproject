<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $conn->query("INSERT INTO users (username, password) VALUES ('$username', '$password')");
  echo "Registered successfully! <a href='login.php'>Login</a>";
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
</head>

<body>
<nav>
  <a href="index.php">Home</a>
  <a href="register.php">Register</a>
  <a href="login.php">Login</a>
  <a href="products.php">products</a>
</nav>
<div class="container">
  <h2>Register</h2>
  <form method="POST" id="registerForm" onsubmit="return validateForm('registerForm')">
    Username: <input name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Register</button>
  </form>
</div>
<script src="script.js"></script>
</body>
</html>
