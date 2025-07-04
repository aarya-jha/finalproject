<?php
session_start();
include 'db.php';

if (isset($_GET['product_id']) && isset($_SESSION['user_id'])) {
  $pid = $_GET['product_id'];
  $uid = $_SESSION['user_id'];
  $conn->query("DELETE FROM cart WHERE user_id = $uid AND product_id = $pid");
}

header("Location: cart.php");
exit();
