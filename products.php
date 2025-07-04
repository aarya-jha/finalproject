<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Products</title>
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
  <h2>Products</h2>
 

<div style="text-align: right; margin: 10px 0;">
  <a href="cart.php">
   <button style="padding: 10px 15px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer;">
      View Cart
  </a>
</div>

  <?php
  // Fetch all products
  $res = $conn->query("SELECT * FROM products");
  while ($row = $res->fetch_assoc()) {
    echo "<div class='product'>
            <img src='{$row['image']}' alt='{$row['name']}'>
            <h3>{$row['name']} - ₹{$row['price']}</h3>
            <p>{$row['description']}</p>";

    echo "<form method='POST'>
            <input type='hidden' name='pid' value='{$row['id']}'>
            <button type='submit' onclick='addedToCart()'>Add to Cart</button>
          </form>";
    echo "</div>";
  }

  // Handle Add to Cart POST
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
    $pid = $_POST['pid'];
    $uid = $_SESSION['user_id'];
    $conn->query("INSERT INTO cart (user_id, product_id) VALUES ($uid, $pid)");
    echo "<p style='color:green;'>Added to cart!</p>";
  }
  ?>
</div>
<script src="script.js"></script>
</body>
</html>

