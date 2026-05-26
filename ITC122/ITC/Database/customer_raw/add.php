<?php include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Title = $_POST['Title'];
    $LastName = $_POST['LastName'];
    $FirstName = $_POST['FirstName'];
    $MiddleName = $_POST['MiddleName'];
    $SuffixName = $_POST['SuffixName'];
    $DateOfBirth = $_POST['DateOfBirth'];
    $AddressLine01 = $_POST['AddressLine01'];
    $AddressLine02 = $_POST['AddressLine02'];
    $Barangay = $_POST['Barangay'];
    $City = $_POST['City'];
    $Province = $_POST['Province'];
    $Region = $_POST['Region'];
    $Contact = $_POST['Contact'];
    $Email = $_POST['Email'];
    $Status = $_POST['Status'];

    $stmt = $conn->prepare("INSERT INTO customer_raw (Title, LastName, FirstName, MiddleName, SuffixName, DateOfBirth, AddressLine01, AddressLine02, Barangay, City, Province, Region, Contact, Email, Status) VALUES (:Title, :LastName, :FirstName, :MiddleName, :SuffixName, :DateOfBirth, :AddressLine01, :AddressLine02, :Barangay, :City, :Province, :Region, :Contact, :Email, :Status)");
    $stmt->execute([
        ':Title' => $Title,
        ':LastName' => $LastName,
        ':FirstName' => $FirstName,
        ':MiddleName' => $MiddleName,
        ':SuffixName' => $SuffixName,
        ':DateOfBirth' => $DateOfBirth,
        ':AddressLine01' => $AddressLine01,
        ':AddressLine02' => $AddressLine02,
        ':Barangay' => $Barangay,
        ':City' => $City,
        ':Province' => $Province,
        ':Region' => $Region,
        ':Contact' => $Contact,
        ':Email' => $Email,
        ':Status' => $Status,

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

<h2>Add Customer</h2>

<form method="POST">
    <input class="form-control mb-2" name="Title" placeholder="Title" required>
    <input class="form-control mb-2" name="LastName" placeholder="Last Name" required>
    <input class="form-control mb-2" name="FirstName" placeholder="First Name" required>
    <input class="form-control mb-2" name="MiddleName" placeholder="Middle Name" required>
    <input class="form-control mb-2" name="SuffixName" placeholder="Suffix Name" required>
    <input class="form-control mb-2" name="DateOfBirth" placeholder="DOB" required>
    <input class="form-control mb-2" name="AddressLine01" placeholder="Address Line 01" required>
    <input class="form-control mb-2" name="AddressLine02" placeholder="Address Line 02" required>
    <input class="form-control mb-2" name="Barangay" placeholder="Barangay" required>
    <input class="form-control mb-2" name="City" placeholder="City" required>
    <input class="form-control mb-2" name="Province" placeholder="Province" required>
    <input class="form-control mb-2" name="Region" placeholder="Region" required>
    <input class="form-control mb-2" name="Contact" placeholder="Contact" required>
    <input class="form-control mb-2" name="Email" placeholder="Email" required>
    <input class="form-control mb-2" name="Status" placeholder="Status" required>
    <button class="btn btn-success">Save</button>
</form>

</body>
</html>