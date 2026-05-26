<?php include '../db.php';

$order_item_id = $_GET['order_item_id'];

$stmt = $conn->prepare("DELETE FROM order_items WHERE order_item_id = :order_item_id");
$stmt->execute([':order_item_id' => $order_item_id]);

header("Location: index.php");
?>