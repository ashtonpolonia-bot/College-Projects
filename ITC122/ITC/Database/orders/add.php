<?php include '../db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST['customer_id'];
    $status = $_POST['status'];
    $payment = $_POST['payment'];

    $stmt = $conn->prepare("INSERT INTO orders (customer_id, status, payment
    )
    VALUES (:customer_id, :status, :payment)");
    $stmt->execute([
        ':customer_id' => $customer_id,
        ':status' => $status,
        ':payment' => $payment
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
    <select name="customer_id" class="form-control mb-2" required>
        <option value="">-- Select Customer --</option>
     <?php
    $cus_stmt = $conn->prepare("SELECT * FROM customer_raw ORDER BY LastName ASC");
    $cus_stmt->execute();
    $customers = $cus_stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($customers as $cus) {
        echo "<option value='{$cus['ID']}'>{$cus['LastName']}</option>";
    }
    ?>
    </select>
    <select name="status" class="form-control mb-2" required>
        <option value="">-- Select Status --</option>
     <?php
    $sta_stmt = $conn->prepare("SELECT * FROM status_tb");
    $sta_stmt->execute();
    $status = $sta_stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($status as $sta) {
        echo "<option value='{$sta['status_id']}'>{$sta['status_name']}</option>";
    }
    ?>
    </select>
    <select name="payment" class="form-control mb-2" required>
        <option value="">-- Select payment --</option>
     <?php
    $pay_stmt = $conn->prepare("SELECT * FROM payment_tb");
    $pay_stmt->execute();
    $payment = $pay_stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($payment as $pay) {
        echo "<option value='{$pay['payment_id']}'>{$pay['payment_name']}</option>";
    }
    ?>
    </select>
    <button type="submit" class="btn btn-success">Save Product</button>
</form>
  
</body>
</html>