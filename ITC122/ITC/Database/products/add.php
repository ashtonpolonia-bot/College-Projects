<?php include '../db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_code = $_POST['product_code'];
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $unit_price = $_POST['unit_price'];
    $stock_quantity = $_POST['stock_quantity'];
    $category_id = $_POST['category_id'];

    $stmt = $conn->prepare("INSERT INTO products ( 
    product_code, 
    product_name, 
    description, 
    unit_price, 
    stock_quantity, 
    category_id
    )
    VALUES (:product_code, :product_name, :description, :unit_price, :stock_quantity, :category_id)");
    $stmt->execute([    
        ':product_code' => $product_code,
        ':product_name' => $product_name,
        ':description' => $description,
        ':unit_price' => $unit_price,
        ':stock_quantity' => $stock_quantity,
        ':category_id' => $category_id
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

<h2>Add Product</h2>

<form method="POST">
    <input class="form-control mb-2" name="product_code" placeholder="product_code" required>
    <input class="form-control mb-2" name="product_name" placeholder="product_name" required>
    <input class="form-control mb-2" name="description" placeholder="description" required>
    <input class="form-control mb-2" name="unit_price" placeholder="unit_price" required>
    <input class="form-control mb-2" name="stock_quantity" placeholder="stock_quantity" required>
    <select name="category_id" class="form-control mb-2" required>
        <option value="">-- Select Category --</option>
    <?php
    $cat_stmt = $conn->prepare("SELECT * FROM category_tb");
    $cat_stmt->execute();
    $categories = $cat_stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($categories as $cat) {
        echo "<option value='{$cat['category_id']}'>{$cat['category_name']}</option>";
    }
    ?>
    </select> 
    <button type="submit" class="btn btn-success">Save Product</button>
</form>
  
</body>
</html>