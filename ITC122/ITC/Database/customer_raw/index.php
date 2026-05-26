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


<h2>Customer List</h2>
<a href="add.php" class="btn btn-primary me-3">Add Customer</a>
<a href="../products/index.php" class="btn btn-primary me-3">Product List</a>
<a href="../orders/index.php" class="btn btn-primary me-3">Orders</a>
<a href="../order_items/index.php" class="btn btn-primary me-3">Item Orders</a>

<table class="table table-bordered">
<tr>
    <th>ID</th>
    <th>Title</th>
    <th>Last Name</th>
    <th>First Name</th>
    <th>Middle Name</th>
    <th>Suffix Name</th>
    <th>Date Of Birth</th>
    <th>Address Line 1</th>
    <th>Address Line 2</th>
    <th>Barangay</th>
    <th>City</th>
    <th>Province</th>
    <th>Region</th>
    <th>Contact</th>
    <th>Email</th>
    <th>Status</th>
    <th>Created</th>
    <th>Updated</th>
    <th>Action</th>
</tr>

<?php
$stmt = $conn->prepare("SELECT * FROM customer_raw");
$stmt->execute();
$customer_raw = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($customer_raw as $row) {
    echo "<tr>
        <td>{$row['ID']}</td>
        <td>{$row['Title']}</td>
        <td>{$row['LastName']}</td>
	    <td>{$row['FirstName']}</td>
	    <td>{$row['MiddleName']}</td>
        <td>{$row['SuffixName']}</td>
        <td>{$row['DateOfBirth']}</td>
        <td>{$row['AddressLine01']}</td>
        <td>{$row['AddressLine02']}</td>
        <td>{$row['Barangay']}</td>
        <td>{$row['City']}</td>
        <td>{$row['Province']}</td>
        <td>{$row['Region']}</td>
        <td>{$row['Contact']}</td>
        <td>{$row['Email']}</td>
        <td>{$row['Status']}</td>
        <td>{$row['CreatedAt']}</td>
        <td>{$row['UpdatedAt']}</td>
        <div>
        <td>
            <a href='edit.php?ID={$row['ID']}' class='btn btn-warning btn-sm'>Edit</a>
            <a href='delete.php?ID={$row['ID']}' class='btn btn-danger btn-sm'>Delete</a>
        </td>
    </tr>";
}
?>

</table>

</body>
</html>