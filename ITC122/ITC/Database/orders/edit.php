<?php include '../db.php';

$order_id = $_GET['order_id'];

$stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = :order_id");
$stmt->execute([':order_id' => $order_id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $payment = $_POST['payment'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE orders 
    SET  
    payment=:payment, 
    status=:status
    WHERE order_id=:order_id");
    $stmt->execute([
        ':payment' => $payment,
        ':status' => $status,
        ':order_id' => $order_id
    
    ]);

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">

<h2>Edit Product</h2>

<form method="POST">
    <h6>Payment<h6>
        <select name="payment" class="form-control mb-2">
    <?php
    $pay_stmt = $conn->prepare("SELECT * FROM payment_tb");
    $pay_stmt->execute();
    $payment = $pay_stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($payment as $pay) {
        $selected = ($pay['payment_id'] == $row['payment']) ? "selected" : "";
        echo "<option value='{$pay['payment_id']}' $selected>{$pay['payment_name']}</option>";
    }
    ?>
    </select>
    <h6>Status<h6>
        <select name="status" class="form-control mb-2">
    <?php
    $sta_stmt = $conn->prepare("SELECT * FROM status_tb");
    $sta_stmt->execute();
    $status = $sta_stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($status as $sta) {
        $selected = ($sta['status_id'] == $row['status']) ? "selected" : "";
        echo "<option value='{$sta['status_id']}' $selected>{$sta['status_name']}</option>";
    }
    ?>
    </select>
    <button class="btn btn-warning">Update</button>
</form>

</body>
</html>