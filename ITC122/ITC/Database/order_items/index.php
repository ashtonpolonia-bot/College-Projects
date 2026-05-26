<?php include '../db.php'; ?>

<!DOCTYPE html>
<html>
<head>
<title>PDO CRUD</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .container {
        max-width: 75%;
    }
    table {
        width: 75%;
    }
    td {
        white-space: nowrap;
    }
    

</style>
</head>

<body class="container mt-4">

<table class="table table-bordered table-hover">


<h2>Item Orders List</h2>
<a href="add.php" class="btn btn-primary me-3">Add Item Orders</a>
<a href="../customer_raw/index.php" class="btn btn-primary me-3">Back</a>
<table class="table table-bordered">
<tr>
    <th>Order Items ID</th>
    <th>Order ID</th>
    <th>Quantity</th>
    <th>Unit Price</th>
    <th>Total Amount</th>
    <th>Product Name</th>
</tr>

<?php
$stmt = $conn->prepare("SELECT
        order_items.*,
        orders.order_id,
        products.unit_price,
        products.product_name,
        (order_items.quantity * products.unit_price) AS total_amount
     FROM order_items
     JOIN products ON order_items.product_id = products.product_id
     JOIN orders ON order_items.order_id = orders.order_id");
$stmt->execute();
$orders_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($orders_items as $row) {
    echo "<tr>
        <td>{$row['order_item_id']}</td>
        <td>{$row['order_id']}</td>
        <td>{$row['quantity']}</td>
        <td>{$row['unit_price']}</td>
	    <td>{$row['total_amount']}</td>
        <td>{$row['product_name']}</td>

        <div>
        <td>
            <a href='edit.php?order_item_id={$row['order_item_id']}' class='btn btn-warning btn-sm'>Edit</a>
            <a href='delete.php?order_item_id={$row['order_item_id']}' class='btn btn-danger btn-sm'>Delete</a>
        </td>
    </tr>";
}
?>

</table>

</body>
</html>