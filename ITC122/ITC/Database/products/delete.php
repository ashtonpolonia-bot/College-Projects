<?php include '../db.php';

$product_id = $_GET['product_id'];

$stmt = $conn->prepare("DELETE FROM products WHERE product_id = :product_id");
$stmt->execute([':product_id' => $product_id]);

header("Location: index.php");
?>