<?php
session_start();
include 'db.php';

// Enforce login
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$uid = $_SESSION['user_id'];

// Fetch cart data with product details and quantity
$sql = "
  SELECT 
    p.id AS product_id,
    p.name,
    p.description,
    p.price,
    p.image,
    COUNT(c.id) AS quantity
  FROM cart c
  JOIN products p ON c.product_id = p.id
  WHERE c.user_id = $uid
  GROUP BY p.id, p.name, p.description, p.price, p.image
";
$res = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Cart</title>
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
  <h2>Your Shopping Cart</h2>

  <?php if ($res->num_rows > 0): ?>
    <table border="1" cellpadding="10" cellspacing="0" style="width:100%; background-color:#fff;">
      <tr style="background-color:#f2f2f2;">
        <th>Product</th>
        <th>Description</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
        <th>Action</th>
      </tr>
      <?php 
        $grandTotal = 0;
        while ($row = $res->fetch_assoc()):
          $total = $row['price'] * $row['quantity'];
          $grandTotal += $total;
      ?>
      <tr>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['description']) ?></td>
        <td>₹<?= number_format($row['price'], 2) ?></td>
        <td><?= $row['quantity'] ?></td>
        <td>₹<?= number_format($total, 2) ?></td>
        <td><a href="delete_cart.php?product_id=<?= $row['product_id'] ?>">Remove All</a></td>
      </tr>
      <?php endwhile; ?>
      <tr>
        <td colspan="4" style="text-align:right;"><strong>Grand Total:</strong></td>
        <td colspan="2"><strong>₹<?= number_format($grandTotal, 2) ?></strong></td>
      </tr>
    </table>
  <?php else: ?>
    <p>Your cart is empty.</p>
  <?php endif; ?>
</div>
</body>
</html>

