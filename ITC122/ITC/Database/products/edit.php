<?php include '../db.php';

$product_id = $_GET['product_id'];

$stmt = $conn->prepare("SELECT * FROM products WHERE product_id = :product_id");
$stmt->execute([':product_id' => $product_id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $product_code = $_POST['product_code'];
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $unit_price = $_POST['unit_price'];
    $stock_quantity = $_POST['stock_quantity'];
    $category_id = $_POST['category_id'];




    $stmt = $conn->prepare("UPDATE products 
    SET  
    product_code=:product_code, 
    product_name=:product_name, 
    description=:description, 
    unit_price=:unit_price, 
    stock_quantity=:stock_quantity,
    category_id=:category_id
    WHERE product_id=:product_id");
    $stmt->execute([
        ':product_code' => $product_code,
        ':product_name' => $product_name,
        ':description' => $description,
        ':unit_price' => $unit_price,
        ':stock_quantity' => $stock_quantity,
        ':category_id' => $category_id,
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

<h2>Edit Product</h2>

<form method="POST">
    <h6>Product Code</h6>
    <input class="form-control mb-2" name="product_code" value="<?php echo $row['product_code']; ?>">
    <h6>Product Name</h6>
    <input class="form-control mb-2" name="product_name" value="<?php echo $row['product_name']; ?>">
     <h6>Description</h6>
    <input class="form-control mb-2" name="description" value="<?php echo $row['description']; ?>">
     <h6>Unit Price</h6>
    <input class="form-control mb-2" name="unit_price" value="<?php echo $row['unit_price']; ?>">
     <h6>Stock Quantity</h6>
    <input class="form-control mb-2" name="stock_quantity" value="<?php echo $row['stock_quantity']; ?>">
    <h6>Category<h6>
        <select name="category_id" class="form-control mb-2">
    <?php
    $cat_stmt = $conn->prepare("SELECT * FROM category_tb");
    $cat_stmt->execute();
    $categories = $cat_stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($categories as $cat) {
        $selected = ($cat['category_id'] == $row['category_id']) ? "selected" : "";
        echo "<option value='{$cat['category_id']}' $selected>{$cat['category_name']}</option>";
    }
    ?>
    </select>
    <button class="btn btn-warning">Update</button>
</form>

</body>
</html>