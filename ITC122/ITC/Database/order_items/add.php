<?php include '../db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];
    $quantity = $_POST['quantity'];
    $product_id = $_POST['product_id'];


    $stmt = $conn->prepare("INSERT INTO order_items (order_id, quantity, product_id
    )
    VALUES (:order_id, :quantity, :product_id)");
    $stmt->execute([
        ':order_id' => $order_id,
        ':quantity' => $quantity,
        ':product_id' => $product_id
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

<h2>Add Orders</h2>

<form method="POST">
    <select name="order_id" class="form-control mb-2" required>
        <option value="">-- Select Orders --</option>
     <?php
    $ord_stmt = $conn->prepare("SELECT * FROM orders");
    $ord_stmt->execute();
    $orders = $ord_stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($orders as $ord) {
        echo "<option value='{$ord['order_id']}'>{$ord['order_id    ']}</option>";
    }
    ?>
    </select>
    <input class="form-control mb-2" name="quantity" placeholder="Quantity" required>
    <select name="product_id" class="form-control mb-2" required>
        <option value="">-- Select Product --</option>
     <?php
    $prd_stmt = $conn->prepare("SELECT * FROM products ORDER BY product_name ASC");
    $prd_stmt->execute();
    $products = $prd_stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($products as $prd) {
        echo "<option value='{$prd['product_id']}' data-price='{[$prd'unit_price']}'>{$prd['product_name']}</option>";
    }
    ?>
    </select>
    
    <button type="submit" class="btn btn-success">Save Product</button>
</form>
  
</body>
</html>