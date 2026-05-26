<?php include '../db.php';

$order_item_id = $_GET['order_item_id'];

$stmt = $conn->prepare("SELECT * FROM order_items WHERE order_item_id = :order_item_id");
$stmt->execute([':order_item_id' => $order_item_id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $quantity = $_POST['quantity'];
    $product_id = $_POST['product_id']; 

    
    $stmt = $conn->prepare("UPDATE order_items 
    SET  
    quantity=:quantity, 
    product_id=:product_id
    WHERE order_item_id=:order_item_id");
    $stmt->execute([
        ':quantity' => $quantity,
        ':product_id' => $product_id,
        ':order_item_id' => $order_item_id
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

<h2>Edit Order Items</h2>

<form method="POST">
   <h6>Quantity</h6>
    <input class="form-control mb-2" name="quantity" value="<?php echo $row['quantity']; ?>">
    <select name="product_id" class="form-control mb-2"`>
    <?php
    $prd_stmt = $conn->prepare("SELECT * FROM products");
    $prd_stmt->execute();
    $prods = $prd_stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($prods as $prd) {
        $selected = ($prd['product_id'] == $row['product_id']) ? "selected" : "";
        echo "<option value='{$prd['product_id']}' $selected>{$prd['product_name']}</option>";
    }
    ?>
    </select>
    
    <button class="btn btn-warning">Update</button>
</form>

</body>
</html>