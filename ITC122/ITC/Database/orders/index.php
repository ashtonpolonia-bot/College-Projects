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


<h2>Orders List</h2>
<a href="add.php" class="btn btn-primary me-3">Add Orders</a>
<a href="../customer_raw/index.php" class="btn btn-primary me-3">Back</a>

<table class="table table-bordered">
<tr>
    <th>Order ID</th>
    <th>Last Name</th>
    <th>Total Amount</th>
    <th>Order Date</th>
    <th>Status Name</th>
    <th>Payment</th>
</tr>

<?php
$stmt = $conn->prepare("SELECT 
        orders.*,
        customer_raw.LastName,
        status_tb.status_name,
        payment_tb.payment_name,
        (SELECT SUM(order_items.quantity * products.unit_price) 
        FROM order_items
        JOIN products ON order_items.product_id = products.product_id
        WHERE order_items.order_id = orders.order_id) AS calculated_grand_total
    FROM orders 
    JOIN customer_raw ON orders.customer_id = customer_raw.ID
    JOIN status_tb ON orders.status = status_tb.status_id
    JOIN payment_tb ON orders.payment = payment_tb.payment_id");
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($orders as $row) {
    $displayTotal = $row['calculated_grand_total'] ?? 0;
    echo "<tr>
        <td>{$row['order_id']}</td>
        <td>{$row['LastName']}</td>
       <td>" . number_format($displayTotal, 2) . "</td>
        <td>{$row['order_date']}</td>
	    <td>{$row['status_name']}</td>
        <td>{$row['payment_name']}</td>
        <div>
        <td>
            <a href='edit.php?order_id={$row['order_id']}' class='btn btn-warning btn-sm'>Edit</a>
            <a href='delete.php?order_id={$row['order_id']}' class='btn btn-danger btn-sm'>Delete</a>
        </td>
        </div>
    </tr>";
}
?>

</table>

</body>
</html>