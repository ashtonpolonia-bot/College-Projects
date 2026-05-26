<?php include '../db.php';

$ID = $_GET['ID'];

$stmt = $conn->prepare("DELETE FROM customer_raw WHERE ID = :ID");
$stmt->execute([':ID' => $ID]);

header("Location: index.php");
?>