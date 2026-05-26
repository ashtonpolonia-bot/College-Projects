<?php include '../db.php'; ?>

<!DOCTYPE html>
<html>
<head>
<title>PDO CRUD</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .container {
        max-width: 100%;
    }
    table {
        width: 100%;
    }
    td {
        white-space: nowrap;
    }
    

</style>
</head>

<body class="container mt-4">


<table class="table table-bordered table-hover">


<h2>Product List</h2>
<a href="add.php" class="btn btn-primary me-3">Add Product</a>
<a href="../customer_raw/index.php" class="btn btn-primary me-3">Back</a>

<table class="table table-bordered">
<tr>
    <th>ID</th>
    <th>Product Code</th>
    <th>Name</th>
    <th>Description</th>
    <th>Unit Price</th>
    <th>Stock Quantity</th>
    <th>Created At</th>
    <th>Updated At</th>
    <th>Category</th>
</tr>

<?php   
$stmt = $conn->prepare("SELECT 
        products.*, 
        category_tb.category_name 
    FROM products 
    JOIN category_tb ON products.category_id = category_tb.category_id");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($products as $row) {
    echo "<tr>
        <td>{$row['product_id']}</td>
        <td>{$row['product_code']}</td>
        <td>{$row['product_name']}</td>
	    <td>{$row['description']}</td>
	    <td>{$row['unit_price']}</td>
        <td>{$row['stock_quantity']}</td>
        <td>{$row['createdAt']}</td>
        <td>{$row['updatedAt']}</td>
        <td>{$row['category_name']}</td>
        <div>
        <td>
            <a href='edit.php?product_id={$row['product_id']}' class='btn btn-warning btn-sm'>Edit</a>
            <a href='delete.php?product_id={$row['product_id']}' class='btn btn-danger btn-sm'>Delete</a>
        </td>
    </tr>";
}
?>

</table>

</body>
</html>