<?php include '../db.php';

$order_id = $_GET['order_id'];

$stmt = $conn->prepare("DELETE FROM orders WHERE order_id = :order_id");
$stmt->execute([':order_id' => $order_id]);

header("Location: index.php");
?>